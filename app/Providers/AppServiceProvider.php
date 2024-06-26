<?php

namespace App\Providers;

use Blade;
use Illuminate\Support\Facades\App;
use App\Services\TranslationService;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use App\Services\AutoTranslationService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //

        // Registriere den TranslationService
        $this->app->singleton(TranslationService::class, function ($app) {
            return new TranslationService(new \Stichoza\GoogleTranslate\GoogleTranslate());
        });

        $this->app->singleton(AutoTranslationService::class, function ($app) {
            return new AutoTranslationService($app->make(\App\Repositories\TranslationRepository::class));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

         Paginator::useBootstrap(); // For Bootstrap 5
    //	 Paginator::useBootstrapFour(); // For Bootstrap 4
	//   Paginator::useBootstrapThree(); // For Bootstrap 3

        // Blade Directive für AutoTranslationService
        Blade::directive('autotranslate', function ($expression) {
            return "<?php echo app(\App\Services\AutoTranslationService::class)->trans($expression); ?>";
        });



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
