<?php

namespace App\Support;

class LocaleContent
{
    public static function translate(mixed $value, ?string $locale = null): mixed
    {
        $locale = $locale ?? app()->getLocale();

        if (is_array($value)) {
            if (isset($value['fr']) || isset($value['en'])) {
                return $value[$locale] ?? $value['fr'] ?? $value['en'] ?? reset($value);
            }

            return $value;
        }

        if (! is_string($value)) {
            return $value;
        }

        $trimmed = trim($value);

        if ($trimmed === '' || (! str_starts_with($trimmed, '{') && ! str_starts_with($trimmed, '['))) {
            return $value;
        }

        $decoded = json_decode($value, true);

        if (json_last_error() !== JSON_ERROR_NONE || ! is_array($decoded)) {
            return $value;
        }

        if (isset($decoded['fr']) || isset($decoded['en'])) {
            return $decoded[$locale] ?? $decoded['fr'] ?? $decoded['en'] ?? reset($decoded);
        }

        return $value;
    }

    public static function asString(mixed $value, ?string $locale = null): string
    {
        $result = static::translate($value, $locale);

        if (is_array($result)) {
            if (array_is_list($result)) {
                return implode(', ', array_map(static fn ($item) => (string) $item, $result));
            }

            $locale = $locale ?? app()->getLocale();
            if (isset($result[$locale]) && is_string($result[$locale])) {
                return $result[$locale];
            }

            foreach (['fr', 'en'] as $fallback) {
                if (isset($result[$fallback]) && is_string($result[$fallback])) {
                    return $result[$fallback];
                }
            }

            $first = reset($result);

            return is_string($first) ? $first : '';
        }

        if ($result === null) {
            return '';
        }

        return (string) $result;
    }

    public static function asArray(mixed $value, ?string $locale = null): array
    {
        $result = static::translate($value, $locale);

        if (is_array($result) && array_is_list($result)) {
            return $result;
        }

        return [];
    }

    public static function encode(string $fr, string $en): string
    {
        return json_encode(['fr' => $fr, 'en' => $en], JSON_UNESCAPED_UNICODE);
    }

    public static function encodeList(array $fr, array $en): string
    {
        return json_encode(['fr' => $fr, 'en' => $en], JSON_UNESCAPED_UNICODE);
    }
}
