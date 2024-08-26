<?php

namespace App\Livewire\Frontend\Product;

use App\Facades\Cart;
use App\Models\ModShop;
use Livewire\Component;
use App\Models\ModBottles;
use App\Models\ModCategory;
use App\Models\ModProducts;
use App\Models\ModAdditives;
use App\Models\ModAllergens;
use App\Services\CartService;
use App\Models\ModProductSizes;
use Illuminate\Support\Facades\DB;
use LivewireUI\Modal\ModalComponent;
use App\Models\ModProductSizesPrices;
use App\Models\ModProductIngredientsNodes;
use App\Http\Controllers\Frontend\ShopCardController;

class Index extends Component
{
    public $restaurant, $productsByCategory, $categories, $minPrices, $sizesWithPrices;
    public $product;
    public $quantity;
    public $productId;
    public $productCode;
    public $productName;
    public $productPrice;
    public $selectedSize;
    public $selectedSizeId;

    protected $total;
    protected $content;
    protected $listeners = [
        'productAddedToCart' => 'updateCart',
        'add-to-cart-option' => 'addToCartOption',
        'closeModal' => 'closeModal',
        'showProductModal' => 'showProductModal',
        'open-product-modal' => 'open-product-modal',
    ];


    public $selectedPrice;
    public $selectedIngredients = [];
    public $data;

    public $options = [];


    protected $cartService;


    // Modal
    public $isOpen = false;
    public $isLoading = false;
    public $showOverlay = false;
    public $productTitle;
    public $productDescription;
    public $getIngredientData;
    public $productSize;
    public $additives;
    public $allergens;
    public $openIngredients = [];
    public $selectedQuantity = 1;
    public $disableAddToCartButton;
    public $minIngredients;
    public $freeIngredients = []; // Neue öffentliche Eigenschaft für kostenlose Zutaten



    /**
     * Initialize the component with required data.
     *
     * @param  mixed  $restaurant
     * @param  mixed  $categories
     * @param  mixed  $productsByCategory
     * @param  \App\Services\CartService  $cartService
     * @return void
     */
    public function mount($restaurant, $categories, $productsByCategory, CartService $cartService)
    {
        $this->restaurant = $restaurant;
        $this->categories = $categories;
        $this->productsByCategory = $productsByCategory;
        $this->cartService = $cartService;
        $this->selectedSize = null;

        // Annahme: $allIngredientIds enthält alle Zutaten-IDs aus deiner Datenquelle
        $allIngredientIds = [/* Hier kommen deine Zutaten-IDs */];

        // Setze alle Zutaten als geöffnet
        $this->openIngredients = $allIngredientIds;

        // Abrufen und Eintragen der Zutaten-IDs
        $this->openIngredients = $this->getAllIngredientNodesIds($restaurant);
        // Calculate and store minimum prices for each product
        $this->minPrices = $this->calculateMinPrices();
        $this->updateCart();
    }



    private function getAllIngredientNodesIds($restaurant)
    {
        // Annahme: Hier wird die Logik implementiert, um alle eindeutigen Zutaten-IDs basierend auf der shop_id abzurufen
        $ingredientNodesIds = ModProductIngredientsNodes::where('shop_id', $restaurant->id)
            ->distinct('ingredients_id') // Nur eindeutige Zutaten-IDs auswählen
            ->pluck('ingredients_id')
            ->toArray();
        return $ingredientNodesIds;
    }



