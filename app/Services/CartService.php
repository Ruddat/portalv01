<?php

namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Session\SessionManager;
use Illuminate\Support\Facades\Session;

class CartService {
    const MINIMUM_QUANTITY = 1;

    protected $session;
    protected $instance;

    /**
     * Constructs a new cart object.
     *
     * @param Illuminate\Session\SessionManager $session
     */
    public function __construct(SessionManager $session)
    {
        $this->session = $session;
        $this->instance = 'shopping-cart-' . $this->getShopId();
    }

    /**
     * Adds a new item to the cart.
     *
     * @param string $id
     * @param string $name
     * @param string $price
     * @param string $size
     * @param string $quantity
     * @param string $productCode
     * @param array $options
     * @return void
     */
    public function add($id, $name, $price, $size, $quantity, $productCode, $options = []): void
    {
        $cartItem = $this->createCartItem($name, $price, $quantity, $size, $productCode, $options);
        $content = $this->getContent();

        if ($content->has($id)) {
            // If the product already exists in the cart, update the existing line
            $existingQuantity = $content->get($id)->get('quantity');
            $cartItem->put('quantity', $existingQuantity + $quantity);
        }

        // Add the product (or updated line) to the cart content
        $content->put($id, $cartItem);

        // Update the cart in the session storage
        $this->session->put($this->instance, $content);
    }

    /**
     * Updates the quantity of a cart item.
     *
     * @param string $id
     * @param string $action
     * @return void
     */
    public function update(string $id, string $action): void
    {
        $content = $this->getContent();

        if ($content->has($id)) {
            $cartItem = $content->get($id);

            switch ($action) {
                case 'plus':
                    $cartItem->put('quantity', $content->get($id)->get('quantity') + 1);
                    break;
                case 'minus':
                    $updatedQuantity = $content->get($id)->get('quantity') - 1;

                    if ($updatedQuantity < self::MINIMUM_QUANTITY) {
                        $updatedQuantity = self::MINIMUM_QUANTITY;
                    }

                    $cartItem->put('quantity', $updatedQuantity);
                    break;
            }

            $content->put($id, $cartItem);

            $this->session->put($this->instance, $content);
        }
    }

    /**
     * Removes an item from the cart.
     *
     * @param string $id
     * @return void
     */
    public function remove(string $id): void
    {
        $content = $this->getContent();

        if ($content->has($id)) {
            $this->session->put($this->instance, $content->except($id));
        }
    }

    /**
     * Clears the cart.
     *
     * @return void
     */
    public function clear(): void
    {
        $this->session->forget($this->instance);
    }

    /**
     * Returns the content of the cart.
     *
     * @return Illuminate\Support\Collection
     */
    public function content(): Collection
    {
        return is_null($this->session->get($this->instance)) ? collect([]) : $this->session->get($this->instance);
    }

    /**
     * Returns total price of the items in the cart including delivery fee if applicable.
     *
     * @return string
     */
    public function total(): string
    {
        $content = $this->getContent();

        $total = $content->reduce(function ($total, $item) {
            return $total += $item->get('price') * $item->get('quantity');
        }, 0);

        $shopId = $this->getShopId();
        $status = Session::get('status', 'delivery');

        if ($status === 'delivery') {
            $deliveryFee = Session::get("delivery_cost_$shopId", 0);
            $deliveryFreeThreshold = Session::get("delivery_free_threshold_$shopId", 0);

            if ($total < $deliveryFreeThreshold) {
                $total += $deliveryFee;
            }
        }

        return number_format($total, 2);
    }

    /**
     * Returns total price of the items in the cart.
     *
     * @return string
     */
    public function subTotal(): string
    {
        $content = $this->getContent();

        $total = $content->reduce(function ($total, $item) {
            return $total += $item->get('price') * $item->get('quantity');
        }, 0);

        return number_format($total, 2);
    }

    /**
     * Returns the content of the cart.
     *
     * @return Illuminate\Support\Collection
     */
    protected function getContent(): Collection
    {
        return $this->session->has($this->instance) ? $this->session->get($this->instance) : collect([]);
    }

    /**
     * Creates a new cart item from given inputs.
     *
     * @param string $name
     * @param string $price
     * @param string $quantity
     * @param string $size
     * @param string $productCode
     * @param array $options
     * @return Illuminate\Support\Collection
     */
    protected function createCartItem(string $name, string $price, string $quantity, string $size, string $productCode, array $options): Collection
    {
        $price = floatval($price);
        $quantity = intval($quantity);

        if ($quantity < self::MINIMUM_QUANTITY) {
            $quantity = self::MINIMUM_QUANTITY;
        }

        $cartItem = [
            'code' => $productCode,
            'name' => $name,
            'price' => $price,
            'quantity' => $quantity,
            'size' => $size,
        ];

        if (!is_null($options)) {
            $cartItem['options'] = $options;
        }

        return collect($cartItem);
    }

    /**
     * Checks if the cart is empty.
     *
     * @return bool
     */
    public function isEmpty(): bool
    {
        return $this->content()->isEmpty();
    }

    /**
     * Gets the current shop ID from the session.
     *
     * @return string|null
     */
    protected function getShopId(): ?string
    {
        return Session::get('shopId');
    }
}
