<?php

namespace App\Models;

use App\Models\Concerns\HasTranslations;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasTranslations;
    protected $fillable = [
        'name',
        'role',
        'content',
        'rating',
        'order',
    ];
}
