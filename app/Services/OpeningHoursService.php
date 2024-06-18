<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\ModShop;
use Illuminate\Support\Facades\DB;

class OpeningHoursService
{
    public static function isOpen(ModShop $shop)
    {
        $currentDayOfWeek = strtolower(Carbon::now()->format('l'));
        $currentTime = Carbon::now();

        // Get opening hours for the current day of the week
        $openingHours = self::getOpeningHours($shop, $currentDayOfWeek);

        if ($openingHours->isEmpty()) {
            return false; // Closed because no opening hours found for the current day of the week
        }

        // Check if the shop is open for the current day and time
        foreach ($openingHours as $hour) {
            if ($hour->is_open && $currentTime->between(
                Carbon::createFromFormat('H:i:s', $hour->open_time),
                Carbon::createFromFormat('H:i:s', $hour->close_time)
            )) {
                return true;
            }
        }

        return false; // Closed because no matching opening hours found for the current time
    }

    public static function getShopStatus(ModShop $shop)
    {
        return DB::table('mod_shops')
            ->where('id', $shop->id)
            ->value('status');
    }

    public static function getOpeningHoursForDate(ModShop $shop, $date)
    {
        $dayOfWeek = strtolower(Carbon::parse($date)->format('l'));

        $openingHours = DB::table('mod_seller_worktimes')
            ->where('shop_id', $shop->id)
            ->where('day_of_week', $dayOfWeek)
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


    public static function getNextOpenTime(ModShop $shop)
    {
        $currentTime = Carbon::now();
        $currentDayOfWeek = strtolower($currentTime->format('l'));

        // Collect all opening hours for the next seven days
        $openingHours = [];

        for ($i = 0; $i < 7; $i++) {
            $dayOfWeek = strtolower($currentTime->format('l'));

            $dailyOpeningHours = DB::table('mod_seller_worktimes')
                ->where('shop_id', $shop->id)
                ->where('day_of_week', $dayOfWeek)
                ->whereNotNull('open_time')
                ->orderBy('open_time')
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
                    'is_open' => $hour->is_open,
                ];
            }

            $currentTime->addDay();
        }

        // Find the next open time
        foreach ($openingHours as $hours) {
            if ($hours['is_open'] && $hours['open_time']->isAfter(Carbon::now())) {
                return $hours['open_time']->format('l H:i');
            }
        }

        return null; // No opening hours found for the next seven days, shop is closed
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

    public static function getOpeningHoursForTomorrow(ModShop $shop)
    {
        $tomorrow = Carbon::tomorrow()->format('l');

        $openingHours = DB::table('mod_seller_worktimes')
            ->where('shop_id', $shop->id)
            ->where('day_of_week', strtolower($tomorrow))
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
            ->whereNotNull('open_time')
            ->orderBy('open_time')
            ->get();
    }

    public static function getHolidayHours(ModShop $shop, $date)
    {
        $currentTime = Carbon::now();

        $holidayHours = DB::table('mod_seller_holi_days')
            ->where('shop_id', $shop->id)
            ->whereDate('holiday_date', $date)
            ->get();

        if ($holidayHours->isEmpty()) {
            return null; // No special holiday hours found for this date
        }

        // Check if there are holiday hours for the current date
        $currentHolidayHours = $holidayHours->first(function ($holidayHour) use ($currentTime) {
            return $currentTime->between(
                Carbon::createFromFormat('H:i:s', $holidayHour->open_time ?? '00:00:00'),
                Carbon::createFromFormat('H:i:s', $holidayHour->close_time ?? '23:59:59')
            );
        });

        // If holiday hours are found for the current date and it's closed, replace regular opening hours
        if ($currentHolidayHours && !$currentHolidayHours->is_open) {
            return [
                'open_time' => null,
                'close_time' => null,
                'is_open' => false,
                'holiday_message' => $currentHolidayHours->holiday_message,
            ];
        }

        // Sort holiday hours by relevance
        $sortedHolidayHours = $holidayHours->sortByDesc(function ($holidayHour) use ($currentTime) {
            if ($holidayHour->open_time !== null && $holidayHour->close_time !== null) {
                if ($currentTime->between(
                    Carbon::createFromFormat('H:i:s', $holidayHour->open_time),
                    Carbon::createFromFormat('H:i:s', $holidayHour->close_time)
                )) {
                    return 1; // Prioritize open times
                } else {
                    return 0;
                }
            } else {
                return 0; // Assume closed if open_time or close_time is NULL
            }
        });

        // Select the most relevant holiday hours (first one in sorted list)
        $relevantHolidayHours = $sortedHolidayHours->first();

        return [
            'open_time' => $relevantHolidayHours->open_time,
            'close_time' => $relevantHolidayHours->close_time,
            'is_open' => $relevantHolidayHours->is_open,
            'holiday_message' => $relevantHolidayHours->holiday_message,
        ];
    }
}
