<?php

namespace App\Livewire\Frontend\Card;

use Carbon\Carbon;
use App\Facades\Cart;
use Livewire\Component;
use App\Models\DeliveryArea;
use Illuminate\Support\Facades\Session;
use App\Models\ModShop; // Stellen Sie sicher, dass das Modell importiert ist

class CartComponent extends Component
{
    public $cart = [];
    public $total = 0;
    public $content;
    public $deposit = 0;
    public $deliveryFee;
    public $deliveryFreeThreshold = 0;
    public $discount = 0;
    public $subtotal = 0;
    public $preorderTime;
    public $tipPercentage = null;
    public $tipAmount = 0;


    protected $listeners = [
        'productAddedToCart' => 'updateCart',
        'tipPercentage' => 'updateTipPercentage',
        'tipAmount' => 'updateTipAmount',
    ];

    public function mount(): void
    {
        $this->cart = Session::get('cart', []);
        $shopId = Session::get('shopId');
        $this->deliveryFee = Session::get("delivery_cost_$shopId", 0);
        $this->deliveryFreeThreshold = Session::get("delivery_free_threshold_$shopId", 0);
        $this->tipPercentage = Session::get('tipPercentage', null);
        $this->tipAmount = Session::get('tipAmount');

        $this->updateCart();
        $this->calculateSubTotal();
        $this->calculateTotal();
       // $this->setShowButton($shopId, true);
    }

    public function render()
    {
        return view('livewire.frontend.card.cart-component', [
            'total' => $this->total,
            'subtotal' => $this->subtotal,
            'cart' => $this->cart,
            'deposit' => $this->deposit,
            'deliveryFee' => $this->deliveryFee,
            'discount' => $this->discount,
            'content' => $this->content,
        ]);
    }

    public function setShowButton($shopId, $value)
    {
        // Hier wird der Wert für das Anzeigen des Buttons in der Session gespeichert
        Session::put("show_button_{$shopId}", $value);
    }

    public function updateCart()
    {
        $this->cart = Session::get('cart', []);
        $this->subtotal = Cart::subTotal();
        $this->content = Cart::content() ?? collect();

        $shopId = Session::get('shopId');
        $this->deliveryFee = Session::get("delivery_cost_$shopId", 0);

        $this->deliveryFreeThreshold = Session::get("delivery_free_threshold_$shopId", 0);

        $this->calculateTotal();
    }

    protected function calculateSubTotal()
    {
        $subTotal = 0;
        foreach ($this->cart as $item) {
            $subTotal += $item['price'] * $item['quantity'];
        }
        $this->subtotal = $subTotal;

        // Emit event to notify other components
        $this->dispatch('subtotalUpdated', $this->subtotal);
    }

    protected function calculateTotal()
    {
        $this->total = $this->subtotal;

        if ($this->subtotal < $this->deliveryFreeThreshold) {
            $this->total += $this->deliveryFee;
        }

        if ($this->tipPercentage > 0) {
            $this->total += round(($this->subtotal * ($this->tipPercentage / 100)), 2); // Rundet den Gesamtbetrag nach dem Tipp auf zwei Dezimalstellen
        } elseif ($this->tipAmount > 0) {
            $this->total += $this->tipAmount;
        }

        $this->total = round($this->total, 2); // Rundet den Gesamtbetrag auf zwei Dezimalstellen

        $this->dispatch('subtotalUpdated', $this->total);
    }

    public function clearCart(): void
    {
        Cart::clear();
        Session::forget('cart');
        $this->updateCart();
    }

    public function removeFromCart(string $id): void
    {
        Cart::remove($id);
        $this->updateCart();
    }

    public function updateCartItem(string $id, string $action): void
    {
        Cart::update($id, $action);
        $this->updateCart();
    }

    public function submitPreorder()
    {
        $this->validate([
            'preorderTime' => 'required|date|after:now',
        ]);

        // Logik zum Verarbeiten der Vorbestellung
        session()->flash('message', 'Vorbestellung erfolgreich aufgegeben für ' . Carbon::parse($this->preorderTime)->format('d.m.Y H:i'));
    }

    public function updateTipPercentage()
    {
        $this->tipPercentage = Session::get('tipPercentage', 0); // Update tip percentage from session
        $this->calculateTotal();
    }

    public function updateTipAmount()
    {
        $this->tipAmount = Session::get('tipAmount', 0); // Update tip percentage from session
        $this->calculateTotal();
    }
}
