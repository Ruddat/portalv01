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

        // Calculate and store minimum prices for each product
        $this->minPrices = $this->calculateMinPrices();
        $this->updateCart();
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

        // Produkt zum Warenkorb hinzufügen
        Cart::add($extendedProductId, $productName, $selectedPrice, $sizeTitle->title, $selectedQuantity, $productId, []);

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
    dd($ingredients);


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

    public function prepareProductModal($productId, $selectedPrice, $selectedSize, $productName,  $getIngredientPrice)
    {
        // Hier kannst du das Modal öffnen und die vorbereiteten Daten übergeben
        // Beispiel:
    //    $this->dispatch('openProductModal', $productId);

        dd($getIngredientPrice);
        $this->dispatch('open-product-modal', [
            'productId' => $productId,
            'productName' => $productName,
            'selectedPrice' => $selectedPrice,
            'selectedSize' => $selectedSize,
         //   'preparedIngredients' => $preparedIngredients,
            'getIngredientPrice' => $getIngredientPrice,
        ]);
    }



    public function openProductModal($getIngredientPrice, $productId)
    {
    // Hier die Variable setzen, um den Ladezustand anzugeben
 //   $this->isLoading = true;

    // Hier werden die Daten des Produkts geladen
    $product = ModProducts::findOrFail($productId);

    // Hier wird das Modal geöffnet und die Daten übergeben
    $this->product = $product;
    $this->isOpen = true;

    $this->showOverlay = true;

  //  $this->isLoading = false; // Daten sind geladen, also isLoading auf false setzen

        // Ereignis auslösen, um das Modal zu öffnen

 //  $this->dispatch('open-product-modal', $getIngredientPrice, $productId, $product->title, $product->price, $product->size, $product->quantity, $product->product_code, $product->options);
}


    public function addToCartProduct($productId, $productTitle, $totalPrice, $sizeId, $selectedSize , $selectedQuantity)
    {
        // Hier kannst du die Logik implementieren, um das Produkt mit den ausgewählten Optionen zum Warenkorb hinzuzufügen
        // Zum Beispiel: $this->addToCartWithOptions($productId, $productName, $selectedPrice, $selectedSize, $selectedQuantity);

        // Fügen Sie hier die Logik zum Hinzufügen zum Warenkorb hinzu






        // Zugriff auf die übergebenen Daten
    //    $this->selectedSize = 'selectedSize';
    //    $this->selectedPrice = $data['selectedPrice'];
   //     $this->selectedIngredients = $data['selectedIngredients'];








       $options = $this->createOptionsData();

  // dd($productId, $productId, $selectedSize, $selectedPrice, $selectedIngredients, $this->getIngredientData, $this->freeIngredients, $this->selectedIngredients);


        // Fügen Sie das Produkt automatisch dem Warenkorb hinzu
        $uniqueIdentifier = rand(100000, 999999);
        $extendedProductId = $productId . '' . $uniqueIdentifier;
        $sizeTitle = ModProductSizes::where('id', $selectedSize)->first();

    //    dd($productId, $productTitle, $totalPrice, $sizeId, $selectedSize, $selectedQuantity, $extendedProductId);


   //dd($options);

        // Produkt zum Warenkorb hinzufügen
        Cart::add($extendedProductId, $productTitle, $totalPrice, $selectedSize, $selectedQuantity, $productId, $options);

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


// Verarbeiten der ausgewählten Zutaten
foreach ($this->selectedIngredients as $ingredient) {
    // Überprüfen, ob die Zutat eine Menge größer als 1 hat
    if ($ingredient['quantity'] > 1) {
        // Wenn die Menge größer als 1 ist, fügen Sie die Zutat entsprechend oft zu den Optionen hinzu
        for ($i = 0; $i < $ingredient['quantity']; $i++) {
            $options[] = [
                'productName' => $ingredient['title'],
                'price' => $ingredient['price'],
                'size' => $size, // Hier könnten Sie die Größe basierend auf der Zutat anpassen, falls erforderlich
                'quantity' => '1', // Hier setzen wir die Menge immer auf 1, da wir die Zutat entsprechend oft hinzufügen
            ];
        }
    } else {
        // Wenn die Menge 1 ist, fügen Sie die Zutat einfach einmal zu den Optionen hinzu
        $options[] = [
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

    // Überprüfen, ob das Produkt gefunden wurde
    if ($product) {
        // Produktinformationen in den öffentlichen Eigenschaften speichern
        $this->productTitle = $product->product_title;
        $this->productDescription = $product->product_anonce;
        $this->productPrice = $selectedPrice;
        $this->productName = $productName;
        $this->selectedSize = $productSize->title;
        $this->selectedSizeId = $selectedSize;
        $this->productSize = $productSize->title;
       // $getIngredientData = $getIngredientPrice;
       $this->getIngredientData = $getIngredientPrice;
        $this->allergens = $allergens;
        $this->additives = $additives;


        // Überprüfen, ob mindestens eine Pflichtzutat vorhanden ist
        $hasRequiredIngredients = false;
        foreach ($getIngredientPrice as $ingredient) {
            if ($ingredient['min_ingredients'] > 0) {
                $hasRequiredIngredients = true;
                break;
            }
        }

      // dd($hasRequiredIngredients);

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
            foreach ($ingredient['ingredients'] as &$subIngredient) {
                if ($subIngredient['id'] == $ingredientId) {
                    // Überprüfen, ob noch kostenlose Zutaten verfügbar sind und die Zutat nicht bereits ausgewählt wurde
                    if ($ingredient['free_ingredients'] > 0 && !$this->isIngredientSelected($subIngredient['id'])) {
                        // Fügen Sie die Zutat zu den kostenlosen Zutaten hinzu und reduzieren Sie die Anzahl der verbleibenden kostenlosen Zutaten
                        $subIngredient['quantity'] = 1; // Setzen Sie die Anzahl auf 1, da diese Zutat neu hinzugefügt wird
                        $this->freeIngredients[] = $subIngredient;
                        $ingredient['free_ingredients']--;
                    } else {
                        // Prüfen, ob die Zutat bereits ausgewählt wurde
                        $isAlreadySelected = $this->isIngredientSelected($subIngredient['id']);

                        // Wenn die Zutat bereits ausgewählt wurde, erhöhen Sie nur die Anzahl
                        if ($isAlreadySelected) {
                            foreach ($this->selectedIngredients as &$selected) {
                                if ($selected['id'] == $subIngredient['id']) {
                                    $selected['quantity']++;
                                    break;
                                }
                            }
                        } else {
                            // Andernfalls fügen Sie die ausgewählte kostenpflichtige Zutat hinzu
                            $subIngredient['quantity'] = 1;
                            $this->selectedIngredients[] = $subIngredient;
                        }
                    }
                    // Reduzieren Sie die Mindestanzahl von Zutaten um 1, unabhängig davon, ob sie kostenlos ist oder nicht
                    $ingredient['min_ingredients'] = max(0, $ingredient['min_ingredients'] - 1);

                    // Brechen Sie die Schleife ab, da die Zutat gefunden wurde
                    break 2;
                }
            }
        }

        // Überprüfen, ob erforderliche Zutaten ausgewählt wurden
        $this->checkRequiredIngredientsSelected();

        // Aktualisieren Sie das Livewire-Overlay, um die ausgewählte Zutat anzuzeigen
        $this->dispatch('ingredientAdded', $subIngredient);
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

        private function countSelectedIngredients($optionId)
        {
            // Zählen Sie die Anzahl der ausgewählten Zutaten für die angegebene Option
            $count = 0;
            foreach ($this->selectedIngredients as $ingredient) {
                if (isset($ingredient['option_id']) && $ingredient['option_id'] === $optionId) {
                    // Berücksichtigen Sie die Anzahl der ausgewählten Zutaten
                    $count += $ingredient['quantity'];
                }
            }
            return $count;
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
    $this->checkRequiredIngredientsSelected($this->getIngredientData);

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
    foreach ($this->selectedIngredients as $key => &$ingredient) {
        if ($ingredient['id'] == $ingredientId) {
            if (isset($ingredient['quantity']) && $ingredient['quantity'] > 1) {
                $ingredient['quantity']--;
            } else {
                // Zutat entfernen
                unset($this->selectedIngredients[$key]);
                // Passende Node zurücksetzen
             ///   $this->resetMatchingNode($ingredientId, $productId);
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
            break;
        }
    }
    $this->checkRequiredIngredientsSelected($this->getIngredientData);

    // Gesamtpreis aktualisieren
    $this->updateTotalPrice();
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



//dd($ingredientId, $productId);


    // Implementiere hier die Logik zum Zurücksetzen der passenden Node
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
     * Add a new item to the cart.
     *
     * @param  int  $productId
     * @param  string  $productName
     * @param  int  $quantity
     * @return void
     */

    public function addToCart($productId, $productName, $quantity)
    {
        // Produkt aus der Datenbank abrufen
        $product = ModProducts::find($productId);

        // Überprüfen, ob das Produkt gefunden wurde
        if (!$product) {
            // Fehler behandeln, wenn das Produkt nicht gefunden wurde
            $this->dispatch('show-toast', 'Das Produkt konnte nicht gefunden werden. Bitte versuchen Sie es später erneut.', 'error');
            return;
        }

        // Basispreis für das Produkt
        $price = $product->base_price;

        // Optionen für das Produkt
        $options = [];
        $size = 'standard'; // Annahme: Standardgröße, wenn keine Größen verfügbar sind
        $quantity = '1'; // Annahme: Standardgröß
        $bottles = $product->bottles_id;
        if ($options['bottles'] = $bottles) {

            $bottlesPrices = ModBottles::where('id', $bottles)->first();
        $options = [
            'productName' => $bottlesPrices->bottles_title,
            'price' => $bottlesPrices->bottles_value,
            'size' => $size,
            'quantity' => $quantity,
        ];

        }

       // dd($options);
        // Überprüfen, ob das Produkt Nodes (Optionen) hat und aktiv ist
        $nodes = ModProductIngredientsNodes::where('parent', $productId)
            ->where('active', true)
            ->get();

        if ($nodes->isNotEmpty()) {
            // Produkt hat Optionen
            // Hier können Sie die Logik implementieren, um das Modal vorzubereiten und die Optionen gemäß den Nodes zu verarbeiten
            // Zum Beispiel: $this->prepareModalWithOptions($product, $nodes);
            $this->prepareModalWithOptions($product, $nodes);
            return;
        }

        // Überprüfen, ob das Produkt verschiedene Preise hat (Größen)
        $prices = ModProductSizesPrices::where('parent', $productId)->get();

        if ($prices->isNotEmpty()) {
            // Produkt hat verschiedene Größen
            // Hier können Sie die Logik implementieren, um das Modal vorzubereiten und die Größen zu verarbeiten
            // Zum Beispiel: $this->prepareModalWithSizes($product, $prices);
            $this->prepareModalWithSizes($product, $prices);
            return;
        }

        // Produkt ohne Optionen und Größen
        // Hier können Sie die Logik implementieren, um das Produkt ohne Optionen und Größen direkt zum Warenkorb hinzuzufügen


      //  dd($productId, $productName, $price, $size, $quantity, $product->product_code, $options);
        Cart::add($productId, $productName, $price, $size, $quantity, $product->product_code, $options);

       $this->dispatch('toast', message: 'Produkt wurde zum Warenkorb hinzugefügt', notify:'success' );


        $this->dispatch('productAddedToCart');
    }

    private function prepareModalWithOptions($product, $nodes)
    {
        // Hier die Logik implementieren, um das Modal mit den verfügbaren Optionen (Nodes) vorzubereiten
    }

    private function prepareModalWithSizes($product, $prices)
    {
        // Hier die Logik implementieren, um das Modal mit den verfügbaren Größen vorzubereiten
    }




    /**
     * Add a new item to the cart with options.
     *
     * @param  int  $productId
     * @param  string  $productName
     * @param  float  $selectedPrice
     * @param  array  $selectedSize
     * @param  int  $selectedQuantity
     * @return void
     */
    public function addToCartWithOptions($productId, $productName, $selectedPrice, $selectedSize, $selectedQuantity)
    {
        // Retrieve latitude and longitude from session
        $userLatitude = session('userLatitude');
        $userLongitude = session('userLongitude');

        $selectedQuantity = (int) $selectedQuantity;

        // Define options array
        $options = [
            'wings' => $selectedQuantity,
            'Kaeserand' => $selectedQuantity,
            'price' => 2.70,
            'size' => $selectedSize['title'],
         //   'size_id' => $selectedSize['id'],
            'product_code' => $productId,
        ];

        $uniqueIdentifier = rand(100000, 999999);
        $extendedProductId = $productId . '' . $uniqueIdentifier;
        $sizeTitle = $selectedSize['title'];


        Cart::add($extendedProductId, $productName, $selectedPrice, $sizeTitle, $selectedQuantity, $productId, $options);

        $this->dispatch('closeModal');
        $this->dispatch('show-toast', 'Produkt wurde zum Warenkorb hinzugefügt', 'success');
        $this->dispatch('productAddedToCart');
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
