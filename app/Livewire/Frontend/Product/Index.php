<?php

namespace App\Livewire\Frontend\Product;

use App\Facades\Cart;
use App\Models\ModShop;
use Livewire\Component;
use App\Models\ModBottles;
use App\Models\ModCategory;
use App\Models\ModProducts;
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

    protected $total;
    protected $content;
    protected $listeners = [
        'productAddedToCart' => 'updateCart',
        'add-to-cart-option' => 'addToCartOption',
    ];


    public $selectedPrice;
    public $selectedIngredients;
    public $data;

    public $options = [];

    protected $cartService;



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



    public function addToCartNew($productId, $productName, $selectedPrice, $selectedSize, $selectedQuantity)
    {
        // Produkt aus der Datenbank abrufen
        $product = ModProducts::find($productId);

        // Überprüfen, ob das Produkt gefunden wurde
        if (!$product) {
            // Fehler behandeln, wenn das Produkt nicht gefunden wurde
            $this->dispatch('toast', message: 'Das Produkt konnte nicht gefunden werden. Bitte versuchen Sie es später erneut.', notify:'error' );

            return;
        }


        // Optionen für das Produkt abrufen
        $options = DB::table('mod_product_ingredients_nodes')->where('parent', $productId)->get();

        // Überprüfen, ob das Produkt Optionen hat
        if ($options->isNotEmpty()) {
            // Wenn das Produkt Optionen hat, geben Sie eine Meldung aus
            $this->prepareProductOptions($productId, $selectedSize, $selectedPrice, $productName, $product);
            // $this->dispatch('toast', message: 'Dieses Produkt hat Optionen. Bitte wählen Sie eine Option aus.', notify:'success' );
            return;
        }

        // Wenn das Produkt keine Optionen hat, fügen Sie es mit dem Basispreis zum Warenkorb hinzu
        $price = $product->base_price;
        // Hier können weitere Logiken zur Preisberechnung implementiert werden, wenn nötig

        //dd($selectedSize);
        $uniqueIdentifier = rand(100000, 999999);
        $extendedProductId = $productId . '' . $uniqueIdentifier;
        $sizeTitle = $selectedSize;


    // Optionen für das Produkt
    $options = [];

    $quantity = '1'; // Annahme: Standardgröß
    $bottles = $product->bottles_id;
     if ($options['bottles'] = $bottles) {
        $sizeTitle = 'standard'; // Annahme: Standardgröße, wenn keine Größen verfügbar sind
        $bottlesPrices = ModBottles::where('id', $bottles)->first();
        $options = [
            'productName' => $bottlesPrices->bottles_title,
            'price' => $bottlesPrices->bottles_value,
            'size' => $sizeTitle,
             'quantity' => $quantity,
            ];
     }

    Cart::add($extendedProductId, $productName, $selectedPrice, $sizeTitle, $selectedQuantity, $productId, $options);

    // Erfolgsmeldung anzeigen
    $this->dispatch('toast', message: 'Das Produkt wurde zum Warenkorb hinzugefügt.', notify:'success' );

    // Ereignis auslösen, um die Benutzeroberfläche zu aktualisieren
    $this->dispatch('productAddedToCart');

    }


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

    // Initialisiere das Array für die vorbereiteten Zutaten
    $preparedIngredients = [];

