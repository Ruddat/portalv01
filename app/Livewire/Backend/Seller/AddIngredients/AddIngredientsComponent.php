<?php

namespace App\Livewire\Backend\Seller\AddIngredients;

use Livewire\Component;
use App\Models\ModProductSizes;
use App\Models\ModProductsIngredients;
use App\Models\ModProductsIngredientsPrices;

class AddIngredientsComponent extends Component
{

    public $title;
    public $category;
    public $sizes = [];
    public $active = true;
    public $minordervalue = true;
    public $sizeOptions = [];
    public $categories = []; // Initialisierung von $categories als leeres Array
    public $showIngredientForm = false;
    public $dropdownHeight = 0; // Variable zur Speicherung der Dropdown-Höhe
    public $selectedCategory = [];
    public $code_nr;
    public $max_spices = 10;
    public $base_price  = 0;
    public $ingredienttitle;
    public $price;
    public $mainSizes = [];

    protected $listeners = ['toggleForm'];



    public function mount()
    {
        // Hole alle Haupt-Größenkategorien aus der Datenbank und formatiere sie für das Dropdown-Menü
        $this->sizeOptions = ModProductSizes::where('parent', 0)->pluck('title', 'id')->toArray();
        // Lade die verfügbaren Kategorien aus der Datenbank und speichere sie in der $categories-Variable
        $this->categories = ModProductsIngredients::select('id', 'title')
        ->where('parent', 0)
        ->get();
        // Lade die Kategorien aus der Datenbank
    //    $this->loadCategories();
    $this->mainSizes = [
        1 => [
            'title' => 'pizza',
            'children' => [
                15 => '22cm',
                2 => '26cm',
                14 => '34cm',
                3 => '40cm'
            ],
            'price' => [
                15 => '1.20',
                2 => '2.50',
                14 => '3.00',
                3 => '4.00'
            ]
        ],
        // Weitere Hauptgrößen hier hinzufügen, falls erforderlich
    ];
        // Berechnen der Dropdown-Höhe und Zuweisung an die Variable
        $this->calculateDropdownHeight();

    }



    public function saveIngredientTitel()
    {

        // Validierung der Eingabefelder
        $this->validate([
            'title' => 'required',
            'sizes' => 'required',
        ], [
            'title.required' => 'The ingredient title field is required.',
            'sizes.required' => 'The sizes field is required.',
        ]);

        // Speichere die eingegebenen Daten in der Datenbank
        $ingredient = new ModProductsIngredients();
        $ingredient->parent = 0; // Setze den Wert entsprechend der Eltern-ID
        $ingredient->shop_id = 501; // Setze den Wert entsprechend der Shop-ID
        $ingredient->code_nr = ''; // Füge einen Wert hinzu, falls erforderlich
        $ingredient->sizes_category = json_encode($this->sizes); // Konvertiere die Größen in JSON
        $ingredient->max_spices = 3; // Setze den Wert entsprechend deiner Anforderungen
        $ingredient->base_price = 0; // Setze den Wert entsprechend deiner Anforderungen
        $ingredient->title = $this->title;
        $ingredient->count_as_extra = 1; // Setze den Wert entsprechend deiner Anforderungen
        $ingredient->ordering = 100000; // Setze den Wert entsprechend deiner Anforderungen
        $ingredient->published = 1; // Setze den Wert entsprechend deiner Anforderungen
        $ingredient->save();

        // Zurücksetzen der Eingabefelder nach dem Speichern
        $this->title = '';
        $this->sizes = [];
        $this->active = true;

        // Lade die Kategorien aus der Datenbank und sende sie als Event
        $this->categories = ModProductsIngredients::select('id', 'title')->get();
        $this->resetFormFields();

        $this->loadCategories();

        // Optional: Feedback anzeigen, dass das Speichern erfolgreich war
        session()->flash('success', 'Ingredient successfully saved!');
    }

