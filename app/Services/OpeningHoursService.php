<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\ModShop;
use Illuminate\Support\Facades\DB;

class OpeningHoursService
{
    public static function isOpen(ModShop $shop)
    {
        $currentDayOfWeek = strtolower(Carbon::now()->format('l')); // Aktueller Wochentag
        $currentTime = Carbon::now(); // Aktuelle Uhrzeit

        // Abrufen der Öffnungszeiten des Geschäfts für den aktuellen Wochentag
        $openingHours = self::getOpeningHours($shop, $currentDayOfWeek);

        if ($openingHours->isEmpty()) {
            return false; // Geschlossen, da keine Öffnungszeiten für den aktuellen Wochentag gefunden wurden
        }

        // Überprüfen, ob das Geschäft für den aktuellen Wochentag geöffnet ist
        foreach ($openingHours as $hour) {
            if ($hour->is_open && $currentTime->between(
                Carbon::createFromFormat('H:i:s', $hour->open_time),
                Carbon::createFromFormat('H:i:s', $hour->close_time)
            )) {
                return true;
            }
        }

        return false; // Geschlossen, da keine passenden Öffnungszeiten gefunden wurden
    }



    public static function getShopStatus(Modshop $shop)

    {
        return DB::table('mod_shops')
            ->where('id', $shop->id)
            ->value('status');

    }


    public static function getNextOpenTime(ModShop $shop)
    {
        $currentTime = Carbon::now(); // Aktuelle Uhrzeit
        $currentDayOfWeek = strtolower($currentTime->format('l')); // Aktueller Wochentag

        // Alle Öffnungszeiten der nächsten sieben Tage sammeln
        $openingHours = [];

        for ($i = 0; $i < 7; $i++) {
            $dayOfWeek = strtolower($currentTime->format('l')); // Aktueller Wochentag

            $dailyOpeningHours = DB::table('mod_seller_worktimes')
                ->where('shop_id', $shop->id)
                ->where('day_of_week', $dayOfWeek)
                ->whereNotNull('open_time') // Nur Zeilen mit gültiger Öffnungszeit berücksichtigen
                ->orderBy('open_time') // Nach Öffnungszeit sortieren
                ->get();

            foreach ($dailyOpeningHours as $hour) {
                $openTime = Carbon::createFromFormat('H:i:s', $hour->open_time);
                $closeTime = Carbon::createFromFormat('H:i:s', $hour->close_time);
                $openTime->setDate($currentTime->year, $currentTime->month, $currentTime->day);
                $closeTime->setDate($currentTime->year, $currentTime->month, $currentTime->day);

                if ($closeTime->isBefore($openTime)) {
                    $closeTime->addDay();
                }

                $openingHours[] = [
                    'open_time' => $openTime,
                    'close_time' => $closeTime,
                    'is_open' => $hour->is_open
                ];
            }

            // Erhöhe das Datum auf den nächsten Tag
            $currentTime->addDay();
        }

        // Die nächste Öffnungszeit finden
        foreach ($openingHours as $hours) {
            if ($hours['is_open'] && $hours['open_time']->isAfter(Carbon::now())) {
                return $hours['open_time']->format('l H:i');
            }
        }

        // Wenn keine Öffnungszeiten für die nächsten sieben Tage gefunden wurden, ist das Geschäft geschlossen
        return null;
    }


    public static function getOpeningHoursForToday(ModShop $shop)
{
    $currentDayOfWeek = strtolower(Carbon::now()->format('l'));

    $openingHours = DB::table('mod_seller_worktimes')
        ->where('shop_id', $shop->id)
        ->where('day_of_week', $currentDayOfWeek)
        ->whereNotNull('open_time')
        ->orderBy('open_time')
        ->get()
        ->map(function ($hour) {
            return [
                'open' => $hour->open_time,
                'close' => $hour->close_time,
                'is_open' => $hour->is_open,
            ];
        });

    return $openingHours;
}


    private static function getOpeningHours(ModShop $shop, $dayOfWeek)
    {
        return DB::table('mod_seller_worktimes')
        ->where('shop_id', $shop->id)
        ->where('day_of_week', $dayOfWeek)
        ->whereNotNull('open_time') // Nur Zeilen mit gültiger Öffnungszeit berücksichtigen
        ->orderBy('open_time') // Nach Öffnungszeit sortieren
        ->get();
    }
}
