<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use App\Models\ModShop;
use Illuminate\Http\Request;
use App\Models\SysRequestLog;
use App\Models\ModSellerDomains;
use App\Http\Requests\LogSideRequest;
use Jaybizzle\CrawlerDetect\CrawlerDetect;
use Symfony\Component\HttpFoundation\Response;

class DetectDomain
{
    protected $crawlerDetect;

    public function __construct(CrawlerDetect $crawlerDetect)
    {
        $this->crawlerDetect = $crawlerDetect;
    }

    public function handle(Request $request, Closure $next)
    {
        // Ignoriere Livewire Polling-Anfragen
        if ($request->header('X-Livewire')) {
            return $next($request);
        }

        // Extrahiere die Hauptdomain
        $host = $request->getHost(); // z.B. domain.com oder www.domain.com

        // Entferne "www." falls vorhanden
        $host = preg_replace('/^www\./', '', $host);

        // Debug-Ausgabe
    //    \Log::info('Anfragende Domain: ' . $host);

        // Überprüfen, ob die Domain bereits als nicht zugeordnet markiert wurde
        if ($request->session()->has('no_shop_for_domain') && $request->session()->get('no_shop_for_domain') === $host) {
        //    \Log::info('Domain ' . $host . ' wurde bereits als nicht zugeordnet markiert.');
            return $next($request);
        }

        // Finde den Shop anhand der Hauptdomain aus der mod_seller_domains Tabelle
        $domainEntry = ModSellerDomains::where('domain', $host)->first();

        if ($domainEntry) {
            $shopId = $domainEntry->shop_id;

            // Debug-Ausgabe
            \Log::info('ShopID: ' . $shopId);

            // Finde den Shop-Slug anhand der Shop-ID
            $shop = ModShop::find($shopId);

            if ($shop && !empty($shop->shop_slug)) {
                // Generiere die URL für den Shop
                $shopUrl = url("/de/restaurant/" . $shop->shop_slug);

                // Debug-Ausgabe
                \Log::info('Weiterleitung auf: ' . $shopUrl);

                // Überprüfe, ob die aktuelle URL bereits die weitergeleitete URL ist
                if (!$request->session()->has('redirected')) {
                    $request->session()->put('shop_id', $shopId);
                    $request->session()->put('redirected', true);

                    return redirect($shopUrl);
                } else {
                    \Log::warning('Endlosschleife vermutet bei URL: ' . $shopUrl);
                }
            } else {
                \Log::warning('Kein gültiger Shop-Slug für ShopID: ' . $shopId);
            }
        } else {
            \Log::warning('Keine Shop-Zuordnung für Domain: ' . $host);
            $request->session()->put('no_shop_for_domain', $host);
        }

        // Logge die Anfrage
        $this->logRequest($request);

        return $next($request);
    }

    protected function logRequest(Request $request)
    {
        $isBot = $this->crawlerDetect->isCrawler();
        $referrer = $request->header('referer') ?? $request->header('referrer') ?? '';

        $requestData = [
            'ip_address' => $request->ip(),
            'url' => $request->fullUrl(),
            'method' => $request->method(),
            'user_agent' => $request->header('User-Agent'),
            'referrer' => $referrer,
            'timestamp' => Carbon::now(),
            'is_bot' => $isBot,
        ];

        SysRequestLog::create($requestData);
    }
}
