<?php

namespace App\Http\Middleware;


use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Http\Middleware\PreventRequestsDuringMaintenance as Middleware;

class PreventRequestsDuringMaintenance extends Middleware
{
    /**
     * The URIs that should be reachable while maintenance mode is enabled.
     *
     * @var array<int, string>
     */
    protected $except = [
        'subscribe-comming-soon',
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        foreach ($this->except as $except) {
            if ($request->is($except)) {
                Log::info('Maintenance mode bypassed for: ' . $request->path());
                return $next($request);
            }
        }

      //  Log::info('Maintenance mode active for: ' . $request->path());
        return parent::handle($request, $next);
    }
}
