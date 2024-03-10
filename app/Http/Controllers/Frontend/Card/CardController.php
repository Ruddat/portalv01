<?php

namespace App\Http\Controllers\Frontend\Card;

use App\Models\ModProducts;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;

class CardController extends Controller
{
    //


    public function addCard(Request $request)
    {
        // Validierung der Anfrage
        $request->validate([
            'productId' => 'required|exists:mod_products,id',
            // Weitere Validierungsregeln können hier hinzugefügt werden
        ]);

        // Produkt-ID aus der Anfrage abrufen
        $productId = $request->productId;

        // Dummy-Preis setzen
        $price = 10.99; // Beispielwert, bitte anpassen

        // Produktname aus der Datenbank abrufen (hier ist ein Beispiel, bitte an Ihre Implementierung anpassen)
        $productName = ModProducts::findOrFail($productId)->product_title;

        // Produkt zum Warenkorb hinzufügen
        Cart::add($productId, $productName, 1, $price);

        // Inhalt des Warenkorbs abrufen
        $cartContent = Cart::content();

        // Debuggen
        //dd('Product added to cart successfully.', $cartContent);
        return redirect()->back()->with('success', 'Product added to cart successfully.');
//        return redirect($productUrl)->with('success', 'Product added to cart successfully.');

    }
}
