<?php

namespace App\Models;

use App\Models\Concerns\HasTranslations;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasTranslations;
    protected $table = 'educations';

    protected $fillable = [
        'title',
        'institution',
        'year',
        'description',
        'order',
    ];
}
