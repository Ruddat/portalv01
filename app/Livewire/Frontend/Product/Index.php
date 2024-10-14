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
        // Produkt abrufen
        $product = ModProducts::find($productId);

        // Produkt existiert nicht
        if (!$product) {
            $this->dispatch('toast', message: 'Das Produkt konnte nicht gefunden werden. Bitte versuchen Sie es später erneut.', notify: 'error');
            return;
        }

        // Optionen abrufen
        $options = DB::table('mod_product_ingredients_nodes')->where('parent', $productId)->get();

        // Optionen prüfen und vorbereiten
        if ($options->isNotEmpty() && $options->contains('active', 1)) {
            $this->prepareProductOptions($productId, $selectedSize, $selectedPrice, $productName, $product);
            return;
        }

        // Basispreis, wenn keine Optionen vorhanden sind
        $price = $product->base_price;

        // Eindeutige ID für das Produkt im Warenkorb erstellen (UUID könnte besser sein)
        $extendedProductId = $this->generateUniqueCartId($productId);

        // Größe des Produkts abrufen (verwende Standardgröße falls nicht vorhanden)
        $sizeTitle = ModProductSizes::find($selectedSize) ?? (object) ['title' => 'Standard'];

        // Optionen für das Produkt (Pfand, Größe, etc.)
        $options = $this->getBottleOptions($product, $selectedPrice);

        // Kategorie und Größenlogik (wenn keine Kategoriegrößen vorhanden sind, setze Standardgröße)
        if ($this->isStandardCategory($product->category_id)) {
            $sizeTitle->title = 'Standard';
        }

        // Produkt zum Warenkorb hinzufügen
        Cart::add($extendedProductId, $productName, $selectedPrice, $sizeTitle->title, $selectedQuantity, $productId, $options);

        // Erfolgsmeldung
        $this->dispatch('toast', message: 'Das Produkt wurde zum Warenkorb hinzugefügt.', notify: 'success');

        // UI aktualisieren
        $this->dispatch('productAddedToCart');
    }

    /**
     * Generiert eine eindeutige ID für das Produkt im Warenkorb.
     *
     * @param int $productId Die Produkt-ID.
     * @return string Eine eindeutige Kennung für den Warenkorb.
     */
    protected function generateUniqueCartId($productId)
    {
        return $productId . uniqid(); // Verwendet uniqid() anstelle von rand() für mehr Eindeutigkeit
    }

    /**
     * Holt Flaschenoptionen und fügt sie den Warenkorb-Optionen hinzu.
     *
     * @param mixed $product Das Produktobjekt.
     * @param float $selectedPrice Der aktuelle Preis des Produkts.
     * @return array Ein Array mit den Optionen (z.B. Pfand).
     */
    protected function getBottleOptions($product, &$selectedPrice)
    {
        $options = [];
        if ($product->bottles_id) {
            $bottlesPrices = ModBottles::find($product->bottles_id);
            if ($bottlesPrices) {
                $options[] = [
                    'productCode' => 'deposit',
                    'productName' => $bottlesPrices->bottles_title,
                    'price' => $bottlesPrices->bottles_value,
                    'size' => 'standard',
                    'quantity' => 1,
                ];
                $selectedPrice += $bottlesPrices->bottles_value;
            }
        }
        return $options;
    }

    /**
     * Überprüft, ob die Kategorie eine Standardkategorie ohne Größenlogik ist.
     *
     * @param int $categoryId Die ID der Kategorie.
     * @return bool True, wenn die Kategorie standardmäßig ist.
     */
    protected function isStandardCategory($categoryId)
    {
        $category = DB::table('mod_categories')->find($categoryId);
        return is_null($category->sizes_category); // Wenn sizes_category NULL ist, setze Standardgröße
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
            ->select(['id', 'title', 'base_price', 'code_nr']) // Nur benötigte Spalten auswählen
            ->get();

        // Option mit Zutaten vorbereiten
        $option['ingredients'] = $parentIngredients->map(function ($ingredient) {
            return [
                'id' => $ingredient->id,
                'title' => $ingredient->title,
                'base_price' => $ingredient->base_price,
                'code_nr' => $ingredient->code_nr,
            ];
        })->toArray();

        // Option mit Zutaten zum Ergebnis-Array hinzufügen
        $preparedOptionsWithIngredients[] = $option;
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

//dd($productId, $selectedSize, $selectedPrice, $productName);
        // Fügen Sie hier die Logik zum Hinzufügen zum Warenkorb hinzu

    }


/**
 * Fügt ein Produkt mit seinen Optionen und Preisen zum Warenkorb hinzu.
 *
 * Diese Methode wird verwendet, um ein ausgewähltes Produkt mit der angegebenen Größe, Menge,
 * zusätzlichen Optionen wie Flaschenpreisen (falls zutreffend) und einem eindeutigen Produktcode
 * dem Warenkorb hinzuzufügen. Das Overlay wird danach geschlossen und die Benutzeroberfläche wird aktualisiert.
 *
 * @param int $productId Die ID des Produkts, das dem Warenkorb hinzugefügt werden soll.
 * @param string $productTitle Der Titel des Produkts.
 * @param float $totalPrice Der Gesamtpreis des Produkts einschließlich aller Optionen.
 * @param int $sizeId Die ID der Produktgröße.
 * @param int $selectedSize Die ausgewählte Produktgröße.
 * @param int $selectedQuantity Die Anzahl der ausgewählten Produkte.
 *
 * @return void
 */
