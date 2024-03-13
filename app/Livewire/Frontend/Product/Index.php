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
    public $productName;
    public $productPrice;
    public $selectedSize;

    protected $total;
    protected $content;
    protected $listeners = [
        'productAddedToCart' => 'updateCart',
     //   'show-size-modal' => 'open',
        'add-to-cart' => 'addToCartWithOptions'
    ];


    protected $cartService;


    public function mount($restaurant, $categories, $productsByCategory, CartService $cartService)
    {
        // Hier kannst du deine Daten initialisieren
        $this->restaurant = $restaurant;
        $this->categories = $categories;
        $this->productsByCategory = $productsByCategory;
        $this->cartService = $cartService;


        $this->selectedSize = null; // Initialisieren Sie $selectedSize als null oder eine Standardgröße

       $this->listeners['show-size-modal'] = 'open';


        // Berechne und speichere die Mindestpreise für jedes Produkt
        $this->minPrices = $this->calculateMinPrices();

        $this->updateCart();

    }

    public function addToCart($productId, $productName, $productPrice, $quantity)
    {
        // Produkt aus der Datenbank abrufen
        $product = ModProducts::find($productId);
//dd($product);


        // Überprüfen, ob das Produkt gefunden wurde
        if (!$product) {
            // Fehler behandeln, wenn das Produkt nicht gefunden wurde
            $this->dispatch('modal.open', [
                'title' => 'Produkt nicht gefunden',
                'message' => 'Das Produkt konnte nicht gefunden werden. Bitte versuchen Sie es später erneut.',
                'type' => 'error',
            ]);

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
        $options = ['wings' => 2];

        Cart::add($productId, $product->product_title, $price, $size, $quantity, $options);
        $this->dispatch('productAddedToCart');
    }


        /**
     * Adds a new item to the cart.
     *
     * @param string $id
     * @param string $name
     * @param string $price
     * @param string $quantity
     * @param array $options
     * @return void
     */
    public function addToCartWithOptions($productId, $productName, $selectedPrice, $selectedSize, $selectedQuantity)
    {
        $selectedQuantity = (int) $selectedQuantity;

        // Definieren Sie die Optionen als Array
        $options = ['wings' => $selectedQuantity];

        $uniqueIdentifier = rand(100000, 999999); // Erzeugt eine Zufallszahl zwischen 100.000 und 999.999
//dd($uniqueIdentifier);

        $extendedProductId = $productId . '' . $uniqueIdentifier;



$sizeTitle = $selectedSize['title'];
//dd($sizeTitle);


    //    dd($selectedPrice, $selectedSize['title'], $selectedQuantity, $options, $extendedProductId, $productName);
        // Fügen Sie das Produkt zum Warenkorb hinzu
        Cart::add($extendedProductId, $productName, $selectedPrice, $sizeTitle, $selectedQuantity, $options);

        // Schließen Sie das Modal
        $this->dispatch('closeModal');

        // Zeigen Sie eine Erfolgsmeldung an
        $this->dispatch('show-toast', 'Produkt wurde zum Warenkorb hinzugefügt', 'success');

        // Aktualisieren Sie den Warenkorb
        $this->dispatch('productAddedToCart');
    }

        // Hier Logik für addToCart mit Optionen
//dd($productId, $productName, $productPrice, $selectetQuantity);



    public function render()
    {
        return view('livewire.frontend.product.index', [
            // Hier werden die Daten an die View übergeben
            'restaurant' => $this->restaurant,
            'categories' => $this->categories,
            'productsByCategory' => $this->productsByCategory,
            'minPrices' => $this->minPrices,
            'total' => $this->total,
            'content' => $this->content,
            'productName' => $this->productName,

        ]);
    }

    protected function calculateMinPrices()
    {
        $minPrices = [];

        foreach ($this->productsByCategory as $products) {
            foreach ($products as $product) {
                // Hier rufen wir die Methode getProductPrice auf, um den Mindestpreis für jedes Produkt zu berechnen
                $minPrices[$product->id] = app(ShopCardController::class)->getProductPrice($product->id);
            }
        }

        return $minPrices;
    }


    public function updateCart()
    {
        $this->total = Cart::total();
        $this->content = Cart::content();
    }


    private function prepareSizeData($prices, $sizes) {
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
