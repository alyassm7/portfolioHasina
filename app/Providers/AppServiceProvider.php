<?php

namespace App\Providers;

use App\Models\Setting;
use App\Support\PortfolioAssets;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Schema::defaultStringLength(191);

        $publicViews = [
            'layouts.app',
            'layouts.partials.navbar',
            'layouts.partials.footer',
            'home',
            'about',
            'skills',
            'projects',
            'experiences',
            'contact',
        ];

        View::composer($publicViews, function ($view) {
            $settings = Setting::allLocalized();
            $view->with('settings', $settings);
            $view->with('profilePhotoUrl', PortfolioAssets::imageUrl($settings['about_photo'] ?? null));
        });
    }
}
