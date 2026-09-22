<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EducationController as AdminEducationController;
use App\Http\Controllers\Admin\ExperienceController as AdminExperienceController;
use App\Http\Controllers\Admin\MessageController as AdminMessageController;
use App\Http\Controllers\Admin\ProjectController as AdminProjectController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SkillController as AdminSkillController;
use App\Http\Controllers\Admin\TestimonialController as AdminTestimonialController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\PortfolioController;
use Illuminate\Support\Facades\Route;

Route::get('/locale/{locale}', [LocaleController::class, 'switch'])->name('locale.switch');

Route::middleware('locale')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/cv/download', [HomeController::class, 'downloadCv'])->name('cv.download');

    Route::get('/about', [PortfolioController::class, 'about'])->name('about');
    Route::get('/skills', [PortfolioController::class, 'skills'])->name('skills');
    Route::get('/projects', [PortfolioController::class, 'projects'])->name('projects');
    Route::get('/projects/{slug}', [PortfolioController::class, 'projectShow'])->name('projects.show');
    Route::get('/experiences', [PortfolioController::class, 'experiences'])->name('experiences');
    Route::get('/contact', [ContactController::class, 'index'])->name('contact');
    Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login.submit');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    Route::middleware('admin')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('projects', AdminProjectController::class)->except(['show']);
        Route::resource('skills', AdminSkillController::class)->except(['show']);
        Route::resource('experiences', AdminExperienceController::class)->except(['show']);
        Route::resource('educations', AdminEducationController::class)->except(['show']);
        Route::resource('testimonials', AdminTestimonialController::class)->except(['show']);
        Route::resource('messages', AdminMessageController::class)->only(['index', 'show', 'destroy']);
        Route::post('messages/{message}/reply', [AdminMessageController::class, 'reply'])->name('messages.reply');

        Route::get('settings', [SettingController::class, 'edit'])->name('settings.edit');
        Route::put('settings', [SettingController::class, 'update'])->name('settings.update');
        Route::post('settings/cv', [SettingController::class, 'uploadCv'])->name('settings.cv');
    });
});
