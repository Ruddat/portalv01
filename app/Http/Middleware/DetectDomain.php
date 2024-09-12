<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use App\Models\ModShop;
use Illuminate\Http\Request;
use App\Models\SysRequestLog;
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

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Extrahiere die Hauptdomain
        $host = $request->getHost(); // z.B. domain.com oder www.domain.com

        // Entferne "www." falls vorhanden
        $host = preg_replace('/^www\./', '', $host);

        // Finde den Shop anhand der Hauptdomain
        $shop = ModShop::where('domain', $host)->first();

        // Setze die Shop-ID in der Session oder Config
        if ($shop) {
            $request->session()->put('shop_id', $shop->id);
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
