<?php

namespace App\Models;

use App\Models\Concerns\HasTranslations;
use App\Support\LocaleContent;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasTranslations;
    protected $fillable = [
        'title',
        'slug',
        'description',
        'technologies',
        'features',
        'case_study',
        'github_url',
        'demo_url',
        'image',
        'is_featured',
        'order',
    ];

    protected function casts(): array
    {
        return [
            'technologies' => 'array',
            'features' => 'array',
            'case_study' => 'array',
            'is_featured' => 'boolean',
        ];
    }

    public function localizedFeatures(?string $locale = null): array
    {
        return LocaleContent::asArray($this->features ?? [], $locale);
    }

    public function caseStudyField(string $key, ?string $locale = null): string
    {
        $value = $this->case_study[$key] ?? null;

        return LocaleContent::asString($value, $locale);
    }

    public function caseStudyList(string $key, ?string $locale = null): array
    {
        $value = $this->case_study[$key] ?? [];

        return LocaleContent::asArray($value, $locale);
    }

    public function hasCaseStudy(): bool
    {
        return ! empty($this->case_study);
    }
}
