<div>
    <ul class="clearfix">
        @if ($content->count() > 0)
            @foreach ($content as $id => $item)
                <li>

                    <button class="custom-cart-button" data-icon="&#x4f;"
                        wire:click="updateCartItem({{ $id }}, 'minus')"></button>
                    <a wire:click="updateCartItem({{ $id }}, 'minus')">{{ $item->get('quantity') }} x
                        {{ $item->get('name') }} {{ $item->get('size') }}
                    </a>
                    <span>{{ number_format($item->get('price'), 2) }}</span>
                    <button class="custom-cart-button" data-icon="&#x50;"
                        wire:click="updateCartItem({{ $id }}, 'plus')"></button>
                    <button class="custom-cart-button" aria-hidden="true" data-icon="&#x51;"
                        wire:click="removeFromCart({{ $id }})" style="border: none;"></button>



                        @if ($item->get('options'))
                        <span class="text-gray-500">Toppings:</span>
                        @php
                            $toppingCounts = [];
                        @endphp
                        @foreach ($item->get('options') as $topping)
                            @php
                                // Überprüfen, ob der Topping bereits in der Zählvariable vorhanden ist
                                if (array_key_exists($topping['productName'], $toppingCounts)) {
                                    // Wenn ja, erhöhen Sie die Anzahl
                                    $toppingCounts[$topping['productName']]++;
                                } else {
                                    // Andernfalls fügen Sie den Topping der Zählvariable hinzu und setzen die Anzahl auf 1
                                    $toppingCounts[$topping['productName']] = 1;
                                }
                            @endphp
                        @endforeach

                        @foreach ($toppingCounts as $toppingName => $count)
                            <span class="text-gray-500">{{ $count }}x{{ $toppingName }}</span>
                        @endforeach
                    @endif





                </li>
            @endforeach
    </ul>

    <ul class="clearfix">
        <li>Subtotal<span>${{ $total }}</span></li>
        <li>Delivery fee<span>$10</span></li>
        <li class="total">Total<span>${{ $total }}</span></li>
    </ul>

    <button class="w-full p-2 border-2 rounded border-red-500 hover:border-red-600 bg-red-500 hover:bg-red-600"
        wire:click="clearCart">Clear Cart</button>
@else
    <p class="text-3xl text-center mb-2">cart is empty!</p>
    @endif

</div>
