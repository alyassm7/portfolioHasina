<?php

namespace App\Support;

class PortfolioAssets
{
    public static function imageUrl(?string $path, string $fallback = 'images/profile.svg'): string
    {
        $candidates = array_filter([
            $path,
            $fallback,
            'images/profile.png',
            'images/profile.svg',
        ]);

        foreach ($candidates as $candidate) {
            if (empty($candidate)) {
                continue;
            }

            if (str_starts_with($candidate, 'http://') || str_starts_with($candidate, 'https://')) {
                return $candidate;
            }

            $publicPath = public_path(ltrim($candidate, '/'));

            if (is_file($publicPath)) {
                return asset(ltrim($candidate, '/'));
            }
        }

        return asset('images/profile.svg');
    }
}