    public function addToCartNew($productId, $productName, $selectedPrice, $selectedSize, $selectedSizeId, $selectedQuantity)
    {
        // Produkt aus der Datenbank abrufen
        $product = ModProducts::find($productId);

        // Überprüfen, ob das Produkt gefunden wurde
        if (!$product) {
            // Fehler behandeln, wenn das Produkt nicht gefunden wurde
            $this->dispatch('toast', message: 'Das Produkt konnte nicht gefunden werden. Bitte versuchen Sie es später erneut.', notify:'error');
            return;
        }

        // Optionen für das Produkt abrufen
        $options = DB::table('mod_product_ingredients_nodes')->where('parent', $productId)->get();

        // Überprüfen, ob das Produkt Optionen hat
        if ($options->isNotEmpty()) {
            // Überprüfen, ob mindestens eine Option aktiv ist
            $hasActiveOptions = $options->contains('active', 1);

            // Wenn mindestens eine Option aktiv ist, bereiten Sie die Produktoptionen vor
            if ($hasActiveOptions) {
                $this->prepareProductOptions($productId, $selectedSize, $selectedPrice, $productName, $product);
                // $this->dispatch('toast', message: 'Dieses Produkt hat Optionen. Bitte wählen Sie eine Option aus.', notify:'success' );
                return;
            }
        }




        // Wenn das Produkt keine Optionen hat, fügen Sie es mit dem Basispreis zum Warenkorb hinzu
        $price = $product->base_price;
        // Hier können weitere Logiken zur Preisberechnung implementiert werden, wenn nötig

        // Fügen Sie das Produkt automatisch dem Warenkorb hinzu
        $uniqueIdentifier = rand(100000, 999999);
        $extendedProductId = $productId . '' . $uniqueIdentifier;
        $sizeTitle = ModProductSizes::where('id', $selectedSize)->first();
//dd($sizeTitle);


// Optionen für das Produkt
$options = [];

// Annahme: Standardgröße, wenn keine Größen verfügbar sind
$size = 'standard';

// Annahme: Standardmenge
$quantity = '1';

$bottles = $product->bottles_id;

if ($bottles) {
    $bottlesPrices = ModBottles::where('id', $bottles)->first();
    if ($bottlesPrices) {
        // Füge die Produktoptionen zum $options-Array hinzu
        $options[] = [
            'productCode' => 'deposit',
            'productName' => $bottlesPrices->bottles_title,
            'price' => $bottlesPrices->bottles_value,
            'size' => $size,
            'quantity' => $quantity,
        ];
        // Erhöhe den Preis um $additionalPrice
        $selectedPrice += $bottlesPrices->bottles_value;
    }
}


// 1. Daten aus mod_products abrufen
$product = DB::table('mod_products')->where('id', $productId)->first();

if ($product) {
    // 2. Kategorie anhand der category_id finden
    $category = DB::table('mod_categories')->where('id', $product->category_id)->first();

    if ($category) {
        // 3. Überprüfe, ob sizes_category null ist
        if ($category->sizes_category === null) {
            // Größe ist null, ersetze den Inhalt von $sizeTitle->title durch "Standard"
            $sizeTitle->title = "Standard";
        }
    }
}


    //dd($options);
   // dd($extendedProductId, $productName, $selectedPrice, $sizeTitle->title, $selectedQuantity, $productId, $options);
   $productData = ModProducts::where('id', $productId)->first();
   dd($productData->product_code);
        // Produkt zum Warenkorb hinzufügen
        Cart::add($extendedProductId, $productName, $selectedPrice, $sizeTitle->title, $selectedQuantity, $productId, $options);

        // Erfolgsmeldung anzeigen
        $this->dispatch('toast', message: 'Das Produkt wurde zum Warenkorb hinzugefügt.', notify:'success');

        // Ereignis auslösen, um die Benutzeroberfläche zu aktualisieren
        $this->dispatch('productAddedToCart');
    }



