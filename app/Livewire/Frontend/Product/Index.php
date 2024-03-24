<?php

namespace App\Livewire\Frontend\Product;

use App\Facades\Cart;
use App\Models\ModShop;
use Livewire\Component;
use App\Models\ModCategory;
use App\Models\ModProducts;
use App\Services\CartService;
use App\Models\ModProductSizes;
use App\Models\ModProductSizesPrices;
use App\Http\Controllers\Frontend\ShopCardController;
use LivewireUI\Modal\ModalComponent;


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

    public function addToCart($productId, $productName, $productPrice, $quantity)
    {


    // Zuerst die Längen- und Breitengradwerte aus der Session holen
    $userLatitude = session('userLatitude');
    $userLongitude = session('userLongitude');
  //  dd($userLatitude, $userLongitude);

        // Produkt aus der Datenbank abrufen
        $product = ModProducts::find($productId);
//dd($product);
        // Überprüfen, ob das Produkt gefunden wurde
        if (!$product) {
            // Fehler behandeln, wenn das Produkt nicht gefunden wurde
            $this->dispatch('show-toast', 'Das Produkt konnte nicht gefunden werden. Bitte versuchen Sie es später erneut.', 'error');
            return;
        }

        // Preis für das Produkt abrufen
        $price = 0;

        // Überprüfen, ob das Produkt mehrere Preise hat
        $prices = ModProductSizesPrices::where('parent', $productId)->get();
      //  dd($prices);
        if ($prices->count() > 1) {
            // Größen nur abrufen, wenn sie vorhanden sind
            $category = ModCategory::find($product->category_id);
            $sizesCategory = $category->sizes_category;
            $sizes = ModProductSizes::where('parent', $sizesCategory)->get()->toArray();
            // Daten für das Modal vorbereiten und anzeigen
            $this->dispatch('show-options-modal', [
                'productData' => [
                    'productId' => $productId,
                    'productName' => $product->product_title,
                    'prices' => $prices->toArray(),
                    'sizes' => $sizes,
                    'quantity' => $quantity
                ]
            ]);
            return;
        } elseif ($prices->count() == 1) {
            // Nur einen Preis gefunden
            $price = $prices->first()->price;
        } else {
            // Keinen Preis gefunden
            $this->dispatch('show-toast', 'Für dieses Produkt sind keine Preise verfügbar. Bitte kontaktieren Sie den Shop.', 'error');
            return;
        }
        // Produkt zum Warenkorb hinzu fuegen
   //     dd($productId, $product->product_title, $price, $quantity);

        $size = '';
        // Definieren Sie die Optionen als Array
        $options = [
            'kaeserand' => 1,
            'price' => $price,

    ];

       Cart::add($productId, $product->product_title, $price, $size, $quantity, $options);

        $this->dispatch('productAddedToCart');
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
            'size_id' => $selectedSize['id'],
            'product_code' => $productId,
        ];

        $uniqueIdentifier = rand(100000, 999999);
        $extendedProductId = $productId . '' . $uniqueIdentifier;
        $sizeTitle = $selectedSize['title'];


        Cart::add($extendedProductId, $productName, $selectedPrice, $sizeTitle, $selectedQuantity, $options);

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
