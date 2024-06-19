<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use App\Models\AdminPromoBanner;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminPromoBannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AdminPromoBanner::create([
            'title' => 'Kostenlose Lieferung für die ersten 14 Tage!',
            'description' => 'Genießen Sie 14 Tage lang kostenlose Lieferung auf alle Ihre Bestellungen. Nutzen Sie die Gelegenheit, Ihre Lieblingsprodukte ohne zusätzliche Kosten zu erhalten.',
            'icon' => 'icon-food_icon_delivery',
            'coupon_code' => 'FREESHIP14',
            'start_time' => Carbon::now()->subDay(),
            'end_time' => Carbon::now()->addDays(13),
            'banner_color' => '#FF5733', // Rot-Orange
        ]);

        AdminPromoBanner::create([
            'title' => '50% Rabatt auf alle Produkte!',
            'description' => 'Profitieren Sie von unserem Sonderangebot: 50% Rabatt auf alle Produkte. Jetzt ist die perfekte Zeit zum Einkaufen und Sparen!',
            'icon' => 'icon-discount',
            'coupon_code' => 'HALFOFF',
            'start_time' => Carbon::now()->subDay(),
            'end_time' => Carbon::now()->addDays(1),
            'banner_color' => '#33FF57', // Grün
        ]);

        AdminPromoBanner::create([
            'title' => 'Kaufe 2, erhalte 1 gratis!',
            'description' => 'Spezielles Angebot: Kaufen Sie zwei Produkte und erhalten Sie ein drittes kostenlos dazu. Ideal zum Teilen oder für den Eigenbedarf.',
            'icon' => 'icon-buy2get1',
            'coupon_code' => 'BUY2GET1',
            'start_time' => Carbon::now(),
            'end_time' => Carbon::now()->addDays(7),
            'banner_color' => '#3357FF', // Blau
        ]);

        AdminPromoBanner::create([
            'title' => '20% Rabatt auf die erste Bestellung!',
            'description' => 'Neu hier? Erhalten Sie 20% Rabatt auf Ihre erste Bestellung. Ein kleines Willkommensgeschenk von uns für Sie!',
            'icon' => 'icon-firstorder',
            'coupon_code' => 'FIRST20',
            'start_time' => Carbon::now()->subDay(),
            'end_time' => Carbon::now()->addDays(5),
            'banner_color' => '#FF33A6', // Pink
        ]);

        AdminPromoBanner::create([
            'title' => 'Sommersale! Bis zu 70% Rabatt!',
            'description' => 'Unser großer Sommersale ist da! Sichern Sie sich bis zu 70% Rabatt auf eine Vielzahl von Produkten. Nur für begrenzte Zeit!',
            'icon' => 'icon-summersale',
            'coupon_code' => 'SUMMER70',
            'start_time' => Carbon::now()->subDay(),
            'end_time' => Carbon::now()->addDays(10),
            'banner_color' => '#FFC300', // Gelb
        ]);
    }
}