    /**
    * Vorbereitet Produktoptionen und verarbeitet die entsprechenden Aktionen je nach Produktkonfiguration.
    *
    * @param int $productId Die ID des Produkts.
    * @param float $selectedSize Die ausgewählte Größe des Produkts.
    * @param float $selectedPrice Der ausgewählte Preis des Produkts.
 * @param string $productName Der Name des Produkts.
 * @param mixed $product Das Produktobjekt aus der Datenbank.
 * @return void
 */
public function prepareProductOptions($productId, $selectedSize, $selectedPrice, $productName, $product)
{
    // Optionen für das Produkt abrufen
    $options = DB::table('mod_product_ingredients_nodes')
        ->where('parent', $productId)
        ->where('active', true) // Annahme: 'active' ist die Spalte, die den aktiven Zustand angibt
        ->get();

    // Überprüfen, ob das Produkt Optionen hat
    if ($options->isNotEmpty()) {
        // Produkt hat Optionen
        // Extrahiere und bereite die Optionen für die Verarbeitung vor
        $preparedOptions = $this->prepareOptions($productId, $selectedPrice, $selectedSize);

        // Extrahiere und bereite Zutaten für die Optionen vor
        $preparedOptionsWithIngredients = $this->prepareIngredients($preparedOptions);

        // Erhalte den Preis basierend auf den ausgewählten Optionen
        $getIngredientPrice = $this->getIngredientPrice($preparedOptionsWithIngredients, $selectedSize);

        // Zeige das Overlay für die Produktoptionen an
        $this->toggleOverlay($productId, $getIngredientPrice, $selectedPrice, $selectedSize, $productName);

        return;
    }

        // Optionen nicht vorhanden, Preise und Modal vorbereiten
    $ingredients = DB::table('mod_products_ingredients')
        ->where('parent', $productId)
        ->get();
 //   dd($ingredients);


    // Überprüfen, ob Zutaten gefunden wurden
    if ($ingredients->isNotEmpty()) {
        // Extrahiere und bereite die Zutaten für die Verarbeitung vor
        $preparedIngredients = $this->prepareIngredients($productId, $selectedPrice);

        // Bereite die Daten für das Modal vor
        $this->prepareProductModal($productId, $selectedPrice, $selectedSize, $productName, $preparedIngredients);
        return;
    }

    // Keine Optionen und keine Zutaten gefunden
    // Behandle Produkte ohne Optionen und Zutaten
    $this->handleProductWithoutOptions($productId, $selectedPrice, $selectedSize, $productName);
}


/**
 * Bereitet die Optionen für ein Produkt vor, indem die relevanten Überschriften und Zutaten aus den Nodes abgerufen werden.
 *
 * @param int $productId Die ID des Produkts.
 * @param float $selectedPrice Der ausgewählte Preis des Produkts.
 * @param int $selectedSizeId Die ID der ausgewählten Größe des Produkts.
 * @return array Ein Array mit den vorbereiteten Nodes und ihren Details.
 */
protected function prepareOptions($productId, $selectedPrice, $selectedSizeId)
{
    // Vorbereitete Nodes für das Modal
    $preparedNodes = [];

    // Nodes für das Produkt abrufen
    $nodes = DB::table('mod_product_ingredients_nodes')
        ->where('parent', $productId)
        ->where('active', true) // Annahme: 'active' ist die Spalte, die den aktiven Zustand angibt
        ->get();

    // Für jede Node
    foreach ($nodes as $node) {
        // Zutaten und Überschriften basierend auf den ingredients_id abrufen
        $ingredientsIds = [$node->ingredients_id];
        $headings = [];
        foreach ($ingredientsIds as $ingredientId) {
            // Zutat oder Überschrift abrufen
            $ingredient = DB::table('mod_products_ingredients')
                ->where('id', $ingredientId)
                ->first();

            if ($ingredient) {
                if ($ingredient->parent == 0) {
                    // Überschrift
                    $headings[] = $ingredient;
                } else {
                    // Zutat
                    $headingId = $ingredient->parent;
                    $heading = DB::table('mod_products_ingredients')
                        ->where('id', $headingId)
                        ->first();
                    if ($heading) {
                        $headings[] = $heading;
                    }
                }
            }
        }

        // Node für diese Node vorbereiten
        $preparedNode = [
            'node_id' => $node->id, // Beispiel: ID der Node für die Verwendung in der Logik
            'heading' => !empty($headings) ? $headings[count($headings) - 1]->title : '', // Annahme: Die letzte Überschrift wird als Überschrift verwendet
            'ingredient_id' => $ingredient->id, // Hier werden die Zutaten eingefügt, sobald die Logik implementiert ist
            'ingredients' => $headings, // Hier werden die Zutaten eingefügt, sobald die Logik implementiert ist
            'free_ingredients' => $node->free_ingredients,
            'min_ingredients' => $node->min_ingredients,
            'max_ingredients' => $node->max_ingredients,
        ];

        // Node zum Array der vorbereiteten Nodes hinzufügen
        $preparedNodes[] = $preparedNode;
    }

    return $preparedNodes;
}


/**
 * Bereitet die Zutaten für die vorbereiteten Optionen vor, indem die relevanten Eltern-Zutaten abgerufen werden.
 *
 * @param array $preparedOptions Ein Array mit den vorbereiteten Optionen und ihren Details.
 * @return array Ein Array mit den vorbereiteten Optionen und ihren Zutaten.
 */
protected function prepareIngredients($preparedOptions)
{
    $preparedOptionsWithIngredients = [];

    // Für jede vorbereitete Option
    foreach ($preparedOptions as $option) {
        $ingredientId = $option['ingredient_id'];

        // Eltern-Zutaten für die Option abrufen
        $parentIngredients = DB::table('mod_products_ingredients')
            ->where('parent', $ingredientId)
            ->where('published', 1)
            ->get();

        // Option mit Zutaten vorbereiten
        $optionWithIngredients = $option;
        $optionWithIngredients['ingredients'] = $parentIngredients->map(function ($ingredient) {
            return [
                'id' => $ingredient->id,
                'title' => $ingredient->title,
                'base_price' => $ingredient->base_price,
                'code_nr' => $ingredient->code_nr,
            ];
        })->toArray();

        // Option mit Zutaten zum Array der vorbereiteten Optionen mit Zutaten hinzufügen
        $preparedOptionsWithIngredients[] = $optionWithIngredients;
    }

    return $preparedOptionsWithIngredients;
}



/**
 * Ermittelt den Preis für jede Zutat basierend auf der ausgewählten Größe.
 *
 * @param array $preparedOptionsWithIngredients Ein Array mit den vorbereiteten Optionen und ihren Zutaten.
 * @param int $selectedSize Die ID der ausgewählten Größe.
 * @return array Ein Array mit den vorbereiteten Optionen, ihren Zutaten und den zugehörigen Preisen.
 */
protected function getIngredientPrice($preparedOptionsWithIngredients, $selectedSize)
{
    // Für jede vorbereitete Option
    foreach ($preparedOptionsWithIngredients as &$option) {
        // Für jede Zutat in der Option
        foreach ($option['ingredients'] as &$ingredient) {
            // Preis für die Zutat basierend auf der ausgewählten Größe abrufen
            $price = DB::table('mod_products_ingredients_prices')
                ->where('parent', $ingredient['id']) // parent ist die ingredients_id
                ->where('size_id', $selectedSize)
                ->value('price');

            // Füge den Preis zum Zutaten-Array hinzu
            $ingredient['price'] = $price;
        }
    }

    return $preparedOptionsWithIngredients;
}






