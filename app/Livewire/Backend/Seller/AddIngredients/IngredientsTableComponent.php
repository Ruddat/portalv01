<?php

namespace App\Livewire\Backend\Seller\AddIngredients;

use Livewire\Component;
use App\Models\ModProductSizes;
use App\Models\ModProductsIngredients;
use Illuminate\Support\Facades\Session;
use App\Models\ModProductIngredientsNodes;
use App\Models\ModProductsIngredientsPrices;

class IngredientsTableComponent extends Component
{


    public $categoriesWithChildrenAndPrices;

    public function mount()
    {
        // Shop-ID aus der Session abrufen
        $shopId = Session::get('currentShopId');

        // Hauptkategorien aus der Datenbank abrufen
        $mainCategories = ModProductsIngredients::where('parent', 0)
            ->where('shop_id', $shopId)
            ->get();

        // Array für Hauptkategorien und ihre Unterkategorien initialisieren
        $categoriesWithChildrenAndPrices = [];

        // Für jede Hauptkategorie die entsprechenden Unterkategorien und Preise finden und speichern
        foreach ($mainCategories as $mainCategory) {
            $children = ModProductsIngredients::where('parent', $mainCategory->id)
                ->where('shop_id', $shopId)
                ->get();

            // Array für Unterkategorien und ihre Preise initialisieren
            $childrenWithPrices = [];
            foreach ($children as $child) {
                // Preise für jede Zutat abrufen
                $prices = ModProductsIngredientsPrices::where('parent', $child->id)
                    ->where('shop_id', $shopId)
                    ->get();

                // Array für size_ids initialisieren
                $sizeIds = [];
                foreach ($prices as $price) {
                    // Größe (size_id) für jeden Preis speichern
                    $sizeIds[] = $price->size_id;
                }

                // Titel für jede Zutat abrufen
                $childSizes = ModProductSizes::whereIn('id', $sizeIds)
                    ->where('shop_id', $shopId)
                    ->get();

                // Array für Titel initialisieren
                $titles = [];
                foreach ($childSizes as $size) {
                    $titles[$size->id] = $size->title;
                }

                $childrenWithPrices[$child->id] = [
                    'ingredient' => $child,
                    'prices' => $prices,
                    'titles' => $titles,
                ];
            }

            $categoriesWithChildrenAndPrices[$mainCategory->id] = [
                'main' => $mainCategory,
                'children' => $childrenWithPrices,
            ];
        }

        $this->categoriesWithChildrenAndPrices = $categoriesWithChildrenAndPrices;
    }

    public function deleteCategoryWithIngredients($mainCategoryId)
    {
        // Zuerst alle Zutaten löschen, die zur Hauptkategorie gehören
        ModProductsIngredients::where('parent', $mainCategoryId)->delete();

        // Dann die Preise der gelöschten Zutaten löschen
        ModProductsIngredientsPrices::whereIn('size_id', function($query) use ($mainCategoryId) {
            $query->select('id')->from('mod_products_ingredients')->where('parent', $mainCategoryId);
        })->delete();

        // Anschließend die Zuordnungen von Zutaten zu Kategorien löschen
        ModProductIngredientsNodes::where('ingredients_id', $mainCategoryId)->delete();

        // Schließlich die Hauptkategorie selbst löschen
        ModProductsIngredients::where('id', $mainCategoryId)->delete();

        // Erfolgreich gelöscht, eine Benachrichtigung anzeigen oder andere Aktionen ausführen
        session()->flash('success', 'Category and its ingredients deleted successfully.');
    }


    public function deleteIngredient($mainCategoryId, $childId)
    {
        // Hier können Sie die Logik zum Löschen der Zutat implementieren
        // Verwenden Sie $mainCategoryId und $childId, um die richtige Zutat zu identifizieren und zu löschen
        // Aktualisieren Sie dann die $categoriesWithChildrenAndPrices-Daten, um die gelöschte Zutat zu entfernen
        // Zutat löschen
        ModProductsIngredients::where('id', $childId)->delete();

       //dd($childId);

       // Zugehörige Preise löschen
        ModProductsIngredientsPrices::where('parent', $childId)->delete();

               // Erfolgreich gelöscht, eine Benachrichtigung anzeigen oder andere Aktionen ausführen
               session()->flash('success', 'Ingredient deleted successfully.');

        // dd('Loeschen ');
    }










    public function render()
    {
        return view('livewire.backend.seller.add-ingredients.ingredients-table-component', [
            'categoriesWithChildrenAndPrices' => $this->categoriesWithChildrenAndPrices,
        ]);
    }
}
