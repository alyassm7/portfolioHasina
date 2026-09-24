<?php

namespace App\Models;

use App\Support\LocaleContent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    protected $fillable = [
        'key',
        'value',
    ];

    /** @return list<string> */
    public static function translatableKeys(): array
    {
        return [
            'site_title',
            'hero_greeting',
            'hero_job_title',
            'hero_roles',
            'about_text',
            'meta_description',
        ];
    }

    public static function get(string $key, mixed $default = null): mixed
    {
        return Cache::rememberForever("setting.{$key}", function () use ($key, $default) {
            $setting = static::where('key', $key)->first();

            return $setting?->value ?? $default;
        });
    }

    public static function getLocalized(string $key, mixed $default = null): mixed
    {
        return LocaleContent::asString(static::get($key, $default));
    }

    public static function set(string $key, mixed $value): void
    {
        static::updateOrCreate(['key' => $key], ['value' => $value]);
        Cache::forget("setting.{$key}");
    }

    public static function allGrouped(): array
    {
        return static::pluck('value', 'key')->toArray();
    }

    public static function allLocalized(): array
    {
        $settings = static::allGrouped();
        $localized = [];

        foreach ($settings as $key => $value) {
            $localized[$key] = LocaleContent::asString($value);
        }

        return $localized;
    }

    public static function allForAdmin(): array
    {
        $settings = static::allGrouped();
        $admin = [];

        foreach ($settings as $key => $value) {
            if (in_array($key, static::translatableKeys(), true)) {
                $admin[$key.'_fr'] = LocaleContent::asString($value, 'fr');
                $admin[$key.'_en'] = LocaleContent::asString($value, 'en');
            } else {
                $admin[$key] = LocaleContent::asString($value, 'fr');
            }
        }

        return $admin;
    }
}
