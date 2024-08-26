<?php

namespace App\Livewire\Frontend\Cart;

use App\Models\ModShop;
use Livewire\Component;
use Illuminate\Support\Facades\Log;
use App\Services\OpeningHoursService;
use Illuminate\Support\Facades\Session;

class OrderButtonComponent extends Component
{
    public $restaurantId;
    public $minimumOrderValue;
    public $currentOrderValue;
    public $isOpen;
    public $canOrder = true;
    public $message = '';
    public $cart = [];
    public $subTotal = 0;
    public $showOrderDetailsButton = false;

    protected $listeners = ['subtotalUpdated'];

    public function mount($restaurantId)
    {
        $this->restaurantId = $restaurantId;

        // Werte aus der Session laden
        $this->minimumOrderValue = Session::get("delivery_charge_$restaurantId", 0);
        $this->deliveryFee = Session::get("delivery_cost_$restaurantId", 0);
        $this->deliveryFree = Session::get("delivery_charge_$restaurantId", 0);
        $this->deliveryFreeThreshold = Session::get("free_delivery_threshold_$restaurantId", 0);
        $this->deliveryOrPickup = Session::get("delivery_or_pickup_$restaurantId", 0);

//dd($this->deliveryOrPickup);
        // Debugging
        Log::info("Minimum Order Value: {$this->minimumOrderValue}");
        Log::info("Delivery Fee: {$this->deliveryFee}");
        Log::info("Delivery Free: {$this->deliveryFree}");
        Log::info("Delivery Free Threshold: {$this->deliveryFreeThreshold}");


        // Den Zustand aus der Session lesen
        $this->showOrderDetailsButton = Session::get("show_button_{$restaurantId}", false);

        // Initialisiere die Logik zum Überprüfen der Bedingungen
        $this->checkConditions();
    }

    public function subtotalUpdated($subtotal)
    {
        // Aktualisiere den aktuellen Bestellwert und überprüfe die Bedingungen
        $this->currentOrderValue = $subtotal;
        $this->checkConditions();
    }

    public function checkConditions()
    {

        // $shop = ModShop::find($this->restaurantId);
        $shop = ModShop::where('id', $this->restaurantId)->first();
        //dd($shop);

        // Checke ob der Shop geöffnet ist
        $this->isOpen = OpeningHoursService::isOpen($shop);

        // Shopstatus überprüfen
        $this->shopStatus = OpeningHoursService::getShopStatus($shop);

        // Hole die aktuelle Auswahl für Lieferung oder Abholung
        $this->deliveryOrPickup = Session::get("delivery_or_pickup_$this->restaurantId", 0);

        // Prüfe, ob bereits eine Vorbestellzeit in der Session gesetzt wurde
        $selectedTime = Session::get('selectedTime');

        // Wenn eine Vorbestellzeit gesetzt ist, ignoriere die Shop-Öffnungszeiten
        if ($selectedTime) {
            // Vorbestellzeit gesetzt, normaler Bestellprozess unabhängig von Öffnungszeiten
            $this->message = '';

            if ($this->deliveryOrPickup === 'delivery') {
                // Überprüfe den Mindestbestellwert nur bei Lieferung
                if ($this->currentOrderValue < $this->minimumOrderValue) {
                    // Berechne den fehlenden Betrag und formatiere ihn als Euro-Wert
                    $missingAmount = $this->minimumOrderValue - $this->currentOrderValue;
                    $formattedAmount = number_format($missingAmount, 2, ',', '.') . ' €';

                    // Aktualisiere die Nachricht mit dem formatierten Betrag
                    $this->message = 'Noch ' . $formattedAmount . ' bis zum Mindestbestellwert';
                    $this->canOrder = false;
                } else {
                    $this->canOrder = true;
                    $this->message = '';
                }
            } elseif ($this->deliveryOrPickup === 'pickup') {
                // Bei Abholung gibt es keinen Mindestbestellwert
                $this->canOrder = true;
                $this->message = '';
            } else {
                $this->message = 'Bitte wählen Sie eine Liefer- oder Abholoption aus.';
                $this->canOrder = false;
            }
        } elseif (!$this->isOpen && $this->shopStatus === 'on') {
            // Shop ist geschlossen, aber Vorbestellungen sind möglich
            $this->message = 'Vorbestellung möglich. Bitte wählen Sie eine Lieferzeit aus.';
            $this->canOrder = false; // Button bleibt deaktiviert, bis eine Zeit ausgewählt wird

            // Nur öffnen, wenn noch keine Vorbestellzeit gesetzt ist
            if (!$selectedTime) {
                $this->dispatch('openTimepicker'); // Öffnet den Timepicker
            }
        } else {
            $this->canOrder = false;
            $this->message = 'Der Shop ist derzeit geschlossen und keine Vorbestellung ist möglich.';
        }
    }





    public function checkIfRestaurantIsOpen()
    {
        // Hier kann die Logik implementiert werden, um zu überprüfen, ob das Restaurant geöffnet ist
        return true; // Platzhalter
    }

    public function render()
    {
        return view('livewire.frontend.cart.order-button-component'
            , [
                'message' => $this->message,
                'canOrder' => $this->canOrder,
                'showOrderDetailsButton' => $this->showOrderDetailsButton,
            ]);
    }
}
