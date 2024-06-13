<div wire:poll="updateCart">
    <ul class="clearfix">
        @if ($content && $content->count() > 0)
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
                        <div class="ingredients">Toppings:</div>

                        @php
                            $toppingCounts = [];
                        @endphp
                        <ul>
                            @foreach ($item->get('options') as $topping)
                                @php
                                    if (array_key_exists($topping['productName'], $toppingCounts)) {
                                        $toppingCounts[$topping['productName']]++;
                                    } else {
                                        $toppingCounts[$topping['productName']] = 1;
                                    }
                                @endphp
                            @endforeach

                            @foreach ($toppingCounts as $toppingName => $count)
                                <li class="text-red-500">{{ $count }}x{{ $toppingName }}</li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endforeach
        @else
            <p class="text-3xl text-center mb-2">@autotranslate('cart is empty', app()->getLocale())</p>
        @endif
    </ul>

    @if ($content && $content->count() > 0)
    <ul class="clearfix">
        <li>@autotranslate('Subtotal', app()->getLocale())<span>${{ $subtotal }}</span></li>

        @php
            $remainingAmountForFreeDelivery = max(0, $deliveryFreeThreshold - $total);
        @endphp

        <li>
            @autotranslate('Liefergebühr', app()->getLocale())
            @if ($remainingAmountForFreeDelivery > 0)
                <span>{{ $deliveryFee }}</span>
            @else
                <span style="text-decoration: line-through;"> ${{ $deliveryFee }}</span>
                <span style="color: green">@autotranslate('Kostenlos ', app()->getLocale()) </span>
            @endif
        </li>

        <div class="row opt_deliver_fee">
            <div class="col-12">
                <li>
                    @if ($remainingAmountForFreeDelivery > 0)
                        <span>{{ __('Noch $') }}{{ $remainingAmountForFreeDelivery }} @autotranslate('for free delivery', app()->getLocale())</span>
                    @else
                        <span style="color: green">@autotranslate('Free Delivery', app()->getLocale())</span>
                    @endif
                </li>
            </div>
        </div>

        @if ($discount > 0)
            <li>@autotranslate('discount', app()->getLocale())</li>
            <span>{{ $discount }}</span>
        @endif
        @if ($deposit > 0)
            <li>@autotranslate('deposit', app()->getLocale())
                <span>{{ $deposit }}</span>
            </li>
        @endif

        <li class="total">@autotranslate('Total', app()->getLocale())<span>${{ $total }}</span></li>
    </ul>

    <button class="w-full p-2 border-2 rounded border-red-500 hover:border-red-600 bg-red-500 hover:bg-red-600"
        wire:click="clearCart">Clear Cart</button>
    @endif

    <style>
        .box_order .ingredients {
            float: left;
        }

        .opt_deliver_fee {
            border-top: 1px solid #ededed;
            border-bottom: 1px solid #ededed;
            margin-bottom: 20px;
            padding: 15px 0 5px 0;
            background-color: lightgreen;
        }
    </style>
</div>
