<?php

namespace App\Http\Controllers\Frontend\Cart;

use App\Facades\Cart;
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
// dd($shopData);
        // Überprüfen, ob der Warenkorb leer ist
        // Überprüfen, ob der Warenkorb leer ist
    // Überprüfen, ob der Warenkorb leer ist
    if (Cart::isEmpty()) {
        // Wenn der Warenkorb leer ist, zeige eine Meldung an und bleibe auf derselben Seite
      //  session()->flash('info', 'Der Seller wurde nicht gefunden.');
        return back()->with('info', 'Ihr Warenkorb ist leer.');
    }

        // Wenn der Warenkorb nicht leer ist, fahren Sie mit der normalen Logik fort und geben Sie die Ansicht zurück
        return view('frontend.pages.cart.order', compact('restaurantId', 'shopData'));
    }
}
