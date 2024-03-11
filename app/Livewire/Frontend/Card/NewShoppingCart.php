<?php

namespace App\Livewire\Frontend\Card;

use Livewire\Component;
use App\Services\CartService;
use App\Facades\Cart as CartFacade;
use Illuminate\Session\SessionManager;

class NewShoppingCart extends Component
{



    public $cart;
    protected $cartService;
    protected $total;
    protected $content;
    protected $listeners = [
        'productAddedToCart' => 'updateCart',
    ];


    public function mount(SessionManager $session)
    {
        $this->cartService = new CartService($session);
        $this->cart = $this->cartService->content();
    }

    public function addToCart($productId, $productName, $productPrice, $quantity)
    {


      // dd($productId, $productName, $productPrice, $quantity);

        // Verwendung der Fassade, um auf den CartService zuzugreifen
        CartFacade::add('12', 'bla', '12.50', '1');
      //  $this->dispatch('productAddedToCart');

        // Anzeigen einer Erfolgsmeldung
        session()->flash('success_message', 'Das Produkt wurde zum Warenkorb hinzugefügt.');
        $this->updateCart();

        $this->dispatch('productAddedToCart');
        // refresh the cart
    }


    public function updateCart()
    {

        $this->total = CartFacade::total();
        $this->content = CartFacade::content();
        $this->render();

    }


    public function render()
    {
        return view('livewire.frontend.card.new-shopping-cart');
    }
}