public function addToCartProduct($productId, $productTitle, $totalPrice, $sizeId, $selectedSize, $selectedQuantity)
{

   //dd($productId, $productTitle, $totalPrice, $sizeId, $selectedSize, $selectedQuantity);
    // Erstellen der Optionen-Daten
    $options = $this->createOptionsData();

    // Generiere eine eindeutige Kennung für das Produkt, um mehrere Instanzen desselben Produkts zu differenzieren
    $uniqueIdentifier = rand(100000, 999999);
    $extendedProductId = $productId . '' . $uniqueIdentifier;

    // Abrufen des Produkts und seiner Größe
    $sizeTitle = ModProductSizes::find($selectedSize);
    $productData = ModProducts::find($productId);
    $productCode = $productData->product_code ?? 0;
    $productTaxRate = $productData->tax_rate_id ?? 7;

//dd($productData, $productCode, $productTaxRate);

    // Überprüfen, ob das Produkt eine Flasche (bottles_id) enthält und den Preis der Flasche hinzufügen
    if ($productData && $productData->bottles_id) {
        $bottlesPrices = ModBottles::find($productData->bottles_id);

        if ($bottlesPrices) {
            $options[] = [
                'productCode' => 'deposit',
                'productName' => $bottlesPrices->bottles_title,
                'price' => $bottlesPrices->bottles_value,
                'size' => 'standard',
                'quantity' => 1,
            ];
            // Preis für die Flasche zum Gesamtpreis hinzufügen
            $totalPrice += $bottlesPrices->bottles_value;
        }
    }

    // Produkt zum Warenkorb hinzufügen
    Cart::add($extendedProductId, $productTitle, $totalPrice, $selectedSize, $selectedQuantity, $productCode, $options);

    // Erfolgsmeldung anzeigen
    $this->dispatch('toast', message: 'Das Produkt wurde zum Warenkorb hinzugefügt.', notify: 'success');

    // Overlay schließen
    $this->closeOverlay();

    // Ereignis auslösen, um die Benutzeroberfläche zu aktualisieren
    $this->dispatch('productAddedToCart');
}

/**
 * Schließt das Overlay und setzt ausgewählte Zutaten zurück.
 *
 * Diese Methode wird aufgerufen, wenn der Benutzer das Overlay schließt,
 * das für die Auswahl von Zutaten angezeigt wird. Sie setzt das Attribut $showOverlay auf false,
 * um das Overlay auszublenden, und setzt das Attribut $selectedIngredients sowie $freeIngredients zurück,
 * um die gewählten Zutatenoptionen zu entfernen.
 *
 * @return void
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
               // dd($hasRequiredIngredients);
                break;
            }

            // Überprüfen, ob die Maximalanzahl von Zutaten überschritten wird
            if ($ingredient['max_ingredients'] > 0 && count($selectedIngredients) > $ingredient['max_ingredients']) {
                $hasExceededMaxIngredients = true;
              //   dd($hasExceededMaxIngredients, $hasRequiredIngredients);
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
    foreach ($this->getIngredientData as &$ingredient) {
        if ($this->checkMaxIngredientsReached($ingredient)) {
            continue;
        }

        foreach ($ingredient['ingredients'] as &$subIngredient) {
            if ($subIngredient['id'] == $ingredientId) {
                $selectedCount = $this->countSelectedIngredients($ingredient);

                // Wenn die Anzahl der kostenlosen Zutaten noch nicht erreicht ist, setze sie als gratis
                $isFree = $ingredient['free_ingredients'] > 0 && $selectedCount < $ingredient['free_ingredients'];

                $this->addIngredientToSelection($subIngredient, $isFree);
                break 2;
            }
        }
    }

    $this->updateAddToCartButtonState();
    $this->dispatch('ingredientAdded', $subIngredient);
}

private function addIngredientToSelection($ingredient, $isFree)
{
    if (!isset($ingredient['quantity'])) {
        $ingredient['quantity'] = 0;
    }

    if ($isFree) {
        // Überprüfen, ob das Gratis-Limit erreicht ist
        if ($this->countSelectedFreeIngredients() < 1) {
            $ingredient['quantity'] = 1;  // Setze auf 1 für Gratis-Zutat
            $this->freeIngredients[] = $ingredient;
        } else {
            // Mehr als eine Zutat wird berechnet
            $ingredient['quantity']++;
            $this->selectedIngredients[] = $ingredient;
        }
    } else {
        // Für kostenpflichtige Zutaten
        $ingredient['quantity'] = $this->isIngredientSelected($ingredient['id']) ? $ingredient['quantity'] + 1 : 1;
        $this->selectedIngredients[] = $ingredient;
    }
}


private function countSelectedFreeIngredients()
{
    return count($this->freeIngredients);
}

public function removeFreeIngredient($ingredientId)
{
    $this->freeIngredients = array_filter($this->freeIngredients, function($ingredient) use ($ingredientId) {
        return $ingredient['id'] !== $ingredientId;
    });

    $this->updateAddToCartButtonState(); // Optional: aktualisiere den Zustand des Buttons
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
        $count = 0;
        if ($ingredient) {
            foreach ($this->selectedIngredients as $selectedIngredient) {
                foreach ($ingredient['ingredients'] as $subIngredient) {
                    if ($selectedIngredient['id'] === $subIngredient['id']) {
                        $count += $selectedIngredient['quantity'];
                        break;
                    }
                }
            }
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






    public function checkRequiredIngredientsSelected()
    {
        // Überprüfen, ob alle Nodes min_ingredients auf 0 gesetzt sind
        $allZeroMinIngredients = collect($this->getIngredientData)->every(function ($option) {
            return $option['min_ingredients'] === 0;
        });

        // Warenkorb-Button aktivieren, wenn alle min_ingredients auf 0 stehen
        if ($allZeroMinIngredients) {
            $this->disableAddToCartButton = false;
            return;
        }

        // Schleife durch alle Optionen, um sicherzustellen, dass die Mindestanzahl der Zutaten erreicht wurde
        foreach ($this->getIngredientData as $option) {
            if (!isset($option['node_id'])) {
                continue;
            }

            $selectedCount = $this->countSelectedIngredients($option['node_id']);
            if ($selectedCount < $option['min_ingredients']) {
                $this->disableAddToCartButton = true;
                return;
            }
        }

        // Warenkorb-Button aktivieren, wenn alle Bedingungen erfüllt sind
        $this->disableAddToCartButton = false;
    }




/**
 * Erhöht die Menge der ausgewählten Zutat um eins.
 *
 * @param int $ingredientId Die ID der Zutat, deren Menge erhöht werden soll.
 * @param int $productId Die ID des Produkts, zu dem die Zutat gehört.
 * @return void
 */
