<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\SysRequestLog;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;

class LogRequests
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Bot detection
        if ($this->isBot($request->header('User-Agent'))) {
            // Handle bot based on configuration
            return $this->handleBot($request);
        }

        $response = $next($request);

// Log data
$logData = [
    'ip_address' => $request->ip(),
    'url' => $request->fullUrl(),
    'method' => $request->method(),
    'user_agent' => $request->header('User-Agent'),
    'referrer' => $request->header('referer'), // Referrer
    'timestamp' => Carbon::now(), // Set timestamp to current time (exact second)
];

// Find or create a log and increment the count
$requestLog = SysRequestLog::where('ip_address', $logData['ip_address'])
    ->where('url', $logData['url'])
    ->where('method', $logData['method'])
    ->where('user_agent', $logData['user_agent'])
   // ->where('referrer', $logData['referrer'])
   // ->where('timestamp', '>=', $logData['timestamp']->subSeconds(10)->toDateTimeString()) // Convert Carbon object to string
    ->first();

//dd($requestLog, $logData);

if ($requestLog) {
    $requestLog->increment('count');
} else {
    $logData['count'] = 1;
    SysRequestLog::create($logData);
}

        return $response;
    }

    /**
     * Check if the user agent belongs to a known bot.
     *
     * @param string|null $userAgent
     * @return bool
     */
    protected function isBot($userAgent)
    {
        $botUserAgents = [
            'Googlebot', 'Bingbot', 'Slurp', 'DuckDuckBot', 'Plesk', 'Googlebot-Image/1.0', 'Baiduspider', 'YandexBot', 'Sogou', 'Exabot', 'facebot', 'ia_archiver',
            // Add more bot user agents here
        ];

        Log::info('Checking User-Agent for bot: ' . $userAgent);

        if ($userAgent) {
            foreach ($botUserAgents as $bot) {
                if (stripos($userAgent, $bot) !== false) {
                    Log::info('Bot detected: ' . $userAgent);
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Handle the bot request based on configuration.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    protected function handleBot(Request $request)
    {
        // Log the bot request
        $this->logBotRequest($request);

        // Get the bot handling action from config
        $botAction = config('bot.action', 'log'); // default action is 'log'

        switch ($botAction) {
            case 'block':
                return response('Access denied', 403);

            case 'redirect':
                return redirect()->route('home'); // Replace 'home' with your desired route

            case 'log':
            default:
                // Just log the request and proceed
                return response('Bot detected and logged', 200);
        }
    }

    /**
     * Log the bot request to the database.
     *
     * @param \Illuminate\Http\Request $request
     * @return void
     */
    protected function logBotRequest(Request $request)
    {
        SysRequestLog::create([
            'ip_address' => $request->ip(),
            'url' => $request->fullUrl(),
            'method' => $request->method(),
            'user_agent' => $request->header('User-Agent'),
            'timestamp' => Carbon::now()->startOfMinute(),
            'is_bot' => true, // Assuming you have an 'is_bot' column in your table
            'referrer' => $request->header('referer'), // Referrer
        ]);
    }
}
