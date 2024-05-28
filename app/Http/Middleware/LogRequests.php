<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\SysRequestLog;
use Symfony\Component\HttpFoundation\Response;

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
        $response = $next($request);

        // Log data
        $logData = [
            'ip_address' => $request->ip(),
            'url' => $request->fullUrl(),
            'method' => $request->method(),
            'user_agent' => $request->header('User-Agent'),
            'timestamp' => Carbon::now()->startOfMinute(),
        ];

        // Finde oder erstelle ein Log, und erhöhe die Zählung
        $requestLog = SysRequestLog::firstOrCreate(
            [
                'ip_address' => $logData['ip_address'],
                'url' => $logData['url'],
                'method' => $logData['method'],
                'user_agent' => $logData['user_agent'],
                'timestamp' => $logData['timestamp']
            ]
        );

        $requestLog->increment('count');

        return $response;
    }
}