public function incrementQuantity($ingredientId, $productId)
{
    foreach ($this->selectedIngredients as &$ingredient) {
        if ($ingredient['id'] == $ingredientId && isset($ingredient['quantity']) && is_numeric($ingredient['quantity'])) {
            $ingredient['quantity']++;
            break;
        }

    }

    unset($ingredient); // Löscht die Referenz, um Fehler zu vermeiden.
    $this->updateTotalPrice();
    $this->updateAddToCartButtonState();
}

/**
 * Verringert die Menge der ausgewählten Zutat um eins oder entfernt sie, wenn die Menge eins ist.
 *
 * @param int $ingredientId Die ID der Zutat, deren Menge verringert werden soll.
 * @param int $productId Die ID des Produkts, zu dem die Zutat gehört.
 * @return void
 */
public function decrementQuantity($ingredientId, $productId)
{
    foreach ($this->selectedIngredients as $key => &$ingredient) {
        if ($ingredient['id'] == $ingredientId) {
            if (isset($ingredient['quantity']) && is_numeric($ingredient['quantity']) && $ingredient['quantity'] > 1) {
                $ingredient['quantity']--;
            } else {
                // Zutat entfernen
                unset($this->selectedIngredients[$key]);
                // Array neu indizieren
                $this->selectedIngredients = array_values($this->selectedIngredients);
                // Passende Node zurücksetzen
                $this->resetMatchingNode($ingredientId, $productId);
            }
            break;
        }
    }
    unset($ingredient); // Löscht die Referenz, um Fehler zu vermeiden.

    $this->updateTotalPrice();
    $this->updateAddToCartButtonState();
}

/**
 * Entfernt eine Zutat aus den ausgewählten Zutaten.
 *
 * @param int $ingredientId Die ID der Zutat, die entfernt werden soll.
 * @param int $productId Die ID des Produkts, zu dem die Zutat gehört.
 * @return void
 */
public function removeIngredient($ingredientId, $productId)
{
    foreach ($this->selectedIngredients as $key => $ingredient) {
        if ($ingredient['id'] == $ingredientId) {
            // Zutat entfernen
            unset($this->selectedIngredients[$key]);
            // Array neu indizieren
            $this->selectedIngredients = array_values($this->selectedIngredients);
            // Passende Node zurücksetzen
            $this->resetMatchingNode($ingredientId, $productId);
            break;
        }
    }

    $this->updateTotalPrice();
    $this->updateAddToCartButtonState();
}

/**
 * Aktualisiert den Zustand des "In den Warenkorb" Buttons, basierend auf den ausgewählten Zutaten.
 *
 * @return void
 */
private function updateAddToCartButtonState()
{
    foreach ($this->getIngredientData as $ingredient) {
        if ($ingredient['min_ingredients'] > 0 && $this->countSelectedIngredients($ingredient) < $ingredient['min_ingredients']) {
            $this->disableAddToCartButton = true;
            return;
        }
    }
    $this->disableAddToCartButton = false;
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
