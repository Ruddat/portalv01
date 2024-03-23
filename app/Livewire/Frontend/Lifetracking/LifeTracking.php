<?php

namespace App\Livewire\Frontend\Lifetracking;

use Livewire\Component;
use App\Services\CartService;
use Illuminate\Support\Facades\Session;

class LifeTracking extends Component
{
    public $orderHash;
    protected $cartService;



    public function orderNow()
    {
        // Hier wird die Bestellung durchgeführt
        // Nachdem die Bestellung erfolgreich abgeschlossen wurde, rufe die clear-Methode des CartService auf
        $this->cartService->clear();
    }


    public function render()
    {
        $this->orderNow();

        return view('livewire.frontend.lifetracking.life-tracking');
    }

    public function mount($orderHash, CartService $cartService)
    {

        $this->cartService = $cartService;

        // Überprüfen, ob die Session einen Warenkorb hat
        if (Session::has('shopping-cart')) {
            // Holen Sie sich den aktuellen Warenkorb aus der Session
            $shoppingCart = Session::get('shopping-cart');


            // Aktualisiere den Warenkorb in der Session
            Session::put('shopping-cart', $shoppingCart);
        }
    }
}
