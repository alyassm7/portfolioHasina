<?php

namespace App\Models\Concerns;

use App\Support\LocaleContent;

trait HasTranslations
{
    protected function translationValue(string $field): mixed
    {
        if (array_key_exists($field, $this->attributes)) {
            return $this->attributes[$field];
        }

        return $this->getAttributeValue($field);
    }

    public function localized(string $field, ?string $locale = null): string
    {
        return LocaleContent::asString($this->translationValue($field), $locale);
    }

    public function localizedList(string $field, ?string $locale = null): array
    {
        return LocaleContent::asArray($this->translationValue($field), $locale);
    }
}