    public function addIngredient()
    {



        // Validierung der Eingaben
        $this->validate([
            'ingredienttitle' => 'required',
            'code_nr' => 'required',
       //     'max_spices' => 'required|integer',
       //     'base_price' => 'required|integer',

        ], [
            'ingredienttitle.required' => 'Der Zutatenname ist erforderlich.',
            'code_nr.required' => 'Die Code-Nummer ist erforderlich.',
            'max_spices.required' => 'Die maximale Anzahl an Gewürzen ist erforderlich.',
            'max_spices.integer' => 'Die maximale Anzahl an Gewürzen muss eine ganze Zahl sein.',

        ]);

// Überprüfen, ob $this->max_spices einen gültigen Integer-Wert enthält
$maxSpices = is_numeric($this->max_spices) ? $this->max_spices : 0;

// Überprüfen, ob $this->base_price einen gültigen Integer-Wert enthält
$basePrice = is_numeric($this->base_price) ? $this->base_price : 0;

// Speichern der Zutatendaten in der Datenbank
$ingredient = ModProductsIngredients::create([
    'parent' => $this->selectedCategory,
    'title' => $this->ingredienttitle,
    'code_nr' => $this->code_nr,
    'max_spices' => $maxSpices,
    'base_price' => $basePrice,
    'published' => $this->active,
    'ordering' => 100000, // Integer-Wert ohne Anführungszeichen
    'shop_id' => 501, // Integer-Wert ohne Anführungszeichen
]);





//dd($this->mainSizes);


// Neues Array für die Preise initialisieren
// Neues Array für die Preise initialisieren
$prices = [];

// Überprüfen, ob die Zutat erfolgreich gespeichert wurde
if ($ingredient) {
    // Speichern der Preise für die Zutatengrößen in der Datenbank
    foreach ($this->mainSizes as $mainSize) {
        // Überprüfen, ob die Hauptgröße eine Preisliste hat
        if (isset($mainSize['price'])) {
            // Durchlaufen der Preisliste und Speichern in der Datenbank
            foreach ($mainSize['price'] as $sizeId => $price) {
                // Speichern des Preises für die Größe in der Datenbank
                ModProductsIngredientsPrices::create([
                    'parent' => $ingredient->id,
                    'size_id' => $sizeId,
                    'price' => $price,
                ]);
            }
        }
    }
}



        // Optional: Feedback anzeigen, dass das Speichern erfolgreich war
        session()->flash('success', 'Zutat erfolgreich gespeichert!');
        $this->loadCategories();
        // Zurücksetzen der Eingabefelder nach dem Speichern
        $this->resetFormFields();
    }


    public function updatedCategory($value)
    {
        // Umschalten des showIngredientForm-Flags basierend auf der ausgewählten Kategorie
        $this->showIngredientForm = !empty($value);

        // Rufen Sie die Methode selectedCategory() auf, wenn die Kategorie aktualisiert wird
        $this->selectedCategory();
    }


    public function resetFormFields()
    {
        // Zurücksetzen der Formularfelder
        $this->title = '';
        $this->category = '';
        $this->sizes = [];
        $this->active = true;
        $this->showIngredientForm = false;
        $this->code_nr = '';
        $this->max_spices = 3;
        $this->base_price = 0.00;
        $this->ingredienttitle = '';
    }

    public function loadCategories()
    {
        // Lade die Zutatenkategorien aus der Datenbank
        $this->categories = ModProductsIngredients::select('id', 'title', 'sizes_category')
        ->where('parent', 0)
        ->get();
        // Überprüfen, ob eine Kategorie ausgewählt wurde
        if ($this->selectedCategory) {
            // Lade die ausgewählte Kategorie aus der Datenbank
            $category = ModProductsIngredients::find($this->selectedCategory);

            // Überprüfen, ob die Kategorie gefunden wurde
            if ($category) {
                // Extrahiere die IDs der Hauptgrößen aus der sizes_category der ausgewählten Kategorie
                $sizeIds = $category->sizes_category;

                // Lade die Hauptgrößen aus der Datenbank basierend auf den IDs
                $mainSizes = ModProductSizes::whereIn('id', json_decode($sizeIds))
                    ->where('parent', 0) // Filtere nach Hauptgrößen (parent = 0)
                    ->pluck('title', 'id')
                    ->toArray();

                // Iteriere über jede Hauptgröße, um die zugehörigen Childgrößen zu laden
                foreach ($mainSizes as $mainSizeId => $mainSizeTitle) {
                    // Lade die Childgrößen für jede Hauptgröße
                    $childSizes = ModProductSizes::where('parent', $mainSizeId)
                        ->orderBy('ordering') // Sortieren nach der 'ordering'-Spalte
                        ->pluck('title', 'id')
                        ->toArray();

                    // Füge die Childgrößen zur Hauptgröße hinzu
                    $mainSizes[$mainSizeId] = [
                        'title' => $mainSizeTitle,
                        'children' => $childSizes,
                    ];
                }

                // Speichere die Hauptgrößen und ihre Childgrößen
                $this->mainSizes = $mainSizes;

            }

        }

      //  dd($this->mainSizes);
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


    public function selectedCategory()
    {

        dd('ich bin hier');

    // Suche die ausgewählte Kategorie
    $selectedCategory = $this->categories->firstWhere('id', $this->category);
dd($selectedCategory);
    // Wenn eine Kategorie gefunden wurde und sie Größen hat
    if ($selectedCategory && isset($selectedCategory->sizes)) {
        // Setze die Größen der ausgewählten Kategorie
        $this->sizes = $selectedCategory->sizes;
    }
    }




    public function render()
    {


        return view('livewire.backend.seller.add-ingredients.add-ingredients-component');
    }
}
