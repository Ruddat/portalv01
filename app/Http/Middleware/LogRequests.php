<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\SysRequestLog;
use Illuminate\Support\Facades\Log;
use Jaybizzle\CrawlerDetect\CrawlerDetect;

class LogRequests
{
    protected $crawlerDetect;

    public function __construct(CrawlerDetect $crawlerDetect)
    {
        $this->crawlerDetect = $crawlerDetect;
    }

    public function handle(Request $request, Closure $next)
    {
        if ($this->crawlerDetect->isCrawler()) {
            $this->logRequest($request, true);
            // Debugging-Informationen und gesamte Anfrage
            Log::debug('Bot found:', [
                'ip_address' => $request->ip(),
                'url' => $request->fullUrl(),
                'method' => $request->method(),
                'user_agent' => $request->header('User-Agent'),
                'referrer' => $request->header('referer'),
                'headers' => $request->headers->all(),
                'query' => $request->query->all(),
                'body' => $request->all()
            ]);
        } else {
            $this->logRequest($request, false);
        }

        return $next($request);
    }

    protected function logRequest(Request $request, $isBot = false)
    {
        // Normalisiere die Eingabewerte
        $ipAddress = trim($request->ip());
        $url = trim($request->fullUrl());
        $method = strtoupper(trim($request->method()));
        $userAgent = trim($request->header('User-Agent'));
        $referrer = trim($request->header('referer') ?? '');

        // Überprüfen, ob bereits ein Eintrag mit denselben Details existiert
        $existingLog = SysRequestLog::where('ip_address', $ipAddress)
            ->where('url', $url)
            ->where('method', $method)
            ->where('user_agent', $userAgent)
            ->first();

        if ($existingLog) {
            Log::debug('Existing Log Found:', $existingLog->toArray());
            // Erhöhe die count-Spalte um 1
            $existingLog->increment('count');
        } else {
            // Erstelle einen neuen Eintrag mit count = 1
            SysRequestLog::create([
                'ip_address' => $ipAddress,
                'url' => $url,
                'method' => $method,
                'user_agent' => $userAgent,
                'referrer' => $referrer,
                'timestamp' => Carbon::now(),
                'count' => 1,
                'is_bot' => $isBot,  // Fügen Sie dies hinzu, wenn Sie den Bot-Status speichern möchten
            ]);
        }
    }
}
