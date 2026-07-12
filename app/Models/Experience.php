<?php

namespace App\Models;

use App\Models\Concerns\HasTranslations;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasTranslations;
    protected $fillable = [
        'year',
        'title',
        'company',
        'description',
        'order',
    ];
}
