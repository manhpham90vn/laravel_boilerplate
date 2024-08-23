<?php

namespace App\Providers;

use App;
use Illuminate\Support\ServiceProvider;

class HelpersProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(App\Helpers\Helper::class, function () {
            return new App\Helpers\Helper();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
