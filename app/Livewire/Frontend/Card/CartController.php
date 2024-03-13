<?php

namespace App\Livewire\Frontend\Card;

use Livewire\Component;

use Cart;



class CartController extends Component
{




    public function updateCart($rowId, $quantity)
    {
        Cart::update($rowId, $quantity);
        $this->emit('cartUpdated');
    }

    public function removeFromCart($rowId)
    {
        Cart::remove($rowId);
        $this->emit('cartUpdated');
    }


    public function render()
    {
        return view('livewire.frontend.card.cart-controller');
    }
}
