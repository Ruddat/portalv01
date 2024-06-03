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
        // Protokolliere jede Anfrage, unabhängig von der Art
        $this->logRequest($request);


        // Überprüfe, ob die Anfrage von einem Crawler stammt
        if ($this->crawlerDetect->isCrawler()) {
            $this->handleBot($request);
        }

        return $next($request);
    }

    protected function handleBot(Request $request)
    {
        $botAction = config('bot.action', 'log');

        switch ($botAction) {
            case 'block':
                Log::info('Bot request blocked.');
                abort(403, 'Access denied'); // Blockieren Sie den Zugriff
                break;

            case 'redirect':
                Log::info('Bot request redirected.');
                return redirect()->route('home');
                break;

            case 'log':
            default:
                Log::info('Bot request logged.');
                // Fahren Sie fort, die Anfrage zu verarbeiten, ohne sie zu blockieren
                break;
        }
    }

    protected function logRequest(Request $request, $isBot = false)
    {
        $requestData = [
            'ip_address' => $request->ip(),
            'url' => $request->fullUrl(),
            'method' => $request->method(),
            'user_agent' => $request->header('User-Agent'),
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
                Log::info('Bot request logged.');
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
