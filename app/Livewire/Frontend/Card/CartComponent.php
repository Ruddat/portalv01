<?php

namespace App\Livewire\Frontend\Card;

use App\Facades\Cart;
use Livewire\Component;
use Illuminate\Support\Facades\Session;

class CartComponent extends Component
{
    public $cart = [];
    public $total = 0;
    public $content;
    public $deposit = 0;
    public $deliveryFee;
    public $deliveryFreeThreshold = 30;
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
//dd($this->deliveryFee);
        $this->updateCart();
        $this->calculateSubTotal();
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
        $this->total = Cart::total();
        $this->content = Cart::content() ?? collect();

        $shopId = Session::get('shopId');
        $this->deliveryFee = Session::get("delivery_cost_$shopId", 0); // Standardwert 0 falls nicht gesetzt

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
        $total = 0;
        foreach ($this->cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        $this->total = $total;
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
