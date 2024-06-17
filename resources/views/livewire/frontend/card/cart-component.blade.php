<div wire:poll="updateCart">
    <div class="cart_table2">
        @if ($content && $content->count() > 0)
            @foreach ($content as $id => $item)
                <div class="table_head clearfix">
                    <button class="custom-cart-button left" data-icon="&#x4f;" wire:click="updateCartItem({{ $id }}, 'minus')"></button>
                    <span class="left cp cart_title" wire:click="updateCartItem({{ $id }}, 'minus')">
                        {{ $item->get('quantity') }} x {{ $item->get('name') }} {{ $item->get('size') }}
                    </span>
                    <span class="right">
                        {{ number_format($item->get('price'), 2) }} €
                        <button class="custom-cart-button right" data-icon="&#x50;" wire:click="updateCartItem({{ $id }}, 'plus')"></button>
                        <button class="custom-cart-button" aria-hidden="true" data-icon="&#x51;" wire:click="removeFromCart({{ $id }})" style="border: none;"></button>
                    </span>
                </div>

                @if ($item->get('options'))
                    <div class="table_inner">
                        @php
                            $toppingCounts = [];
                            $toppingPrices = [];
                        @endphp
                        @foreach ($item->get('options') as $topping)
                            @php
                                if (array_key_exists($topping['productName'], $toppingCounts)) {
                                    $toppingCounts[$topping['productName']]++;
                                    $toppingPrices[$topping['productName']] += $topping['price'];
                                } else {
                                    $toppingCounts[$topping['productName']] = 1;
                                    $toppingPrices[$topping['productName']] = $topping['price'];
                                }
                            @endphp
                        @endforeach

                        @foreach ($toppingCounts as $toppingName => $count)
                            <div class="table_row clearfix">
                                <span class="left cart_title">{{ $count }} x {{ $toppingName }}</span>
                                <span class="right">{{ number_format($toppingPrices[$toppingName], 2) }} €</span>
                            </div>
                        @endforeach
                    </div>
                @endif
            @endforeach
        @else
            <p class="text-3xl text-center mb-2">@autotranslate('cart is empty', app()->getLocale())</p>
        @endif
    </div>

    @if ($content && $content->count() > 0)
        <ul class="clearfix">
            <li>@autotranslate('Subtotal', app()->getLocale())<span>${{ $subtotal }}</span></li>

            @php
                $status = Session::get('status', 'delivery');
                $remainingAmountForFreeDelivery = max(0, $deliveryFreeThreshold - $subtotal);
            @endphp

            <li>@autotranslate('Liefergebühr', app()->getLocale())
                @if ($status === 'delivery')
                    @if ($subtotal < $deliveryFreeThreshold)
                        <span>{{ $deliveryFee }}</span>
                    @else
                    <span style="text-decoration: line-through;">{{ $deliveryFee }}</span>
                    <span style="color: green;">@autotranslate('Kostenlos', app()->getLocale()) &nbsp;&nbsp;</span>
                    @endif
                @else
                    <span>@autotranslate('Abholung', app()->getLocale())</span>
                @endif
            </li>

            @if ($status === 'delivery')
                <div class="row opt_deliver_fee">
                    <div class="col-12">
                        <li>
                            @if ($remainingAmountForFreeDelivery > 0)
                                <span>@autotranslate('Noch $', app()->getLocale()){{ $remainingAmountForFreeDelivery }} @autotranslate('for free delivery', app()->getLocale())</span>
                            @else
                                <span style="color: green">@autotranslate('Free Delivery', app()->getLocale())</span>
                            @endif
                        </li>
                    </div>
                </div>
            @endif

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

        <button class="w-full p-2 border-2 rounded border-red-500 hover:border-red-600 bg-red-500 hover:bg-red-600" wire:click="clearCart">Clear Cart</button>
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


        .cart_table2 {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
    }
    .table_head {
        display: flex;
        justify-content: space-between;
        padding: 10px;
        background: #f9f9f9;
        border-bottom: 1px solid #ddd;
    }
    .table_inner {
        background: #fff;
        padding: 10px;
        border-bottom: 1px solid #ddd;
    }
    .table_row {
    display: flex;
    justify-content: flex-end;
    padding: 5px 0;
    flex-wrap: wrap;
}
    .left {
        float: left;
    }
    .right {
        float: right;
    }
    .cp {
        cursor: pointer;
    }
    .cart_title {
        font-weight: bold;
        margin-right: 10px;
    }
    .custom-cart-button {
        background: none;
        border: none;
        font-size: 20px;
        cursor: pointer;
        margin-left: 5px;
    }
    .custom-cart-button:hover {
        color: #007bff;
    }

    </style>

    @push('scripts')
    <script>
        document.addEventListener('livewire:load', function () {
            $('.timepicker').timepicker({
                timeFormat: 'HH:mm',
                interval: 30,
                minTime: '00:00',
                maxTime: '23:59',
                defaultTime: '00:00',
                startTime: '00:00',
                dynamic: false,
                dropdown: true,
                scrollbar: true,
                change: function(time) {
                    @this.set('preorderTime', $(this).val());
                }
            });
        });
    </script>
    @endpush
</div>
