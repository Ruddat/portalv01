<?php

namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Session\SessionManager;

class CartService {
    const MINIMUM_QUANTITY = 1;
    const DEFAULT_INSTANCE = 'shopping-cart';

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
    }

/**
 * Adds a new item to the cart.
 *
 * @param string $id
 * @param string $name
 * @param string $price
 * @param string $quantity
 * @param array $options
 * @return void
 */
public function add($id, $name, $price, $size, $quantity, $options = []): void
{

   // $sizeArray = ['S', 'M', 'L'];
   // $size = 'M';


   // $sizeString = implode(', ', $sizeArray);

    $cartItem = $this->createCartItem($name, $price, $quantity, $size, $options);

    $content = $this->getContent();

    if ($content->has($id)) {
        // Falls das Produkt bereits im Warenkorb ist, aktualisieren Sie die vorhandene Zeile
        $existingQuantity = $content->get($id)->get('quantity');
        $cartItem->put('quantity', $existingQuantity + $quantity);
    }

    // Fügen Sie das Produkt (oder die aktualisierte Zeile) zum Warenkorbinhalt hinzu
    $content->put($id, $cartItem);

    // Aktualisieren Sie den Warenkorb im Sitzungsspeicher
    $this->session->put(self::DEFAULT_INSTANCE, $content);
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

            $this->session->put(self::DEFAULT_INSTANCE, $content);
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
            $this->session->put(self::DEFAULT_INSTANCE, $content->except($id));
        }
    }

    /**
     * Clears the cart.
     *
     * @return void
     */
    public function clear(): void
    {
        $this->session->forget(self::DEFAULT_INSTANCE);
    }

    /**
     * Returns the content of the cart.
     *
     * @return Illuminate\Support\Collection
     */
    public function content(): Collection
    {
        return is_null($this->session->get(self::DEFAULT_INSTANCE)) ? collect([]) : $this->session->get(self::DEFAULT_INSTANCE);
    }

    /**
     * Returns total price of the items in the cart.
     *
     * @return string
     */
    public function total(): string
    {
        $content = $this->getContent();

        $total = $content->reduce(function ($total, $item) {
            return $total += $item->get('price') * $item->get('quantity');
        });

        return number_format($total, 2);
    }

    /**
     * Returns the content of the cart.
     *
     * @return Illuminate\Support\Collection
     */
    protected function getContent(): Collection
    {
        return $this->session->has(self::DEFAULT_INSTANCE) ? $this->session->get(self::DEFAULT_INSTANCE) : collect([]);
    }

/**
 * Creates a new cart item from given inputs.
 *
 * @param string $name
 * @param string $price
 * @param string $quantity
 * @param string $size
 * @param array $options
 * @return Illuminate\Support\Collection
 */
protected function createCartItem(string $name, string $price, string $quantity, string $size, array $options): Collection
{
    $price = floatval($price);
    $quantity = intval($quantity);

    if ($quantity < self::MINIMUM_QUANTITY) {
        $quantity = self::MINIMUM_QUANTITY;
    }

    return collect([
        'name' => $name,
        'price' => $price,
        'quantity' => $quantity,
        'size' => $size,
        'options' => $options,
    ]);
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

}
