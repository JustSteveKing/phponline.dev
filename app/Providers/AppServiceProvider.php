<?php

namespace App\Providers;

use Illuminate\Support\Str;
use App\Factories\KeyFactory;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Str::macro(
            name: 'key',
            macro: fn (string $prefix, int $length = 20) => KeyFactory::generate(
                prefix: $prefix,
                length: $length,
            ),
        );
    }
}
