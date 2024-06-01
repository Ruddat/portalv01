<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\SysRequestLog;
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
      //  Log::info('Processing request: ' . $request->fullUrl());

        // Bot detection
        if ($this->isBot($request->header('User-Agent'))) {
        //    Log::info('Bot detected: ' . $request->header('User-Agent'));
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
            ->first();

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
        $botPatterns = [
            '/Googlebot/i', '/Bingbot/i', '/Slurp/i', '/DuckDuckBot/i', '/Plesk/i', '/Googlebot-Image\/1.0/i', '/Baiduspider/i', '/YandexBot/i', '/Sogou/i', '/Exabot/i', '/facebot/i', '/ia_archiver/i', '/YandexWebmaster/i',
            // Add more bot patterns here
        ];

        Log::info('Checking User-Agent for bot: ' . $userAgent);

        if ($userAgent) {
            foreach ($botPatterns as $pattern) {
                if (preg_match($pattern, $userAgent)) {
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
        Log::info('Handling bot request: ' . $request->fullUrl());

        // Log the bot request
        $this->logBotRequest($request);

        // Get the bot handling action from config
        $botAction = config('bot.action', 'log'); // default action is 'log'

        switch ($botAction) {
            case 'block':
                Log::info('Bot request blocked.');
                return response('Access denied', 403);

            case 'redirect':
                Log::info('Bot request redirected.');
                return redirect()->route('home'); // Replace 'home' with your desired route

            case 'log':
            default:
                Log::info('Bot request logged.');
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

        Log::info('Saving bot request: ' . $request->header('User-Agent'));

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