    protected function handleProductWithoutOptions($productId, $selectedPrice, $selectedSize, $productName)
    {
        // Hier kannst du die Logik für Produkte ohne Optionen und Zutaten implementieren
        // Beispiel:
        // Füge das Produkt zum Warenkorb hinzu
        // Zeige eine Benachrichtigung an, dass das Produkt erfolgreich zum Warenkorb hinzugefügt wurde

dd($productId, $selectedSize, $selectedPrice, $productName);
        // Fügen Sie hier die Logik zum Hinzufügen zum Warenkorb hinzu

    }


    public function addToCartProduct($productId, $productTitle, $totalPrice, $sizeId, $selectedSize , $selectedQuantity)
    {

       $options = $this->createOptionsData();

  // dd($productId, $productId, $selectedSize, $selectedPrice, $selectedIngredients, $this->getIngredientData, $this->freeIngredients, $this->selectedIngredients);


        // Fügen Sie das Produkt automatisch dem Warenkorb hinzu
        $uniqueIdentifier = rand(100000, 999999);
        $extendedProductId = $productId . '' . $uniqueIdentifier;
        $sizeTitle = ModProductSizes::where('id', $selectedSize)->first();

      //  dd($productId, $productTitle, $totalPrice, $sizeId, $selectedSize, $selectedQuantity, $extendedProductId);
      $productData = ModProducts::where('id', $productId)->first();
      $productCode = $productData->product_code ?? 0;
        // dd($productCode);

//dd($extendedProductId, $productTitle, $totalPrice, $selectedSize, $selectedQuantity, $productId, $options);

$bottles = $productData->bottles_id;

//dd($bottles);

if ($bottles) {
    $bottlesPrices = ModBottles::where('id', $bottles)->first();

    $size = 'standard';

    // Annahme: Standardgröße
    $quantity = '1';

    if ($bottlesPrices) {
        // Füge die Produktoptionen zum $options-Array hinzu
        $options[] = [
            'productCode' => 'deposit',
            'productName' => $bottlesPrices->bottles_title,
            'price' => $bottlesPrices->bottles_value,
            'size' => $size,
            'quantity' => $quantity,
        ];
        // Erhöhe den Preis um $additionalPrice
        $totalPrice += $bottlesPrices->bottles_value;
    }
}


        // Produkt zum Warenkorb hinzufügen
        Cart::add($extendedProductId, $productTitle, $totalPrice, $selectedSize, $selectedQuantity, $productCode, $options);
      //  Cart::add($extendedProductId, $productTitle, $totalPrice, $selectedSize, $selectedQuantity, $productId, $options);
        // Erfolgsmeldung anzeigen
        $this->dispatch('toast', message: 'Das Produkt wurde zum Warenkorb hinzugefügt.', notify:'success');

        $this->closeOverlay();

        // Ereignis auslösen, um die Benutzeroberfläche zu aktualisieren
        $this->dispatch('productAddedToCart');


        // Hier kannst du die Logik implementieren, um das Produkt mit den ausgewählten Optionen zum Warenkorb hinzuzufügen
        // Zum Beispiel: $this->addToCartWithOptions($productId, $productName, $selectedPrice, $selectedSize, $selectedQuantity);

//dd('bin hier');

        // Fügen Sie hier die Logik zum Hinzufügen zum Warenkorb hinzu
    }



    public function createOptionsData()
    {
        // Optionen für das Produkt
        $options = [];

        // Annahme: Standardgröße, wenn keine Größen verfügbar sind
        $size = 'standard';

        // Annahme: Standardgröße
        $quantity = '1';

   //     dd($this->selectedIngredients, $this->freeIngredients);

// Verarbeiten der ausgewählten Zutaten
foreach ($this->selectedIngredients as $ingredient) {
    // Überprüfen, ob die Zutat eine Menge größer als 1 hat
    if ($ingredient['quantity'] > 1) {
        // Wenn die Menge größer als 1 ist, fügen Sie die Zutat entsprechend oft zu den Optionen hinzu
        for ($i = 0; $i < $ingredient['quantity']; $i++) {
            $options[] = [
                'productCode' => $ingredient['id'],
                'productName' => $ingredient['title'],
                'price' => $ingredient['price'],
                'size' => $size, // Hier könnten Sie die Größe basierend auf der Zutat anpassen, falls erforderlich
                'quantity' => '1', // Hier setzen wir die Menge immer auf 1, da wir die Zutat entsprechend oft hinzufügen
            ];
        }
    } else {
        // Wenn die Menge 1 ist, fügen Sie die Zutat einfach einmal zu den Optionen hinzu
        $options[] = [
            'productCode' => $ingredient['id'],
            'productName' => $ingredient['title'],
            'price' => $ingredient['price'],
            'size' => $size, // Hier könnten Sie die Größe basierend auf der Zutat anpassen, falls erforderlich
            'quantity' => $quantity, // Hier könnten Sie die Menge basierend auf der Zutat anpassen, falls erforderlich
        ];
    }
}

        // Verarbeiten der kostenlosen Zutaten
        foreach ($this->freeIngredients as $ingredient) {
            // Hier können Sie ähnlich wie bei den ausgewählten Zutaten die kostenlosen Zutaten verarbeiten und zu den Optionen hinzufügen
            // Beispiel:
            $options[] = [
                'productCode' => $ingredient['id'],
                'productName' => $ingredient['title'],
                'price' => 0, // Annahme: Kostenlose Zutaten haben einen Preis von 0
                'size' => $size, // Hier könnten Sie die Größe basierend auf der Zutat anpassen, falls erforderlich
                'quantity' => $quantity, // Hier könnten Sie die Menge basierend auf der Zutat anpassen, falls erforderlich
            ];
        }

//dd($options);

        return $options;
    }





