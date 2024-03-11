<?php

namespace App\Livewire\Frontend\Card;

use App\Models\ModShop;
use Livewire\Component;
use App\Models\ModCategory;
use App\Models\ModProducts;
use App\Models\ModProductSizesPrices;

class ProductList extends Component
{
    public $restaurantId;
    public $restaurant;
    public $categories;
    public $productsByCategory;

    public function mount($restaurantId)
    {
        $this->restaurantId = $restaurantId;

       // dd($this->restaurantId);
        $this->loadData();
    }

    public function loadData()
    {
        // Restaurant anhand der ID finden
        $this->restaurant = ModShop::findOrFail($this->restaurantId);

        if ($this->restaurant) {
            // Produkte des Geschäfts mit den dazugehörigen Kategorien abrufen
            $this->productsByCategory = [];

            // Kategorien des Shops abrufen
            $this->categories = ModCategory::where('shop_id', $this->restaurant->id)
                            ->where('show_in_list', true)
                            ->where('published', true)
                            ->orderBy('ordering')
                            ->get();

            // Für jede Kategorie die entsprechenden Produkte abrufen und zuweisen
            foreach ($this->categories as $category) {
                // Produkte der Kategorie abrufen und nach deinem Kriterium sortieren
                $products = ModProducts::where('shop_id', $this->restaurant->id)
                                        ->where('category_id', $category->id)
                                        ->where('product_published', true)
                                        ->orderBy('product_ordering', 'ASC')
                                        ->get();

                // Für jedes Produkt den richtigen Preis abrufen und zuweisen
                foreach ($products as $product) {
                    // Hier wird die Methode getProductPrice aufgerufen, um den Preis für das aktuelle Produkt abzurufen
                    $product->minPrice = $this->getProductPrice($product->id);
                }

                $this->productsByCategory[$category->category_name] = $products;
            }
        }
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

    public function render()
    {
        return view('livewire.frontend.card.product-list');
    }
}
