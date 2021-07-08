<?php

use Illuminate\Support\Facades\Route;

/**
 * Authenticated Routes
 */
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::view('dashboard', 'app.dashboard.index')->name('dashboard:index');

    /**
     * Dashboard Actions
     */
    Route::prefix('dashboard')->as('dashboard:')->group(function () {
        /**
         * Packages
         */
        Route::prefix('packages')->as('packages:')->group(function () {
            Route::get(
                '/',
                App\Http\Controllers\Dashboard\Packages\IndexController::class,
            )->name('index');
        });

        /**
         * Articles
         */
        Route::prefix('articles')->as('articles:')->group(function () {
            Route::get(
                '/',
                App\Http\Controllers\Dashboard\Articles\IndexController::class,
            )->name('index');
            Route::get(
                'create',
                App\Http\Controllers\Dashboard\Articles\CreateController::class,
            )->name('create');
        });

        /**
         * Feeds
         */
        Route::prefix('feeds')->as('feeds:')->group(function () {
            Route::get(
                '/',
                App\Http\Controllers\Dashboard\Feeds\IndexController::class,
            )->name('index');
            Route::get(
                'create',
                App\Http\Controllers\Dashboard\Feeds\CreateController::class,
            )->name('create');

            Route::get(
                '{feed:uuid}',
                App\Http\Controllers\Dashboard\Feeds\ShowController::class,
            )->name('show');
        });
    });
});

/**
 * Static Routes
 */
Route::as('static:')->group(function () {
    Route::view('/', 'static.pages.home')->name('home');
    Route::view('about', 'static.pages.about')->name('about');
    Route::view('contact-us', 'static.pages.contact')->name('contact');

    /**
     * Blog Article Routes
     */
    Route::prefix('blog')->as('articles:')->group(function () {
        
        /**
         * Articles Index
         */
        Route::get(
            '/',
            App\Http\Controllers\Static\Articles\IndexController::class,
        )->name('index');

        /**
         * Article Show
         */
        Route::get(
            '{user}/{article}',
            App\Http\Controllers\Static\Articles\ShowController::class,
        )->name('show');
    });

    /**
     * Package Routes
     */
    Route::prefix('packages')->as('packages:')->group(function () {

        /**
         * Show All Packages
         */
        Route::get(
            '/',
            App\Http\Controllers\Static\Packages\IndexController::class,
        )->name('index');

        /**
         * Show a Package
         */
        Route::get(
            '{package}',
            App\Http\Controllers\Static\Packages\ShowController::class,
        )->name('show');
    });

    /**
     * Podcast Routes
     */
    Route::prefix('podcasts')->as('podcasts')->group(function () {
        Route::view('/', 'static.podcasts.index')->name('index');
    });

    /**
     * Stream Routes
     */
    Route::get(
        '/streams',
        App\Http\Controllers\Static\Streams\IndexController::class,
    )->name('streams:index');

    Route::prefix('@{user:username}')->as('profile:')->group(function () {
        
        Route::get(
            '/',
            App\Http\Controllers\Static\Users\ProfileController::class
        )->name('show');

        Route::get(
            '/feeds/{feed:uuid}',
            App\Http\Controllers\Static\Users\Feeds\ShowController::class,
        )->name('feeds:show');
    });
});
