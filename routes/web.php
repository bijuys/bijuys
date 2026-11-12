<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ExperienceController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\PortfolioController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Portfolio Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [PortfolioController::class, 'index'])->name('home');
Route::get('/about', [PortfolioController::class, 'about'])->name('about');
Route::get('/work', [PortfolioController::class, 'work'])->name('work');
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');
Route::get('/contact', [PortfolioController::class, 'contact'])->name('contact');
Route::post('/contact', [PortfolioController::class, 'contactSubmit'])->name('contact.submit');

Route::get('/login', fn () => redirect()->route('admin.login'))->name('login');

/*
|--------------------------------------------------------------------------
| Admin Authentication Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    /*
    |----------------------------------------------------------------------
    | Protected Admin CMS Routes
    |----------------------------------------------------------------------
    */
    Route::middleware('auth')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        // Site Content & Settings
        Route::get('/settings', [SettingController::class, 'edit'])->name('settings.edit');
        Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');

        // Projects Management
        Route::resource('projects', ProjectController::class)->except(['show']);

        // Blog Posts Management
        Route::resource('posts', PostController::class)->except(['show']);

        // Skills Management
        Route::resource('skills', SkillController::class)->except(['show']);

        // Career Experiences / Timeline Management
        Route::resource('experiences', ExperienceController::class)->except(['show']);

        // Services Management
        Route::resource('services', ServiceController::class)->except(['show']);

        // Contact Messages Inbox
        Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
        Route::get('/messages/{message}', [MessageController::class, 'show'])->name('messages.show');
        Route::post('/messages/{message}/toggle-read', [MessageController::class, 'toggleRead'])->name('messages.toggle-read');
        Route::delete('/messages/{message}', [MessageController::class, 'destroy'])->name('messages.destroy');
    });
});
