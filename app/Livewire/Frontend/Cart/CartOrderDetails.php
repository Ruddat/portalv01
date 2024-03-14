<?php

namespace App\Livewire\Frontend\Cart;

use App\Models\ModShop; 
use Livewire\Component;

class CartOrderDetails extends Component
{
    public $shopData;

    public function mount($restaurantId)
    {
        // Abrufen der Shop-Daten anhand der ID oder eine Fehlermeldung anzeigen, falls nicht gefunden
        $this->shopData = ModShop::findOrFail($restaurantId);
    }

    public function render()
    {
        return view('livewire.frontend.cart.cart-order-details', [
            'shopData' => $this->shopData,
        ]);
    }
}
