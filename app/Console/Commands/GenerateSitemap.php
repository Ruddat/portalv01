<?php

namespace App\Console\Commands;

use App\Models\ModShop;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use Illuminate\Console\Command;
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

        // Statische Seiten hinzufügen
        $sitemap->add(Url::create('/'));
     //   $sitemap->add(Url::create('/about'));
        $sitemap->add(Url::create('/register'));
        $sitemap->add(Url::create('/seller/register'));
        $sitemap->add(Url::create('/media-stats'));

        // Dynamische Seiten aus ModShop hinzufügen (nur 'limited' oder 'on', sortiert nach updated_at)
        $shops = ModShop::whereIn('status', ['limited', 'on'])
                        ->orderBy('updated_at', 'desc')
                        ->get();

        foreach ($shops as $shop) {
            $sitemap->add(Url::create("/shop/{$shop->shop_slug}")
                ->setLastModificationDate($shop->updated_at)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                ->setPriority(0.8));
        }

        // Sitemap in eine Datei speichern
        $sitemap->writeToFile(public_path('sitemap.xml'));

        $this->info('Sitemap erfolgreich generiert!');
    }
}
