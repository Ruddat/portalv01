<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\GeocodeService;


class GeocodeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register()
    {
        $this->app->singleton(GeocodeService::class, function ($app) {
            return new GeocodeService();
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