    public function toggleOverlay($productId, $getIngredientPrice, $selectedPrice, $selectedSize, $productName)
    {

//dd($productName, $getIngredientPrice);
//dd($productId);
    // Produkt aus der Datenbank abrufen
    $product = ModProducts::find($productId);
//dd($product);

// 1. Konvertieren der Zeichenfolgen in Arrays
$allergenIds = json_decode($product->allergens_ids);
$additiveIds = json_decode($product->additives_ids);

// 2. Überprüfen, ob das Produkt spezifische Allergene und Zusatzstoffe hat
if (!$allergenIds && !$additiveIds) {
    // Wenn nicht, nehmen wir alle Allergene und Zusatzstoffe aus der Liste
    $allergens = ModAllergens::all();
    $additives = ModAdditives::all();
} else {
    // Wenn das Produkt spezifische Allergene und Zusatzstoffe hat,
    // extrahieren wir sie aus den verknüpften Tabellen
    $allergens = ModAllergens::whereIn('id', $allergenIds)->get();
    $additives = ModAdditives::whereIn('id', $additiveIds)->get();
}

    $productSize = ModProductSizes::where('id', $selectedSize)->first();
//dd($productSize);

    // Überprüfen, ob das Produkt gefunden wurde
    if ($product) {
        // Produktinformationen in den öffentlichen Eigenschaften speichern
        $this->productTitle = $product->product_title;
        $this->productDescription = $product->product_anonce;
        $this->productPrice = $selectedPrice;
        $this->productName = $productName;
        $this->selectedSize = $productSize->title;
        $this->selectedSizeId = $productSize->id;
        $this->productSize = $productSize->title;
        $this->productId = $productId;
       // $getIngredientData = $getIngredientPrice;
        $this->getIngredientData = $getIngredientPrice;
        $this->allergens = $allergens;
        $this->additives = $additives;


        // Überprüfen, ob mindestens eine Pflichtzutat vorhanden ist
        $hasRequiredIngredients = false;
        $selectedIngredients = [];
        foreach ($getIngredientPrice as $ingredient) {
            // Überprüfen, ob die Mindestanzahl von Zutaten erreicht ist
            if ($ingredient['min_ingredients'] > 0 && count($selectedIngredients) < $ingredient['min_ingredients']) {
                $hasRequiredIngredients = true;
              //  dd($hasRequiredIngredients);
                break;
            }

            // Überprüfen, ob die Maximalanzahl von Zutaten überschritten wird
            if ($ingredient['max_ingredients'] > 0 && count($selectedIngredients) > $ingredient['max_ingredients']) {
                $hasExceededMaxIngredients = true;
             //    dd($hasExceededMaxIngredients, $hasRequiredIngredients);
                break;
            }
        }

        // Deaktivieren des Warenkorb-Buttons, wenn erforderliche Zutaten fehlen
        if ($hasRequiredIngredients) {
            $this->disableAddToCartButton = true;
        } else {
            $this->disableAddToCartButton = false;
        }


       // Overlay anzeigen
       $this->showOverlay = true;
    } else {
        // Wenn das Produkt nicht gefunden wurde, setze die Overlay-Flag auf false
        $this->showOverlay = false;
    }
}


public function selectIngredient($ingredientId, $productId)
{
    // Durchlaufen Sie jede Option und Zutat
    foreach ($this->getIngredientData as &$ingredient) {
        // Überprüfen, ob das maximale Limit erreicht ist
        $isMaxReached = $this->checkMaxIngredientsReached($ingredient);

        foreach ($ingredient['ingredients'] as &$subIngredient) {
            if ($subIngredient['id'] == $ingredientId) {
                // Prüfen, ob die Zutat bereits ausgewählt wurde
                $isAlreadySelected = $this->isIngredientSelected($subIngredient['id']);

                // Überprüfen, ob noch kostenlose Zutaten verfügbar sind und die Zutat nicht bereits ausgewählt wurde
                $hasFreeIngredients = $ingredient['free_ingredients'] > 0;

                if ($hasFreeIngredients && !$isAlreadySelected) {
                    // Fügen Sie die Zutat zu den kostenlosen Zutaten hinzu
                    $subIngredient['quantity'] = 1; // Setzen Sie die Anzahl auf 1, da diese Zutat neu hinzugefügt wird
                    $this->freeIngredients[] = $subIngredient;
                } else {
                    // Wenn die Zutat nicht kostenlos ist oder bereits ausgewählt wurde, fügen Sie sie den ausgewählten Zutaten hinzu
                    $subIngredient['quantity'] = $isAlreadySelected ? $subIngredient['quantity'] + 1 : 1;
                    $this->selectedIngredients[] = $subIngredient;
                }

                // Brechen Sie die Schleife ab, da die Zutat gefunden wurde
                break 2;
            }
        }
    }

    // Überprüfen, ob alle Pflichtzutaten ausgewählt wurden
    if ($this->areRequiredIngredientsSelected()) {
        // Wenn alle Pflichtzutaten ausgewählt wurden, aktivieren Sie den Warenkorb-Button
        $this->disableAddToCartButton = false;
    }

    // Aktualisieren Sie das Livewire-Overlay, um die ausgewählte Zutat anzuzeigen
    $this->dispatch('ingredientAdded', $subIngredient);
}


