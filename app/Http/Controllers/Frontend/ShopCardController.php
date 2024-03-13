<?php

namespace App\Http\Controllers\Frontend;

use App\Models\ModShop;
use App\Models\ModCategory;
use App\Models\ModProducts;
use Illuminate\Http\Request;
use App\Models\ModProductSizes;
use App\Http\Controllers\Controller;
use App\Models\ModProductSizesPrices;

class ShopCardController extends Controller
{
    //



    public function index($restaurantId)
    {
        // Restaurant anhand der ID finden
        $restaurant = ModShop::findOrFail($restaurantId);

        if ($restaurant) {
            // Produkte des Geschäfts mit den dazugehörigen Kategorien abrufen
            $productsByCategory = [];

            // Kategorien des Shops abrufen
            $categories = ModCategory::where('shop_id', $restaurant->id)
                            ->where('show_in_list', true)
                            ->where('published', true)
                            ->orderBy('ordering')
                            ->get();

            // Für jede Kategorie die entsprechenden Produkte abrufen und zuweisen
            foreach ($categories as $category) {
                // Produkte der Kategorie abrufen und nach deinem Kriterium sortieren
                $products = ModProducts::where('shop_id', $restaurant->id)
                                        ->where('category_id', $category->id)
                                        ->where('product_published', true)
                                        ->orderBy('product_ordering', 'ASC')
                                        ->get();


             //   dd($products);
                // Für jedes Produkt den richtigen Preis abrufen und zuweisen
                foreach ($products as $product) {
                    // Hier wird die Methode getProductPrice aufgerufen, um den Preis für das aktuelle Produkt abzurufen
                    $product->minPrice = $this->getProductPrice($product->id);
                }

                $productsByCategory[$category->category_name] = $products;
            }
//dd($restaurant);
            // Restaurant gefunden, geben Sie die Detailansicht zurück
            return view('frontend.pages.detailrestaurant.detail-restaurant', [
                'restaurant' => $restaurant,
                'categories' => $categories,
                'productsByCategory' => $productsByCategory, // Übergeben Sie die Produkte nach Kategorien an die Blade-Vorlage
            ]);
        } else {
            // Restaurant nicht gefunden, geben Sie eine Fehlermeldung zurück oder leiten Sie weiter
            return redirect()->route('home')->with('error', 'Restaurant nicht gefunden.');
        }
    }

    // Methode zur Bestimmung des richtigen Preises für ein Produkt
    public function getProductPrice($productId)
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
