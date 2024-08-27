<?php

namespace App\Console\Commands;

use App\Models\ModShop;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use Illuminate\Console\Command;
use App\Models\ModAdminBlogPost;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL as LaravelURL;

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate';
    protected $description = 'Generiere die Sitemap.';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $sitemap = Sitemap::create();

        // Verfügbare Sprachen aus der Konfiguration laden
        $locales = array_values(config('app.available_locales'));

        // Statische Seiten hinzufügen

        foreach ($locales as $locale) {
     //       $sitemap->add(Url::create("/{$locale}/"));
     //       $sitemap->add(Url::create("/{$locale}/register"));
    //      $sitemap->add(Url::create("/{$locale}/seller/register"));
    //        $sitemap->add(Url::create("/{$locale}/media-stats"));
            $sitemap->add(Url::create("/{$locale}/blog"));
    //        $sitemap->add(Url::create("/{$locale}/impressum"));
        }


    $sitemap->add(Url::create("/"));
    $sitemap->add(Url::create("/register"));
    $sitemap->add(Url::create("/seller/register"));
    $sitemap->add(Url::create("/media-stats"));
    //$sitemap->add(Url::create("/{$locale}/blog"));
    $sitemap->add(Url::create("/impressum"));


        // Dynamische Seiten aus Routen hinzufügen
        //$routes = Route::getRoutes();

        // Dynamische Seiten aus ModShop hinzufügen (nur 'limited' oder 'on', sortiert nach updated_at)
        $shops = ModShop::whereIn('status', ['limited', 'on'])
                        ->orderBy('updated_at', 'desc')
                        ->get();

        foreach ($shops as $shop) {
            foreach ($locales as $locale) {
                $sitemap->add(Url::create("/{$locale}/restaurant/{$shop->shop_slug}")
                    ->setLastModificationDate($shop->updated_at)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                    ->setPriority(0.8));
            }
        }

            // Dynamische Seiten aus ModAdminBlogPost hinzufügen
            $posts = ModAdminBlogPost::orderBy('updated_at', 'desc')->get();

            foreach ($posts as $post) {
                $sitemap->add(Url::create("/blog/{$post->slug}")
                    ->setLastModificationDate($post->updated_at)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                    ->setPriority(0.8));
            }

            // Alle Routen aus der web.php hinzufügen
            // $routes = Route::getRoutes();

            // foreach ($routes as $route) {
               // if (in_array('GET', $route->methods()) && $route->uri() !== '/') {
                    // Hier kannst du spezifische Routen ausschließen oder anpassen
                 //   $sitemap->add(Url::create($route->uri()));
               // }
           // }

        // Sitemap in eine Datei speichern
        $sitemap->writeToFile(public_path('sitemap.xml'));

        $this->info('Sitemap erfolgreich generiert!');
    }
}
