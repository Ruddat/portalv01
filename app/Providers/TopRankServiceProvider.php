<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\TopRankPriceCalculator;

class TopRankServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
        $this->app->singleton(TopRankPriceCalculator::class, function ($app) {
            $basePrice = config('settings.base_price', 0.50); // Anpassen, falls nötig
            return new TopRankPriceCalculator($basePrice);
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
