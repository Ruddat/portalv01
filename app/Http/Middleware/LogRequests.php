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
                break;
                return response('Bot detected and logged', 200);
        }
    }

    protected function logRequest(Request $request, $isBot = false)
    {
        $requestData = [
            'ip_address' => $request->ip(),
            'url' => $request->fullUrl(),
            'method' => $request->method(),
            'user_agent' => $request->header('User-Agent'),
        //    'referrer' => $request->header('referer'), // Referrer
        ];

        $requestLog = SysRequestLog::where('ip_address', $requestData['ip_address'])
            ->where('url', $requestData['url'])
            ->where('method', $requestData['method'])
            ->where('user_agent', $requestData['user_agent'])
            ->first();

        if ($requestLog) {
            $requestLog->increment('count');
            if ($isBot) {
                $requestLog->update(['is_bot' => true]);
            }
        } else {
            $requestData['count'] = 1;
            $requestData['timestamp'] = Carbon::now();
            if ($isBot) {
                $requestData['is_bot'] = true;
            }
            SysRequestLog::create($requestData);
        }
    }
}
