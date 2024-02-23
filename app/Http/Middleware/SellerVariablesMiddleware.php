<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\ModShop;
use Illuminate\Http\Request;

class SellerVariablesMiddleware
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
        $currentShopId = $request->query('id');
        $shop = ModShop::find($currentShopId);

        // Überprüfen, ob ein gültiger Shop gefunden wurde
        if ($shop) {
            // Variablen für alle Views verfügbar machen
            view()->share('currentShopId', $currentShopId);
            view()->share('shop', $shop);
        } else {
            // Wenn kein gültiger Shop gefunden wurde, setzen Sie $shop auf null
            view()->share('currentShopId', null);
            view()->share('shop', null);
        }

        return $next($request);
    }
}
