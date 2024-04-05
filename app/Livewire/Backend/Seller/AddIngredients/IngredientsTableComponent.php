<?php

namespace App\Livewire\Backend\Seller\AddIngredients;

use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\ModProductSizes;
use App\Models\ModProductsIngredients;
use Illuminate\Support\Facades\Session;
use App\Models\ModProductIngredientsNodes;
use App\Models\ModProductsIngredientsPrices;

class IngredientsTableComponent extends Component
{


    public $categoriesWithChildrenAndPrices;
    public $editMode = false; // Variable für den Bearbeitungsmodus
    public $dropdownHeight = 0;
    public $sizeOptions = [];
    public $selectedSizeIds = []; // Array für ausgewählte Größen
    public $ingredientSizes = [];
    public $title;
    public $sizes = [];
    public $active;
    public $ingredientsSizes;
    public $sizes_category;
    public  $published;
    public $selectedIngredientId;
   // public $shopId;

    public function mount()
    {
        // Shop-ID aus der Session abrufen
        $shopId = Session::get('currentShopId');

        // Hauptkategorien aus der Datenbank abrufen
        $mainCategories = ModProductsIngredients::where('parent', 0)
            ->where('shop_id', $shopId)
            ->get();

          //  $this->sizes = [1, 27];


    // Hole alle Haupt-Größenkategorien aus der Datenbank und formatiere sie für das Dropdown-Menü
    $this->sizeOptions = ModProductSizes::where('parent', 0)
    ->where('shop_id', $shopId) // Hinzufügen der Bedingung für shop_id
    ->pluck('title', 'id')
    ->toArray();

    $this->calculateDropdownHeight();

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


    public function editCategoryIngredientsName($mainCategoryId)
    {

        $this->selectedIngredientId = $mainCategoryId;

        $this->loadIngredientData($mainCategoryId);


        // Blade-Template mit dem Formular zum Bearbeiten des Namens der Zutat anzeigen
       // return view('livewire.backend.seller.add-ingredients.edit-ingredient-name', compact('ingredient'));
    }


    public function updateIngredientName() 
    {
    // Validiere die Eingaben
    $validatedData = $this->validate([
        'title' => 'required',
        'sizes' => 'required|array',
    ]);

    // Zugriff auf die validierten Daten
    $title = $validatedData['title'];
    $sizes = $validatedData['sizes'];

//dd($title, $sizes, $this->published);


       // Suchen Sie den entsprechenden ModProductsIngredients-Eintrag basierend auf der Zutat "id"
        $ingredient = ModProductsIngredients::findOrFail($this->selectedIngredientId);
        //dd($ingredient);
        // Aktualisieren Sie die relevanten Datenfelder basierend auf den Änderungen
        $ingredient->title = $this->title;
        $ingredient->sizes_category = json_encode($this->sizes);
        $ingredient->published = $this->published; // Verwenden Sie den Wert der published-Variable aus der Komponente

        // Speichern Sie die Änderungen
        $ingredient->save();





        $this->editMode = false;


//dd($this->request);



        // Erfolgsmeldung anzeigen
        session()->flash('success', 'Zutat erfolgreich aktualisiert.');

        // Zurück zur vorherigen Seite
        return redirect()->back();
    }


    public function loadIngredientData($ingredientId)
    {
        $shopId = Session::get('currentShopId');

        // Lade die Daten des Ingredients aus der Datenbank
        $ingredient = ModProductsIngredients::findOrFail($ingredientId);

        // Lade die Größenoptionen für das Dropdown-Menü
        $productSizes = ModProductSizes::where('parent', 0)
            ->where('shop_id', $shopId)
            ->pluck('title', 'id')
            ->toArray();

        // Speichere die Größenoptionen in der sizeOptions-Variable
        $this->sizeOptions = $productSizes;

        // Setze die Daten für das Bearbeitungsformular
        $this->title = $ingredient->title;

        // Dekodiere die ausgewählten Größen des Ingredients aus der Spalte sizes_category
        $selectedSizes = json_decode($ingredient->sizes_category);

        // Iteriere über die ausgewählten Größen und setze sie im $this->sizes Array auf true
        $selectedSizeIds = [];
        foreach ($selectedSizes as $sizeId) {
            $selectedSizeIds[$sizeId] = true;
        }

        // Setze die ausgewählten Größen für das Dropdown-Menü
        $this->ingredientSizes = $selectedSizeIds;

        // Setze den Status "published" für die Checkbox
        $this->published = $ingredient->published;

        //   dd($selectedSizeIds);

        // Aktiviere den Bearbeitungsmodus
        $this->editMode = true;
    }






    public function calculateDropdownHeight()
    {
        $optionCount = count($this->sizeOptions); // Anzahl der Optionen im Dropdown-Menü
        $defaultOptionHeight = 26; // Standardhöhe für eine Option in Pixeln
        $maxHeight = 400; // Maximal zulässige Höhe in Pixeln

        // Berechnen der Höhe basierend auf der Anzahl der Optionen
        $this->dropdownHeight = min($optionCount * $defaultOptionHeight, $maxHeight);

      //  dd($this->dropdownHeight);
    }





    public function render()
    {
        if ($this->editMode) {
            // Wenn der Bearbeitungsmodus aktiviert ist, zeige das Bearbeitungsformular an
            //$this->sizes = [1, 27];
            $this->sizes = array_keys($this->ingredientSizes);
           // $this->selectedSizeIds;

            return view('livewire.backend.seller.add-ingredients.edit-ingredient-name');

        } else {
            // Ansonsten zeige das normale Tabellen-Blade-Template an
            return view('livewire.backend.seller.add-ingredients.ingredients-table-component', [
                'categoriesWithChildrenAndPrices' => $this->categoriesWithChildrenAndPrices,
            ]);
        }
    }
}
