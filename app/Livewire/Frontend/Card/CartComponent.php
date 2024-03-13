<?php

namespace App\Livewire\Frontend\Card;

use App\Facades\Cart;
use Livewire\Component;
use Illuminate\Support\Facades\Session;

class CartComponent extends Component
{
    public $cart;
    protected $total;
    protected $content;
    protected $listeners = [
        'productAddedToCart' => 'updateCart',
    ];

    public function mount(): void
    {
        $this->cart = Session::get('cart', []);
       // $this->content = collect($this->cart); // Konvertiere das Array $cart in eine Collection $content

        $this->updateCart();

        // Berechne den Gesamtpreis des Warenkorbs
       // $this->total = $this->calculateTotal();
    }

    public function render()
    {
        return view('livewire.frontend.card.cart-component', [
            'total' => $this->total,
            'cart' => $this->cart,
            'content' => $this->content,
        ]);
    }

    public function updateCart()
    {
        $this->total = Cart::total();
        $this->content = Cart::content();
    }

    protected function calculateTotal()
    {
        // Berechne den Gesamtpreis des Warenkorbs
        $total = 0;
        foreach ($this->cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return $total;
    }

        /**
     * Clears the cart content.
     *
     * @return void
     */
    public function clearCart(): void
    {
        Cart::clear();
        $this->updateCart();
    }

        /**
     * Removes a cart item by id.
     *
     * @param string $id
     * @return void
     */
    public function removeFromCart(string $id): void
    {
        Cart::remove($id);
        $this->updateCart();
    }

        /**
     * Updates a cart item.
     *
     * @param string $id
     * @param string $action
     * @return void
     */
    public function updateCartItem(string $id, string $action): void
    {
        Cart::update($id, $action);
        $this->updateCart();
    }
}
