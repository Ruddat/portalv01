<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\ModShop;
use Illuminate\Http\Request;
use App\Models\ModSellerDomains;

class DomainToShopMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $domain = $request->getHost();

        // Überprüfe, ob die Domain in der Tabelle `mod_seller_domains` existiert
        $shopDomain = ModSellerDomains::where('domain', $domain)->first();

        if ($shopDomain) {
            $shopId = $shopDomain->shop_id;
            // Setze den Shop in die Session oder in den Request, um später darauf zuzugreifen
            $request->attributes->set('shopId', $shopId);
        }

        return $next($request);
    }
}
