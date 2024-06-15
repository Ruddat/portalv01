<div wire:poll="updateCart">
    <ul class="clearfix">
        @if ($content && $content->count() > 0)
            @foreach ($content as $id => $item)
                <li>
                    <button class="custom-cart-button" data-icon="&#x4f;" wire:click="updateCartItem({{ $id }}, 'minus')"></button>
                    <a wire:click="updateCartItem({{ $id }}, 'minus')">{{ $item->get('quantity') }} x {{ $item->get('name') }} {{ $item->get('size') }}</a>
                    <span>{{ number_format($item->get('price'), 2) }}</span>
                    <button class="custom-cart-button" data-icon="&#x50;" wire:click="updateCartItem({{ $id }}, 'plus')"></button>
                    <button class="custom-cart-button" aria-hidden="true" data-icon="&#x51;" wire:click="removeFromCart({{ $id }})" style="border: none;"></button>

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
                $status = Session::get('status', 'delivery');
                $remainingAmountForFreeDelivery = max(0, $deliveryFreeThreshold - $total);
            @endphp

            <li>{{ app(\App\Services\TranslationService::class)->trans('Liefergebühr', app()->getLocale()) }}
                @if ($status === 'delivery')
                    @if ($total < $deliveryFreeThreshold)
                        <span>{{ $deliveryFee }}</span>
                    @else
                    <span style="text-decoration: line-through;">{{ $deliveryFee }}</span>
                    <span style="color: green;">@autotranslate('Kostenlos', app()->getLocale()) &nbsp;&nbsp;</span>
                    @endif
                @else
                    <span>{{ __('Abholung') }}</span>
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

            <li class="total">Total<span>${{ $total }}</span></li>
        </ul>

        <div class="preorder-section">
            <label for="preorder-time">Vorbestellungszeit auswählen:</label>
            <input type="text" id="preorder-time" class="timepicker" wire:model="preorderTime">
            @error('preorderTime')
                <span class="error">{{ $message }}</span>
            @enderror
            <button type="button" wire:click="submitPreorder">Vorbestellen</button>
        </div>

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

        .preorder-section {
            margin-top: 20px;
        }

        .preorder-section label {
            display: block;
            margin-bottom: 5px;
        }

        .preorder-section input {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
        }

        .preorder-section button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        .preorder-section button:hover {
            background-color: #45a049;
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