    private function checkMaxIngredientsReached($ingredient)
    {
        // Überprüfen, ob ein Limit für die maximale Anzahl von Zutaten festgelegt ist
        $isMaxSet = $ingredient['max_ingredients'] > 0;

        if ($isMaxSet) {
            // Zählen Sie die Anzahl der ausgewählten Zutaten für diese Option
            $selectedCount = $this->countSelectedIngredients($ingredient);
//dd($selectedCount, $ingredient['max_ingredients']);
            // Überprüfen, ob die maximale Anzahl von Zutaten erreicht wurde
            return $selectedCount >= $ingredient['max_ingredients'];
        }

        // Wenn kein maximales Limit festgelegt ist, geben Sie false zurück
        return false;
    }

    private function countSelectedIngredients($ingredient = null)
    {
        // Zählen Sie die Anzahl der ausgewählten Zutaten für die angegebene Option
        $count = 0;
        if ($ingredient) {
            // Zählen Sie kostenpflichtige Zutaten
            foreach ($this->selectedIngredients as $selectedIngredient) {
                foreach ($ingredient['ingredients'] as $subIngredient) {
                    if ($selectedIngredient['id'] === $subIngredient['id']) {
                        $count += $selectedIngredient['quantity'];
                        if ($subIngredient['price'] == 0) {
                            $count--;
                        }
                        break;
                    }
                }
            }
            // Zählen Sie kostenlose Zutaten
            foreach ($this->freeIngredients as $freeIngredient) {
                foreach ($ingredient['ingredients'] as $subIngredient) {
                    if ($freeIngredient['id'] === $subIngredient['id']) {
                        $count += $freeIngredient['quantity'];
                        break;
                    }
                }
            }
        }
        return $count;
    }


    private function areRequiredIngredientsSelected()
    {
        foreach ($this->getIngredientData as $ingredient) {
            if ($ingredient['min_ingredients'] > 0) {
                $selectedCount = $this->countSelectedIngredients($ingredient);
                if ($selectedCount < $ingredient['min_ingredients']) {
                    // Es wurden nicht alle erforderlichen Zutaten ausgewählt
                    return false;
                }
            }
        }
        $this->disableAddToCartButton = false;
        // Alle erforderlichen Zutaten wurden ausgewählt
        return true;
    }


    private function getIngredientDataWithCategoryStatus()
    {
        $selectedIngredientsCount = $this->countSelectedIngredients();

        return collect($this->getIngredientData)->map(function ($ingredient) use ($selectedIngredientsCount) {
            $isMaxReached = $ingredient['max_ingredients'] > 0 && $selectedIngredientsCount >= $ingredient['max_ingredients'];
            $isIngredientSelected = $this->isIngredientSelected($ingredient['ingredient_id']);

            $isCategoryDisabled = $isMaxReached && !$isIngredientSelected;

            return array_merge($ingredient, ['is_category_disabled' => $isCategoryDisabled]);
        })->all();
    }












    private function isIngredientSelected($ingredientId)
    {
        // Überprüfen, ob die Zutat bereits ausgewählt wurde
        foreach ($this->selectedIngredients as $ingredient) {
            if ($ingredient['id'] == $ingredientId) {
                return true;
            }
        }
        return false;
    }






        //$this->checkRequiredIngredientsSelected($this->getIngredientData, $productId);

