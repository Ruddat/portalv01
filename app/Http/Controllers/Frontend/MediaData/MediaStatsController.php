<?php

namespace App\Http\Controllers\Frontend\MediaData;

use Illuminate\Http\Request;
use App\Models\SysRequestLog;
use App\Http\Controllers\Controller;

class MediaStatsController extends Controller
{


    //
    public function index()
    {
        // Gesamtanzahl der Zugriffe
        $totalRequests = SysRequestLog::count();

        // Beliebteste Seiten
        $popularPages = SysRequestLog::select('url', SysRequestLog::raw('count(*) as total'))
            ->groupBy('url')
            ->orderByDesc('total')
            ->paginate(15); // Hier paginieren wir mit 15 Einträgen pro Seite

        // Zugriffe nach Datum
        $requestsByDate = SysRequestLog::select(SysRequestLog::raw('DATE(timestamp) as date'), SysRequestLog::raw('count(*) as total'))
            ->groupBy('date')
            ->orderBy('date')
            ->get();


        // Verwendete Geräte
        $deviceStats = SysRequestLog::select('user_agent', SysRequestLog::raw('count(*) as total'))
        ->groupBy('user_agent')
        ->orderByDesc('total')
        ->take(15) // Begrenzen auf 15 Einträge
        ->get();

        // Herkunft der Nutzer
        $referrerStats = SysRequestLog::select('referrer', SysRequestLog::raw('count(*) as total'))
            ->groupBy('referrer')
            ->orderByDesc('total')
            ->paginate(10); // Hier paginieren wir mit 10 Einträgen pro Seite

        // Daten an die View weiterleiten
        return view('frontend.pages.mediadata.stats.index', compact('totalRequests', 'popularPages', 'requestsByDate', 'deviceStats', 'referrerStats'));
    }
}
