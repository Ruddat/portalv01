<?php

namespace App\Livewire\Frontend\Cart;

use Livewire\Component;

class OrderButtonComponent extends Component
{

    public $restaurantId;
    public $minimumOrderValue;
    public $currentOrderValue;
    public $isOpen;
    public $canOrder = false;
    public $message = '';

    public function mount($restaurantId, $minimumOrderValue)
    {
        $this->restaurantId = $restaurantId;
        $this->minimumOrderValue = $minimumOrderValue;
       //dd($this->restaurantId, $this->minimumOrderValue);

        $this->checkConditions();
    }

    public function checkConditions()
    {
        // Hier sollte die Logik zur Überprüfung, ob das Restaurant geöffnet ist, implementiert werden
        $this->isOpen = $this->checkIfRestaurantIsOpen();

        // Hier sollte die Logik zur Berechnung des aktuellen Bestellwerts implementiert werden
        $this->currentOrderValue = $this->calculateCurrentOrderValue();

        if (!$this->isOpen) {
            $this->message = 'Vorbestellung möglich';
        } elseif ($this->currentOrderValue < $this->minimumOrderValue) {
            $this->message = 'Noch ' . ($this->minimumOrderValue - $this->currentOrderValue) . ' bis zum Mindestbestellwert';
        } else {
            $this->canOrder = true;
            $this->message = '';
        }
    }

    public function checkIfRestaurantIsOpen()
    {
        // Implementiere hier die Logik zur Überprüfung, ob das Restaurant geöffnet ist
        // Beispiel: return Restaurant::find($this->restaurantId)->isOpen();
        return true; // Platzhalter
    }

    public function calculateCurrentOrderValue()
    {
        // Implementiere hier die Logik zur Berechnung des aktuellen Bestellwerts
        // Beispiel: return CartService::getTotal();
        return 0; // Platzhalter
    }

    public function render()
    {
        return view('livewire.frontend.cart.order-button-component');
    }
}
