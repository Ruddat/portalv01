<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\SysRequestLog;
use Illuminate\Support\Facades\Log;

class LogRequests
{
    public function handle(Request $request, Closure $next)
    {
        // Protokolliere jede Anfrage, unabhängig von der Art
        $this->logRequest($request);

        return $next($request);
    }

    protected function logRequest(Request $request)
    {
        SysRequestLog::create([
            'ip_address' => $request->ip(),
            'url' => $request->fullUrl(),
            'method' => $request->method(),
            'user_agent' => $request->header('User-Agent'),
            'referrer' => $request->header('referer'), // Referrer
            'timestamp' => Carbon::now(),
        ]);
    }
}
