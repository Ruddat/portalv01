<!-- resources/views/livewire/frontend/card/new-shopping-cart.blade.php -->

@if (session()->has('success_message'))
    <div class="alert alert-success">
        {{ session('success_message') }}
    </div>
@endif
<div>

        <div class="cart-table">
            @foreach (Cart::content() as $item)
                <div class="cart-table table    table-responsive">
                    <div class="cart-table                  table-responsive">
                        <div class="cart-table__product">
                            <div class="cart-table  __product__image">
                                <img src="{{ asset('frontend/img/products/') }}" alt="product">
                            </div>
                            <div class="cart-table
                                __product__content">
                                <h5></h5>
                                <p></p>
                            </div>
                        </div>
                        <div class="cart-table
                            __price">12</div>
                        <div class="cart-table
                            __quantity">
                            <button wire:click="decreaseQuantity('')" class="btn btn-sm btn-outline-secondary">-</button>
                            <input class="form-control" type="text" value="" readonly>
                            <button wire:click="increaseQuantity('')" class="btn btn-sm btn-outline-secondary">+</button>
                        </div>
                        <div class="cart-table
                            __total"></div>
                        <div class="cart-table
                            __remove">
                            <button wire:click="removeFromCart('')" class="btn btn-sm btn-outline-secondary">Remove</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="cart-totals">
            <div class="cart-totals__subtotals">
                Subtotal: 0
            </div>
            @if (session()->has('coupon'))
                <div class="cart-totals__discount">
                    Discount (): -0                </div>
                <div class="cart-totals__new-subtotals">
                    New Subtotal:
                </div>
            @endif
            <div class="cart-totals__tax">
                Tax
            </div>
            <div class="cart-totals__total">
                Total:0
            </div>
            <div class="cart-totals__buttons">
                <a href="#" class="btn btn-outline-secondary">Continue Shopping</a>
                <a href="#" class="btn btn-secondary">Proceed to Checkout</a>
            </div>
        </div>
        @if (!session()->has('coupon'))
            <div class="cart-coupon">
                <input wire:model="couponCode" type="text" class="form-control" placeholder="Enter your coupon code">
                <button wire:click="applyCoupon" class="btn btn-sm btn-outline-secondary">Apply</button>
            </div>
        @endif






    <h2>Warenkorb</h2>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Preis</th>
                <th>Menge</th>
                <th>Gesamt</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cart as $item)
                <tr>
                    <td>{{ $item['name'] }}</td>
                    <td>{{ $item['price'] }}</td>
                    <td>{{ $item['quantity'] }}</td>
                    <td>{{ $item['price'] * $item['quantity'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
