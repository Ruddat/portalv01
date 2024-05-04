<?php

namespace App\Livewire\Frontend\Lifetracking;

use Livewire\Component;
use App\Models\ModOrders;
use App\Services\CartService;
use Illuminate\Support\Facades\Session;

class LifeTracking extends Component
{
    public $orderHash;
    protected $cartService;

    public $latitude;
    public $longitude;

    public function orderNow()
    {
    // Hier wird die Bestellung durchgeführt
    // Nachdem die Bestellung erfolgreich abgeschlossen wurde, rufe die clear-Methode des CartService auf
    $order = ModOrders::where('hash', $this->orderHash)->first();

    // Extrahiere Breitengrad und Längengrad aus der Order
    $latitude = $order->shipping_lat;
    $longitude = $order->shipping_lng;


    //    dd($order);

//        $this->cartService->clear();
    }


    public function simulateTracking()
    {
        // Hier simulieren wir die Aktualisierung der Position des Benutzers
        // In einem echten Szenario würdest du die Position vom GPS-Gerät des Benutzers erhalten

        // Zufällige Änderungen an der Position des Benutzers (für Demonstration)
        $this->latitude += rand(-1, 1) * 0.01;
        $this->longitude += rand(-1, 1) * 0.01;

        // Aktualisiere die Position auf der Karte
        $this->dispatch('updatePosition', ['latitude' => $this->latitude, 'longitude' => $this->longitude]);
    }



    public function render()
    {
        $this->orderNow();

        return view('livewire.frontend.lifetracking.life-tracking');
    }

    public function mount($orderHash, CartService $cartService)
    {

            // Hier kannst du die Werte aus der Datenbank abrufen und zuweisen
    $order = ModOrders::where('hash', $orderHash)->first();
    $this->latitude = $order->shipping_lat;
    $this->longitude = $order->shipping_lng;

                // Setze die anfängliche Position des Benutzers (hier einfach ein Beispielwert)
             //   $this->latitude = 51.505;
             //   $this->longitude = -0.09;

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
