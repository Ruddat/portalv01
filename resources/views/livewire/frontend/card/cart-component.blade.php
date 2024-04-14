<div>
    <ul class="clearfix">
        @if ($content->count() > 0)
            @foreach ($content as $id => $item)
                <li>

                    <button class="custom-cart-button" data-icon="&#x4f;"
                        wire:click="updateCartItem({{ $id }}, 'minus')"></button>
                    <a wire:click="updateCartItem({{ $id }}, 'minus')">{{ $item->get('quantity') }} x
                        {{ $item->get('name') }}</br> {{ $item->get('size') }}
                    </a>
                    <span>{{ number_format($item->get('price'), 2) }}</span>
                    <button class="custom-cart-button" data-icon="&#x50;"
                        wire:click="updateCartItem({{ $id }}, 'plus')"></button>
                    <button class="custom-cart-button" aria-hidden="true" data-icon="&#x51;"
                        wire:click="removeFromCart({{ $id }})" style="border: none;"></button>
                    <p>

                        @foreach ($item->get('options') as $option)
                            {{ htmlspecialchars($option) }}
                        @endforeach

                    </p>

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

    <style>
        .custom-cart-button {
            border: none;
            background-color: #fff;
            font-size: 16px;
            font-size: 1rem;

            left: 0;
            top: 2px;
            line-height: 1;
        }
    </style>


</div>