        // Aktualisieren Sie das Livewire-Overlay, um die ausgewählte Zutat anzuzeigen
        //$this->dispatch('ingredientAdded', $selectedIngredient);
        public function checkRequiredIngredientsSelected()
        {
            // Überprüfen, ob alle Nodes min_ingredients 0 haben
            $allZeroMinIngredients = true;
            foreach ($this->getIngredientData as $option) {
                if ($option['min_ingredients'] !== 0) {
                    $allZeroMinIngredients = false;
                    break;
                }
            }

            // Wenn alle Nodes min_ingredients 0 haben, aktivieren Sie den Warenkorb-Button
            if ($allZeroMinIngredients) {
                $this->disableAddToCartButton = false;
                return;
            }

            // Durchlaufen Sie jede Option und überprüfen Sie die ausgewählten Zutaten
            foreach ($this->getIngredientData as $option) {
                // Überprüfen, ob die Option einen gültigen Schlüssel "node_id" hat
                if (!isset($option['node_id'])) {
                    continue; // Überspringen dieser Option und mit der nächsten fortfahren
                }

                // Zählen Sie die Anzahl der ausgewählten Zutaten für diese Option
                $selectedCount = $this->countSelectedIngredients($option['node_id']);

                // Überprüfen, ob die Mindestanzahl an Zutaten erreicht wurde
                if ($selectedCount < $option['min_ingredients']) {
                    // Wenn die Mindestanzahl nicht erreicht wurde, deaktivieren Sie den Warenkorb-Button und beenden Sie die Überprüfung
                    $this->disableAddToCartButton = true;
                    return;
                }
            }

            // Wenn alle Optionen die Anforderungen erfüllen, aktivieren Sie den Warenkorb-Button
            $this->disableAddToCartButton = false;
        }



/**
 * Erhöht die Menge der ausgewählten Zutat um eins.
 *
 * Diese Methode wird aufgerufen, wenn der Benutzer die Menge einer ausgewählten Zutat erhöhen möchte.
 * Sie durchläuft das Array der ausgewählten Zutaten und erhöht die Menge der Zutat mit der angegebenen ID um eins.
 * Nachdem die Menge aktualisiert wurde, wird die Methode updateTotalPrice aufgerufen, um den Gesamtpreis zu aktualisieren.
 *
 * @param int $ingredientId Die ID der Zutat, deren Menge erhöht werden soll.
 * @return void
 */
public function incrementQuantity($ingredientId, $productId)
{
    foreach ($this->selectedIngredients as &$ingredient) {
        if ($ingredient['id'] == $ingredientId && isset($ingredient['quantity'])) {
            $ingredient['quantity']++;
        //    $this->disableAddToCartButton = false;
            break;
        }
    }
  //  $this->checkRequiredIngredientsSelected($this->getIngredientData);

    $this->updateTotalPrice();
}

/**
 * Verringert die Menge der ausgewählten Zutat um eins oder entfernt sie, wenn die Menge eins ist.
 * Setzt außerdem die passende Node zurück.
 *
 * Diese Methode wird aufgerufen, wenn der Benutzer die Menge einer ausgewählten Zutat verringern möchte.
 * Sie durchläuft das Array der ausgewählten Zutaten und sucht nach der Zutat mit der angegebenen ID.
 * Wenn die Menge größer als eins ist, wird sie um eins verringert.
 * Wenn die Menge eins ist, wird die Zutat aus dem Array der ausgewählten Zutaten entfernt.
 * Nachdem die Menge aktualisiert oder die Zutat entfernt wurde, wird die Methode updateTotalPrice aufgerufen,
 * um den Gesamtpreis zu aktualisieren.
 * Außerdem wird die passende Node zurückgesetzt, indem die entsprechende Aktion aufgerufen wird.
 *
 * @param int $ingredientId Die ID der Zutat, deren Menge verringert werden soll.
 * @return void
 */
public function decrementQuantity($ingredientId, $productId)
{

   // dd($ingredientId);
    foreach ($this->selectedIngredients as $key => &$ingredient) {
        if ($ingredient['id'] == $ingredientId) {
            if (isset($ingredient['quantity']) && $ingredient['quantity'] > 1) {
                $ingredient['quantity']--;
            } else {
                // Zutat entfernen
                unset($this->selectedIngredients[$key]);
                // Passende Node zurücksetzen
                $this->resetMatchingNode($ingredientId, $productId);
            }
            break;
        }
    }
  //  $this->checkRequiredIngredientsSelected($this->getIngredientData);

    // Gesamtpreis aktualisieren
    $this->updateTotalPrice();
}


public function removeIngredient($ingredientId, $productId)
{
    foreach ($this->selectedIngredients as $key => $ingredient) {
        if ($ingredient['id'] == $ingredientId) {
            // Zutat entfernen
            unset($this->selectedIngredients[$key]);
            // Passende Node zurücksetzen
            $this->resetMatchingNode($ingredientId, $productId);
         //   $this->disableAddToCartButton = true;

            break;
        }
    }
   // $this->checkRequiredIngredientsSelected($this->selectedIngredients);
}



/**
 * Setzt die passende Node für die angegebene Zutat zurück.
 *
 * Diese Methode wird aufgerufen, wenn die Menge einer Zutat auf eins reduziert wird
 * und die Zutat aus den ausgewählten Zutaten entfernt wird.
 * Sie kann verwendet werden, um die entsprechende Node zurückzusetzen,
 * z.B. durch das Aufrufen einer Methode zur Zurücksetzung der Node oder das Aktualisieren eines Attributs.
 *
 * @param int $ingredientId Die ID der Zutat, für die die passende Node zurückgesetzt werden soll.
 * @return void
 */
private function resetMatchingNode($ingredientId, $productId)
{
    // Durchlaufen Sie jede Option und Zutat
    foreach ($this->getIngredientData as &$ingredient) {
        foreach ($ingredient['ingredients'] as &$subIngredient) {
            if ($subIngredient['id'] == $ingredientId) {
                // Setzen Sie die Menge der Zutat auf Null
                $subIngredient['quantity'] = 0;

                // Durchlaufen Sie alle ausgewählten Zutaten und setzen Sie deren Menge ebenfalls auf Null
                foreach ($this->selectedIngredients as &$selectedIngredient) {
                    if ($selectedIngredient['id'] == $subIngredient['id']) {
                        $selectedIngredient['quantity'] = 0;
                    }
                }

                // Implementieren Sie hier die Logik zum Zurücksetzen der passenden Node
                // Beispiel:
                // $this->dispatch('resetMatchingNode', $ingredient['node_id'], $productId);

                // Brechen Sie die Schleife ab, da die Zutat gefunden wurde
                break 2;
            }
        }
    }

    // Aktualisieren Sie das Livewire-Attribut, um das Overlay neu zu rendern
    $this->updateTotalPrice();
}



/**
 * Schließt das Overlay und setzt ausgewählte Zutaten zurück.
 *
 * Diese Methode wird aufgerufen, wenn der Benutzer das Overlay schließt,
 * das für die Auswahl von Zutaten angezeigt wird.
 * Sie setzt das Attribut $showOverlay auf false, um das Overlay auszublenden,
 * und setzt das Attribut $selectedIngredients zurück, um ausgewählte Zutaten zu löschen.
 */
public function closeOverlay()
{
    // Das Overlay wird ausgeblendet
    $this->showOverlay = false;

    // Ausgewählte Zutaten werden zurückgesetzt
    $this->reset('selectedIngredients');
    // Free Zutaten werden zurückgesetzt
    $this->reset('freeIngredients');
}





