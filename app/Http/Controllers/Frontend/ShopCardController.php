<?php

namespace App\Http\Controllers\Frontend;

use Livewire\Livewire;
use App\Models\ModShop;
use App\Models\ModCategory;
use App\Models\ModProducts;
use Illuminate\Http\Request;
use App\Models\ModProductSizes;
use App\Http\Controllers\Controller;
use App\Models\ModProductSizesPrices;
use App\Livewire\Frontend\Card\ProductList;

class ShopCardController extends Controller
{
    //



    public function index($restaurantId)
    {

                // Erstelle eine Instanz des Livewire-Controllers und rufe die Methode `mount` auf, um die Daten zu laden
                $productList = app()->call(ProductList::class . '@mount', ['restaurantId' => $restaurantId]);

                // Jetzt kannst du auf die geladenen Daten zugreifen
                 $restaurant = $productList->restaurant;
            //    $categories = $productList->categories;
            //    $productsByCategory = $productList->productsByCategory;

                // Restaurant gefunden, geben Sie die Detailansicht zurück
                return view('frontend.pages.detailrestaurant.detail-restaurant', compact('productList'));

    }

    // Methode zur Bestimmung des richtigen Preises für ein Produkt
    private function getProductPrice($productId)
    {
        // Basispreis des Produkts abrufen
        $basePrice = ModProducts::find($productId)->base_price;


        // Wenn ein Basispreis vorhanden ist und größer als 0 ist, diesen zurückgeben
        if ($basePrice > 0) {
        return $basePrice;
        }


        // Ansonsten den günstigsten Preis der Produktgrößen zurückgeben
        $productSizesPrices = ModProductSizesPrices::where('parent', $productId)->pluck('price')->toArray();


        // Wenn Produktgrößen-Preise vorhanden sind, den günstigsten Preis zurückgeben
        if (!empty($productSizesPrices)) {
            return min($productSizesPrices);
        }

        // Falls keine Preise gefunden werden, Standardwert oder Null zurückgeben
        return 0;
    }








}
