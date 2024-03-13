<?php

namespace App\Http\Controllers\Frontend\Cart;

use App\Models\ModShop;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    //

    public function index($restaurantId)
    {

        // Abrufen der Shop-Daten anhand der ID oder eine Fehlermeldung anzeigen, falls nicht gefunden
        $shopData = ModShop::findOrFail($restaurantId);

        // Debugging-Ausgabe, um zu überprüfen, ob die Daten abgerufen wurden
     //   dd($shopData);

        return view('frontend.pages.cart.order', compact('restaurantId', 'shopData'));
    }
}
