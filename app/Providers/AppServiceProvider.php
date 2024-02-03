<?php

namespace App\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
            $userLanguage = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
        } else {
            $userLanguage = 'en'; // Standardsprache festlegen, falls der Header nicht verfügbar ist
        }

        $supportedLanguages = ['en', 'es', 'de', 'nl', 'ru', 'ar']; // Liste der unterstützten Sprachen

        if (in_array($userLanguage, $supportedLanguages)) {
            App::setLocale($userLanguage);
        } else {
            App::setLocale('en'); // Standardsprache, falls die bevorzugte Sprache nicht unterstützt wird
        }

        Schema::defaultStringLength(191);
    }
}
