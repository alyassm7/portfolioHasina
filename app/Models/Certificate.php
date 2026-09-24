<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Certificate extends Model
{
    protected $fillable = [
        'title',
        'issuer',
        'year',
        'file',
        'order',
    ];

    public function fileUrl(): ?string
    {
        if (! $this->file) {
            return null;
        }

        return asset('storage/'.$this->file);
    }

    public function isImage(): bool
    {
        if (! $this->file) {
            return false;
        }

        return (bool) preg_match('/\.(jpe?g|png|gif|webp)$/i', $this->file);
    }

    public function isPdf(): bool
    {
        if (! $this->file) {
            return false;
        }

        return str_ends_with(strtolower($this->file), '.pdf');
    }

    protected static function booted(): void
    {
        static::deleting(function (Certificate $certificate) {
            if ($certificate->file && Storage::disk('public')->exists($certificate->file)) {
                Storage::disk('public')->delete($certificate->file);
            }
        });
    }
}