    public function toggleIngredient($ingredientId)
    {
        if (in_array($ingredientId, $this->openIngredients)) {
            $this->openIngredients = array_diff($this->openIngredients, [$ingredientId]);
        } else {
            $this->openIngredients[] = $ingredientId;
        }
    }


    public function updateTotalPrice()
    {
        $totalPrice = $this->productPrice; // Basispreis des Produkts

        // Durchlaufe die ausgewählten Zutaten und addiere ihre Preise
        foreach ($this->selectedIngredients as $ingredient) {
            $totalPrice += $ingredient['price'] * ($ingredient['quantity'] ?? 1);
        }

        // Aktualisiere den Gesamtpreis
        $this->totalPrice = $totalPrice;
    }



    public function updateQuantity()
    {
        foreach ($this->selectedIngredients as &$ingredient) {
            if ($ingredient['id'] == $ingredientId) {
                $ingredient['quantity'] = $quantity;
                break;
            }
        }

        $this->updateTotalPrice();
    }





    /**
     * Render the livewire component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.frontend.product.index', [
            'restaurant' => $this->restaurant,
            'categories' => $this->categories,
            'productsByCategory' => $this->productsByCategory,
            'minPrices' => $this->minPrices,
            'total' => $this->total,
            'content' => $this->content,
            'productName' => $this->productName,
            'getIngredientData' => $this->getIngredientData,
        //    'getIngredientData' => $this->getIngredientDataWithCategoryStatus(),
        ]);
    }

    /**
     * Calculate minimum prices for products.
     *
     * @return array
     */
    protected function calculateMinPrices()
    {
        $minPrices = [];

        foreach ($this->productsByCategory as $products) {
            foreach ($products as $product) {
                $minPrices[$product->id] = app(ShopCardController::class)->getProductPrice($product->id);
            }
        }

        return $minPrices;
    }


    /**
     * Update cart total and content.
     *
     * @return void
     */
    public function updateCart()
    {
        $this->total = Cart::total();
        $this->content = Cart::content();
    }


    /**
     * Prepare size data.
     *
     * @param  \Illuminate\Database\Eloquent\Collection  $prices
     * @param  array  $sizes
     * @return array
     */
    private function prepareSizeData($prices, $sizes)
    {
        $sizeData = [];

        foreach ($sizes as $size) {
            $sizeData[$size->id] = [
                'name' => $size->name,
                'price' => $this->getPriceForSize($prices, $size->id)
            ];
        }

        return $sizeData;
    }





    private function getPriceForSize($prices, $sizeId) {
        foreach ($prices as $price) {
            if ($price->size_id == $sizeId) {
                return $price->price;
            }
        }

        return null; // or handle if no price found for the size
    }

    public function closeModal()
{
    $this->dispatch('closeModal');
}

}