// Für jede Option die entsprechende Überschrift (Kategorie) abrufen
foreach ($options as $option) {
    // Überschrift (Kategorie) für die Zutat abrufen
    $heading = DB::table('mod_products_ingredients')
                    ->where('id', $option->ingredients_id)
                    ->where('parent', 0) // Hier die ID für die Überschrift
                    ->orderByDesc('ordering')
                    ->first();

    // Zutaten für diese Überschrift abrufen
    $ingredients = DB::table('mod_products_ingredients')
                    ->where('parent', $heading->id)
                    ->get();

    // Hier kannst du die Zutaten weiterverarbeiten, z. B. in ein Array speichern
    $preparedIngredients[$heading->title] = [];

// hier in `mod_product_sizes_prices` die size_id anhand von $selectedPrice finden
$sizeId = DB::table('mod_product_sizes_prices')
            ->where('price', $selectedPrice)
            ->value('size_id');

// Für jede Zutat den entsprechenden Preis abrufen
foreach ($ingredients as $ingredient) {
    // Preise für diese Zutat abrufen
    $prices = DB::table('mod_products_ingredients_prices')
                ->where('parent', $ingredient->id)
                ->where('size_id', $sizeId)
                ->get();

    // Hier kannst du die Preise weiterverarbeiten, z. B. in ein Array speichern
    $preparedPrices = [];

    foreach ($prices as $price) {
        // Hier kannst du den Preis weiterverarbeiten, z. B. in ein Array speichern
        $preparedPrices[] = $price->price;
    }

    // Die Zutat und die zugehörigen Preise dem Array hinzufügen
    $preparedIngredients[$heading->title][$ingredient->title] = $preparedPrices;
}

}


                // Hier das Modal für die Zutat und ihre Preise vorbereiten
// Übergebe die vorbereiteten Daten an die Funktion zur Modal-Vorbereitung
    $this->prepareProductModal($productId, $selectedPrice, $selectedSize, $preparedIngredients, $productName, $product);



// Überschriften (Kategorien), Zutaten und zugehörige Preise vorbereiten
//dd('Überschriften, Zutaten und Preise:', $preparedIngredients);



            // Wenn das Produkt Optionen hat, geben Sie eine Meldung aus
        //    $this->dispatch('toast', message: 'Dieses Produkt hat Optionen. Bitte wählen Sie eine Option aus.', notify:'success' );
            return;
        }

        // Optionen nicht vorhanden, Preise und Modal vorbereiten
        $ingredients = DB::table('mod_products_ingredients')
                        ->where('parent', $productId)
                        ->get();

        // Überprüfen, ob Zutaten gefunden wurden
        if ($ingredients->isNotEmpty()) {

        } else {

        //dd($selectedSize);
        $uniqueIdentifier = rand(100000, 999999);
        $extendedProductId = $productId . '' . $uniqueIdentifier;
        $sizeTitle = $selectedSize;


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


     Cart::add($extendedProductId, $productName, $selectedPrice, $selectedSize, $quantity, $productId, $options);
//dd($extendedProductId, $productName, $selectedPrice, $selectedSize, $productId, $options);
            // Produkt ohne Optionen und keine Zutaten gefunden
 //           Cart::add($extendedProductId, $productName, $selectedPrice, $sizeTitle, $selectedQuantity, $productId, $options);

            // Keine Optionen und keine Zutaten gefunden
            $this->dispatch('toast', message: 'Es sind keine Optionen für dieses Produkt verfügbar.', notify:'info' );
            $this->dispatch('productAddedToCart');

            return;
        }
    }



    public function prepareProductModal($productId, $selectedPrice, $selectedSize, $preparedIngredients)
    {
        // Hier kannst du das Modal öffnen und die vorbereiteten Daten übergeben

        $product = DB::table('mod_products')
                    ->where('id', $productId)
                   ->first();

        // Zum Beispiel:
        $this->dispatch('open-product-modal', [
            'productId' => $productId,
            'productName' => $product->product_title,
            'selectedPrice' => $selectedPrice,
            'selectedSize' => $selectedSize,
            'preparedIngredients' => $preparedIngredients,
        ]);
    }


    public function addToCartOption($productId, $selectedSize, $selectedPrice, $selectedIngredients)
    {
        // Zugriff auf die übergebenen Daten
    //    $this->selectedSize = 'selectedSize';
    //    $this->selectedPrice = $data['selectedPrice'];
   //     $this->selectedIngredients = $data['selectedIngredients'];



dd($productId, $selectedSize, $selectedPrice, $selectedIngredients);
        // Hier kannst du die Logik implementieren, um das Produkt mit den ausgewählten Optionen zum Warenkorb hinzuzufügen
        // Zum Beispiel: $this->addToCartWithOptions($productId, $productName, $selectedPrice, $selectedSize, $selectedQuantity);


dd('bin hier');

        // Fügen Sie hier die Logik zum Hinzufügen zum Warenkorb hinzu
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
