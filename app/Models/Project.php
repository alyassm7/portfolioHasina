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
            'is_featured' => 'boolean',
        ];
    }

    public function localizedFeatures(?string $locale = null): array
    {
        return LocaleContent::asArray($this->features ?? [], $locale);
    }
}
