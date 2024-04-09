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
use LivewireUI\Modal\ModalComponent;
use App\Models\ModProductSizesPrices;
use App\Models\ModProductIngredientsNodes;
use App\Http\Controllers\Frontend\ShopCardController;


class Index extends Component
{
    public $restaurant, $productsByCategory, $categories, $minPrices;
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
        'add-to-cart' => 'addToCartWithOptions'
    ];

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
