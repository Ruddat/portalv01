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
            return $this->handleBot($request);
        }

        $response = $next($request);

        $this->logRequest($request);

        return $response;
    }

    protected function handleBot(Request $request)
    {
        $botAction = config('bot.action', 'log');

        switch ($botAction) {
            case 'block':
                Log::info('Bot request blocked.');
                return response('Access denied', 403);

            case 'redirect':
                Log::info('Bot request redirected.');
                return redirect()->route('home');

            case 'log':
            default:
                Log::info('Bot request logged.');
                return response('Bot detected and logged', 200);
        }
    }

    protected function logRequest(Request $request)
    {
        $requestData = [
            'ip_address' => $request->ip(),
            'url' => $request->fullUrl(),
            'method' => $request->method(),
            'user_agent' => $request->header('User-Agent'),
        ];

        $requestLog = SysRequestLog::updateOrCreate(
            $requestData,
            ['timestamp' => Carbon::now()]
        );

        // Erhöhe den count und setze is_bot, wenn ein Bot erkannt wird
        if ($this->crawlerDetect->isCrawler()) {
            $requestLog->increment('count');
            $requestLog->update(['is_bot' => true]);
        } else {
            // Erhöhe den count, wenn der Eintrag bereits existiert
            if (!$requestLog->wasRecentlyCreated) {
                $requestLog->increment('count');
            }
        }
    }
}
