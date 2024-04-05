<div>
    <ul class="clearfix">
        @if ($content->count() > 0)
            @foreach ($content as $id => $item)
                <li>
                    <a wire:click="updateCartItem({{ $id }}, 'minus')">{{ $item->get('quantity') }} x {{ $item->get('name') }} {{ $item->get('size') }}</a> <span>{{ $item->get('price') }}</span>
                    <button class="" wire:click="updateCartItem({{ $id }}, 'minus')"> - </button>
                    <button class="" wire:click="updateCartItem({{ $id }}, 'plus')"> + </button>
                    <button class="fs1" aria-hidden="true" data-icon="" wire:click="removeFromCart({{ $id }})" style="border: none;"><i class="fs1"></i></button>
                    <br>
                    @foreach($item->get('options') as $option)
                        {{ htmlspecialchars($option) }}
                    @endforeach
                </li>
            @endforeach
        </ul>

        <ul class="clearfix">
            <li>Subtotal<span>${{ $total }}</span></li>
            <li>Delivery fee<span>$10</span></li>
            <li class="total">Total<span>${{ $total }}</span></li>
        </ul>

        <button class="w-full p-2 border-2 rounded border-red-500 hover:border-red-600 bg-red-500 hover:bg-red-600" wire:click="clearCart">Clear Cart</button>

        @else
        <p class="text-3xl text-center mb-2">cart is empty!</p>
        @endif
</div>
