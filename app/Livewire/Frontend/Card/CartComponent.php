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
    public $deliveryFreeThreshold = 0; // Setzen Sie den Standardwert auf 0
    public $discount = 0;
    public $subtotal = 0;
    public $preorderTime;

    protected $listeners = [
        'productAddedToCart' => 'updateCart',
    ];

    public function mount(): void
    {
        $this->cart = Session::get('cart', []);
        $shopId = Session::get('shopId');
        $this->deliveryFee = Session::get("delivery_cost_$shopId", 0);
        $this->deliveryFreeThreshold = Session::get("delivery_free_threshold_$shopId", 0);

        $this->updateCart();
        $this->calculateSubTotal();
        $this->calculateTotal();
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

    public function updateCart()
    {
        $this->cart = Session::get('cart', []);
        $this->subtotal = Cart::subTotal();
        $this->content = Cart::content() ?? collect();

        $shopId = Session::get('shopId');
        $this->deliveryFee = Session::get("delivery_cost_$shopId", 0); // Standardwert 0 falls nicht gesetzt

        // Laden Sie den `deliveryFreeThreshold`-Wert aus der Datenbank
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
    }

    protected function calculateTotal()
    {
        $this->total = $this->subtotal;

//dd($this->total, $this->subtotal);


        // Wenn der Schwellenwert für kostenlose Lieferung nicht erreicht ist, fügen Sie die Liefergebühr hinzu
        if ($this->subtotal < $this->deliveryFreeThreshold) {
            $this->total += $this->deliveryFee;
        }
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
}
