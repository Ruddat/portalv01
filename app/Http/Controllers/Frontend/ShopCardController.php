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

                // Für jedes Produkt die Preise abrufen und den günstigsten Preis bestimmen
                foreach ($products as $product) {
                    $productSizes = ModProductSizes::where('parent', $product->id)->get();

                    // Sammeln aller Preise
                    $allPrices = collect();
                    foreach ($productSizes as $productSize) {
                        $prices = ModProductSizesPrices::where('size_id', $productSize->id)->pluck('price');
                        $allPrices = $allPrices->merge($prices);
                    }

                    // Bestimmen des günstigsten Preises
                    $minPrice = $allPrices->min();
                    $product->minPrice = $minPrice;
                }

                $productsByCategory[$category->category_name] = $products;
            }

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








}
