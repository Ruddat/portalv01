<div>
    {{-- Stop trying to control. --}}







    <div class="container margin_60_20">

        <div class="row">
            <div class="col-xl-8">

                <div class="card">
                    <div class="card-body">
                        <ol class="activity-checkout mb-0 px-4 mt-3">
                            <li class="checkout-item">
                                <div class="avatar checkout-icon p-1">
                                    <div class="avatar-title rounded-circle bg-primary">
                                        <i class="bx bxs-receipt text-white font-size-20"></i>
                                    </div>
                                </div>
                                <div class="feed-item-list">
                                    <div>
                                        <h5 class="font-size-16 mb-1">Billing Info</h5>
                                        <p class="text-muted text-truncate mb-4">Sed ut perspiciatis unde omnis iste</p>
                                        <div class="mb-3">
                                            <form>
                                                <div>
                                                    <div class="row">
                                                        <div class="col-lg-4">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="billing-name">Name</label>
                                                                <input type="text" class="form-control" id="billing-name" placeholder="Enter name">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="billing-email-address">Email Address</label>
                                                                <input type="email" class="form-control" id="billing-email-address" placeholder="Enter email">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="billing-phone">Phone</label>
                                                                <input type="text" class="form-control" id="billing-phone" placeholder="Enter Phone no.">
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="billing-phone">Phone</label>
                                                            <input type="text" class="form-control" id="billing-phone" placeholder="Enter Phone no.">
                                                        </div>
                                                    </div>
                                                </div>



                                                    <div class="mb-3">
                                                        <label class="form-label" for="billing-address">Address</label>
                                                        <textarea class="form-control" id="billing-address" rows="3" placeholder="Enter full address"></textarea>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-lg-4">
                                                            <div class="mb-4 mb-lg-0">
                                                                <label class="form-label">Country</label>
                                                                <select class="form-control form-select" title="Country">
                                                                    <option value="0">Select Country</option>
                                                                    <option value="AF">Afghanistan</option>
                                                                    <option value="AL">Albania</option>
                                                                    <option value="DZ">Algeria</option>
                                                                    <option value="AS">American Samoa</option>
                                                                    <option value="AD">Andorra</option>
                                                                    <option value="AO">Angola</option>
                                                                    <option value="AI">Anguilla</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-4">
                                                            <div class="mb-4 mb-lg-0">
                                                                <label class="form-label" for="billing-city">City</label>
                                                                <input type="text" class="form-control" id="billing-city" placeholder="Enter City">
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-4">
                                                            <div class="mb-0">
                                                                <label class="form-label" for="zip-code">Zip / Postal code</label>
                                                                <input type="text" class="form-control" id="zip-code" placeholder="Enter Postal code">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            @if (Auth::guard('client')->check())
                            <li class="checkout-item">
                                <div class="avatar checkout-icon p-1">
                                    <div class="avatar-title rounded-circle bg-primary">
                                        <i class="bx bxs-truck text-white font-size-20"></i>
                                    </div>
                                </div>
                                <div class="feed-item-list">
                                    <div>
                                        <h5 class="font-size-16 mb-1">Shipping Info</h5>
                                        <p class="text-muted text-truncate mb-4">Neque porro quisquam est</p>
                                        <div class="mb-3">
                                            <div class="row">
                                                <div class="col-lg-4 col-sm-6">
                                                    <div data-bs-toggle="collapse">
                                                        <label class="card-radio-label mb-0">
                                                            <input type="radio" name="address" id="info-address1" class="card-radio-input" checked="">
                                                            <div class="card-radio text-truncate p-3">
                                                                <span class="fs-14 mb-4 d-block">Address 1</span>
                                                                <span class="fs-14 mb-2 d-block">Bradley McMillian</span>
                                                                <span class="text-muted fw-normal text-wrap mb-1 d-block">109 Clarksburg Park Road Show Low, AZ 85901</span>
                                                                <span class="text-muted fw-normal d-block">Mo. 012-345-6789</span>
                                                            </div>
                                                        </label>
                                                        <div class="edit-btn bg-light rounded">
                                                            <a href="#" data-bs-toggle="tooltip" data-placement="top" title="" data-bs-original-title="Edit">
                                                                <i class="bx bx-pencil font-size-16"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-sm-6">
                                                    <div>
                                                        <label class="card-radio-label mb-0">
                                                            <input type="radio" name="address" id="info-address2" class="card-radio-input">
                                                            <div class="card-radio text-truncate p-3">
                                                                <span class="fs-14 mb-4 d-block">Address 2</span>
                                                                <span class="fs-14 mb-2 d-block">Bradley McMillian</span>
                                                                <span class="text-muted fw-normal text-wrap mb-1 d-block">109 Clarksburg Park Road Show Low, AZ 85901</span>
                                                                <span class="text-muted fw-normal d-block">Mo. 012-345-6789</span>
                                                            </div>
                                                        </label>
                                                        <div class="edit-btn bg-light rounded">
                                                            <a href="#" data-bs-toggle="tooltip" data-placement="top" title="" data-bs-original-title="Edit">
                                                                <i class="bx bx-pencil font-size-16"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endif


                            <li class="checkout-item">
                                <div class="avatar checkout-icon p-1">
                                    <div class="avatar-title rounded-circle bg-primary">
                                        <i class="bx bxs-wallet text-white font-size-20"></i>
                                    </div>
                                </div>
                                <div class="feed-item-list">
                                    <div>
                                        <h5 class="font-size-16 mb-1">Payment Info</h5>
                                        <p class="text-muted text-truncate mb-4">Duis arcu tortor, suscipit eget</p>
                                    </div>
                                    <div>
                                        <h5 class="font-size-14 mb-3">Payment method :</h5>
                                        <div class="row">

                                            <div class="col-lg-3 col-sm-6">
                                                <div data-bs-toggle="collapse">
                                                    <label class="card-radio-label">
                                                        <input type="radio" name="pay-method" id="pay-methodoption1" class="card-radio-input">
                                                        <span class="card-radio py-3 text-center text-truncate">
                                                            <i class="bx bx-credit-card d-block h2 mb-3"></i>
                                                            Credit / Debit Card
                                                        </span>
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="col-lg-3 col-sm-6">
                                                <div data-bs-toggle="collapse">
                                                    <label class="card-radio-label">
                                                        <input type="radio" name="pay-method" id="pay-methodoption1" class="card-radio-input">
                                                        <span class="card-radio py-3 text-center text-truncate">
                                                            <i class="bx bx-credit-card d-block h2 mb-3"></i>
                                                            Credit / Debit Card
                                                        </span>
                                                    </label>
                                                </div>
                                            </div>


                                            <div class="col-lg-3 col-sm-6">
                                                <div data-bs-toggle="collapse">
                                                    <label class="card-radio-label">
                                                        <input type="radio" name="pay-method" id="pay-methodoption1" class="card-radio-input">
                                                        <span class="card-radio py-3 text-center text-truncate">
                                                            <i class="bx bx-credit-card d-block h2 mb-3"></i>
                                                            Credit / Debit Card
                                                        </span>
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="col-lg-3 col-sm-6">
                                                <div>
                                                    <label class="card-radio-label">
                                                        <input type="radio" name="pay-method" id="pay-methodoption2" class="card-radio-input">
                                                        <span class="card-radio py-3 text-center text-truncate">
                                                            <i class="bx bxl-paypal d-block h2 mb-3"></i>
                                                            Paypal
                                                        </span>
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="col-lg-3 col-sm-6">
                                                <div>
                                                    <label class="card-radio-label">
                                                        <input type="radio" name="pay-method" id="pay-methodoption3" class="card-radio-input" checked="">

                                                        <span class="card-radio py-3 text-center text-truncate">
                                                            <i class="bx bx-money d-block h2 mb-3"></i>
                                                            <span>Cash on Delivery</span>
                                                        </span>
                                                    </label>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ol>
                    </div>
                </div>

                <div class="row my-4">
                    <div class="col">
                        <a href="ecommerce-products.html" class="btn btn-link text-muted">
                            <i class="mdi mdi-arrow-left me-1"></i> @autotranslate('Continue Shopping ', app()->getLocale())</a>
                    </div> <!-- end col -->
                    <div class="col">
                        <div class="text-end mt-2 mt-sm-0">
                            <a href="#" class="btn btn-success">
                                <i class="mdi mdi-cart-outline me-1"></i>@autotranslate('Procced', app()->getLocale())  </a>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row-->
            </div>


            <div class="col-xl-4">
                <div class="card checkout-order-summary">
                    <div class="card-body">
                        <div class="p-3 bg-light mb-3">
                            <h5 class="font-size-16 mb-0">@autotranslate('Order Summary', app()->getLocale()) <span class="float-end ms-2">#MN0124</span></h5>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-centered mb-0 table-nowrap">
                                <thead>
                                    <tr>
                                        <th class="border-top-0" style="width: 110px;" scope="col">@autotranslate('Product', app()->getLocale())</th>
                                        <th class="border-top-0" scope="col">Product Desc</th>
                                        <th class="border-top-0" scope="col">Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($content && $content->count() > 0)
                                        @foreach ($content as $id => $item)
                                            <tr>
                                                <td>
                                                    @if ($item->get('image'))
                                                        <img src="{{ $item->get('image') }}" alt="product-img" title="product-img" class="avatar-lg rounded">
                                                    @else
                                                        <div class="avatar-placeholder"></div>
                                                    @endif
                                                </td>
                                                <td>
                                                    <h5 class="font-size-16 text-truncate">
                                                        <a href="#" class="text-dark">{{ $item->get('name') }} {{ $item->get('size') }}</a>
                                                    </h5>
                                                    <p class="text-muted mb-0 mt-1">{{ number_format($item->get('price'), 2) }} € x {{ $item->get('quantity') }}</p>
                                                </td>
                                                <td class="price-cell">{{ number_format($item->get('price') * $item->get('quantity'), 2) }} €</td>
                                            </tr>

                                            @if ($item->get('options'))
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
                                                    <tr class="highlighted-row">
                                                        <td colspan="2">
                                                            <span class="text-muted">{{ $count }} x {{ $toppingName }}</span>
                                                        </td>
                                                        <td class="price-cell">{{ number_format($toppingPrices[$toppingName], 2) }} €</td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="3">
                                                <p class="text-3xl text-center mb-2">@autotranslate('cart is empty', app()->getLocale())</p>
                                            </td>
                                        </tr>
                                    @endif

                                    <!-- Additional Rows for Totals -->
                                    <tr>
                                        <td colspan="2">
                                            <h5 class="font-size-14 m-0">Sub Total :</h5>
                                        </td>
                                        <td class="price-cell">$ 780</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <h5 class="font-size-14 m-0">@autotranslate('Discount', app()->getLocale()) :</h5>
                                        </td>
                                        <td class="price-cell">- $ 78</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <h5 class="font-size-14 m-0">Shipping Charge :</h5>
                                        </td>
                                        <td class="price-cell">$ 25</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <h5 class="font-size-14 m-0">Estimated Tax :</h5>
                                        </td>
                                        <td class="price-cell">$ 18.20</td>
                                    </tr>
                                    <tr class="bg-light">
                                        <td colspan="2">
                                            <h5 class="font-size-14 m-0">Total:</h5>
                                        </td>
                                        <td class="price-cell">$ 745.2</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>







        </div>
        <!-- end row -->

    </div>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.3.45/css/materialdesignicons.css" integrity="sha256-NAxhqDvtY0l4xn+YVa6WjAcmd94NNfttjNsDmNatFVc=" crossorigin="anonymous" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>


<style>

.card {
    margin-bottom: 24px;
    -webkit-box-shadow: 0 2px 3px #e4e8f0;
    box-shadow: 0 2px 3px #e4e8f0;
}
.card {
    position: relative;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
    -ms-flex-direction: column;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 1px solid #eff0f2;
    border-radius: 1rem;
}
.activity-checkout {
    list-style: none
}

.activity-checkout .checkout-icon {
    position: absolute;
    top: -4px;
    left: -24px
}

.activity-checkout .checkout-item {
    position: relative;
    padding-bottom: 24px;
    padding-left: 35px;
    border-left: 2px solid #f5f6f8
}

.activity-checkout .checkout-item:first-child {
    border-color: #3b76e1
}

.activity-checkout .checkout-item:first-child:after {
    background-color: #3b76e1
}

.activity-checkout .checkout-item:last-child {
    border-color: transparent
}

.activity-checkout .checkout-item.crypto-activity {
    margin-left: 50px
}

.activity-checkout .checkout-item .crypto-date {
    position: absolute;
    top: 3px;
    left: -65px
}



.avatar-xs {
    height: 1rem;
    width: 1rem
}

.avatar-sm {
    height: 2rem;
    width: 2rem
}

.avatar {
    height: 3rem;
    width: 3rem
}

.avatar-md {
    height: 4rem;
    width: 4rem
}

.avatar-lg {
    height: 5rem;
    width: 5rem
}

.avatar-xl {
    height: 6rem;
    width: 6rem
}

.avatar-title {
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    background-color: #3b76e1;
    color: #fff;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    font-weight: 500;
    height: 100%;
    -webkit-box-pack: center;
    -ms-flex-pack: center;
    justify-content: center;
    width: 100%
}

.avatar-group {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    padding-left: 8px
}

.avatar-group .avatar-group-item {
    margin-left: -8px;
    border: 2px solid #fff;
    border-radius: 50%;
    -webkit-transition: all .2s;
    transition: all .2s
}

.avatar-group .avatar-group-item:hover {
    position: relative;
    -webkit-transform: translateY(-2px);
    transform: translateY(-2px)
}

.card-radio {
    background-color: #fff;
    border: 2px solid #eff0f2;
    border-radius: .75rem;
    padding: .5rem;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    display: block
}

.card-radio:hover {
    cursor: pointer
}

.card-radio-label {
    display: block
}

.edit-btn {
    width: 35px;
    height: 35px;
    line-height: 40px;
    text-align: center;
    position: absolute;
    right: 25px;
    margin-top: -50px
}

.card-radio-input {
    display: none
}

.card-radio-input:checked+.card-radio {
    border-color: #3b76e1!important
}


.font-size-16 {
    font-size: 16px!important;
}
.text-truncate {
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

a {
    text-decoration: none!important;
}


.form-control {
    display: block;
    width: 100%;
    padding: 0.47rem 0.75rem;
    font-size: .875rem;
    font-weight: 400;
    line-height: 1.5;
    color: #545965;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #e2e5e8;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    border-radius: 0.75rem;
    -webkit-transition: border-color .15s ease-in-out,-webkit-box-shadow .15s ease-in-out;
    transition: border-color .15s ease-in-out,-webkit-box-shadow .15s ease-in-out;
    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out,-webkit-box-shadow .15s ease-in-out;
}

.edit-btn {
    width: 35px;
    height: 35px;
    line-height: 40px;
    text-align: center;
    position: absolute;
    right: 25px;
    margin-top: -50px;
}

.ribbon {
    position: absolute;
    right: -26px;
    top: 20px;
    -webkit-transform: rotate(45deg);
    transform: rotate(45deg);
    color: #fff;
    font-size: 13px;
    font-weight: 500;
    padding: 1px 22px;
    font-size: 13px;
    font-weight: 500
}

/* Platzhalter für fehlende Bilder */
.avatar-placeholder {
    width: 100%;
    height: 100%;
    background-color: #f0f0f0; /* Farbe für Platzhalter */
    border: 1px solid #e2e5e8; /* Optional, um das Layout zu verbessern */
    display: flex;
    justify-content: center;
    align-items: center;
}

/* Wenn Bild nicht vorhanden ist, Bildzelle nur Platzhalter ohne Bild */
.image-cell.placeholder {
    text-align: center; /* Zentriert den Platzhalter */
    padding: 0; /* Entfernt zusätzliche Abstände */
}


.highlighted-row {
        background-color: #f8f9fa; /* Heller Hintergrund für Hervorhebung */
        color: #333; /* Dunkle Textfarbe für bessere Lesbarkeit */
        text-align: end; /* Text rechtsbündig ausrichten */
    }
    .price-cell {
        width: 180px; /* Breite der Preis-Spalte */
        text-align: left; /* Text nach links verschieben */
    }



/* Card Styling */
.card {
    border-radius: 10px;
    border: 1px solid #ddd;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.card-body {
    padding: 20px;
    background-color: #fff;
}

/* Table Header Styling */
.table thead th {
    background-color: #f8f9fa;
    color: #333;
    font-weight: bold;
}

/* Table Row Styling */
.table tbody tr {
    border-bottom: 1px solid #ddd;
}

.table tbody tr:nth-child(even) {
    background-color: #f9f9f9;
}

.table tbody tr.highlighted-row {
    background-color: #e9ffe9;
}

/* Product Image */
.avatar-lg {
    width: 80px;
    height: 80px;
    object-fit: cover;
}

/* Price Cell */
.price-cell {
    font-weight: bold;
    color: #333;
}

/* Hover Effects */
.table tbody tr:hover {
    background-color: #e9ecef;
    cursor: pointer;
}




</style>










    <div class="container margin_60_20">
        <form wire:submit.prevent="orderNowForm">

            <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-8">
                    <div class="box_order_form">
                        <div class="head">
                            <div class="title">
                                <h3>@autotranslate('Personal Details -  Ihre Bestellung', app()->getLocale())</h3>
                            </div>
                        </div>
                        {{-- /head --}}
                        <div class="main">

                            <div class="row opt_order">
                                <div class="col-3">
                                    <label class="container_radio">@autotranslate('Familie', app()->getLocale())
                                        <input type="radio" wire:model.change="selectedOption" value="familie">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="col-3">
                                    <label class="container_radio">@autotranslate('Woman', app()->getLocale())
                                        <input type="radio" wire:model.change="selectedOption" value="frau" checked>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="col-3">
                                    <label class="container_radio">@autotranslate('Mister', app()->getLocale())
                                        <input type="radio" wire:model.change="selectedOption" value="herr">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="col-3">
                                    <label class="container_radio">@autotranslate('Firma', app()->getLocale())
                                        <input type="radio" wire:model.change="selectedOption" value="firma">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                @error('selectedOption')
                                <span
                                    class="text-danger">{{ app(\App\Services\AutoTranslationService::class)->trans($message, app()->getLocale()) }}</span>
                            @enderror
                            </div>

                            @if ($selectedOption === 'firma')
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Firma</label>
                                            <input wire:model="company" name="company" class="form-control"
                                                placeholder="Firma">
                                        </div>
                                        @error('company')
                                        <span
                                            class="text-danger">{{ app(\App\Services\AutoTranslationService::class)->trans($message, app()->getLocale()) }}</span>
                                    @enderror
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Abteilung</label>
                                            <input wire:model="department" class="form-control" placeholder="Abteilung"
                                                value="department">
                                        </div>
                                        @error('department')
                                        <span
                                            class="text-danger">{{ app(\App\Services\AutoTranslationService::class)->trans($message, app()->getLocale()) }}</span>
                                    @enderror
                                    </div>
                                    <hr>
                                </div>
                            @else
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <input wire:model="last_name" class="form-control"
                                                placeholder="@autotranslate('Last Name*', app()->getLocale())">
                                            @error('last_name')
                                                <span
                                                    class="text-danger">{{ app(\App\Services\AutoTranslationService::class)->trans($message, app()->getLocale()) }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">

                                            <input wire:model="first_name" class="form-control"
                                                placeholder="@autotranslate('First Name*', app()->getLocale())">
                                            @error('first_name')
                                                <span
                                                    class="text-danger">{{ app(\App\Services\AutoTranslationService::class)->trans($message, app()->getLocale()) }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            @endif


                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input wire:model="email" class="form-control" placeholder="@autotranslate('Email Address*', app()->getLocale())">
                                        @error('email')
                                            <span
                                                class="text-danger">{{ app(\App\Services\AutoTranslationService::class)->trans($message, app()->getLocale()) }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input wire:model="phone" class="form-control" placeholder="@autotranslate('Phone*', app()->getLocale())">
                                        @error('phone')
                                            <span
                                                class="text-danger">{{ app(\App\Services\AutoTranslationService::class)->trans($message, app()->getLocale()) }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <textarea wire:model="order_comment" class="form-control" style="height: 80px;" placeholder="@autotranslate('Order Comment', app()->getLocale())"
                                        id="order_comment" name="order_comment"></textarea>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <input wire:model="shipping_street" class="form-control"
                                            placeholder="@autotranslate('Street*', app()->getLocale())">
                                        @error('shipping_street')
                                            <span
                                                class="text-danger">{{ app(\App\Services\AutoTranslationService::class)->trans($message, app()->getLocale()) }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input wire:model="shipping_house_no" class="form-control"
                                            placeholder="@autotranslate('House number*', app()->getLocale())">
                                        @error('shipping_house_no')
                                            <span
                                                class="text-danger">{{ app(\App\Services\AutoTranslationService::class)->trans($message, app()->getLocale()) }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input wire:model="postal_code" class="form-control"
                                            placeholder="@autotranslate('Postal Code*', app()->getLocale())">
                                        @error('postal_code')
                                            <span
                                                class="text-danger">{{ app(\App\Services\AutoTranslationService::class)->trans($message, app()->getLocale()) }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <input wire:model="city" class="form-control"
                                            placeholder="@autotranslate('City*', app()->getLocale())">
                                        @error('city')
                                            <span
                                                class="text-danger">{{ app(\App\Services\AutoTranslationService::class)->trans($message, app()->getLocale()) }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <textarea wire:model="description_of_way" class="form-control" style="height: 80px;"
                                        placeholder="@autotranslate('Shipping Comment', app()->getLocale())" id="shipping_comment" name="order_comment"></textarea>
                                </div>
                            </div>


                            <div class="row opt_order_news">
                                <div class="col-12">
                                    <label class="container_radio">@autotranslate('Yes, I would like to occasionally receive news and coupons.', app()->getLocale())
                                        <input wire:model="opt_news_coupons" type="checkbox" value="1">
                                        <span class="checkmark"></span>
                                    </label>
                                    @error('opt_news_coupons')
                                        <span
                                            class="text-danger">{{ app(\App\Services\AutoTranslationService::class)->trans($message, app()->getLocale()) }}</span>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label class="container_radio">@autotranslate('Save my data for the next visit.', app()->getLocale())
                                        <input wire:model="opt_save_data" type="checkbox" value="1">
                                        <span class="checkmark"></span>
                                    </label>
                                    @error('opt_save_data')
                                        <span
                                            class="text-danger">{{ app(\App\Services\AutoTranslationService::class)->trans($message, app()->getLocale()) }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /box_order_form -->

                    @if(session('error'))
                    <div class="alert alert-danger">
                        {{ app(\App\Services\AutoTranslationService::class)->trans(session('error'), app()->getLocale()) }}
                    </div>
                    @endif

                    <div class="box_order_form">
                        <div class="head">
                            <div class="title">
                                <h3>@autotranslate('Payment methods', app()->getLocale())</h3>
                            </div>
                        </div>
                        <!-- /head -->
                        <div class="main">

                            <div class="row opt_order">
                                <div class="col-6">
                                    <label class="container_radio">@autotranslate('Delivery', app()->getLocale())
                                        <input type="radio" value="option1" name="opt_order" checked>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="col-6">
                                    <label class="container_radio">@autotranslate('Pick up', app()->getLocale())
                                        <input type="radio" value="option1" name="opt_order">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>

                            <div class="dropdown day">
                                <a href="#" data-bs-toggle="dropdown">Day <span id="selected_day"></span></a>
                                <div class="dropdown-menu">
                                    <div class="dropdown-menu-content">
                                        <h4>Which day delivered?</h4>
                                        <div class="radio_select chose_day">
                                            <ul>
                                                <li>
                                                    <input type="radio" id="day_1" name="day"
                                                        value="Today">
                                                    <label for="day_1">Today<em>-40%</em></label>
                                                </li>
                                                <li>
                                                    <input type="radio" id="day_2" name="day"
                                                        value="Tomorrow">
                                                    <label for="day_2">Tomorrow<em>-40%</em></label>
                                                </li>
                                            </ul>
                                        </div>
                                        <!-- /people_select -->
                                    </div>
                                </div>
                            </div>




                            <!-- /dropdown -->
                            <div class="dropdown time">
                                <a href="#" data-bs-toggle="dropdown">Time <span id="selected_time"></span></a>
                                <div class="dropdown-menu">
                                    <div class="dropdown-menu-content">
                                        <h4>Lunch</h4>
                                        <div class="radio_select add_bottom_15">
                                            <ul>
                                                <li>
                                                    <input type="radio" id="time_1" name="time"
                                                        value="12.00am">
                                                    <label for="time_1">12.00<em>-40%</em></label>
                                                </li>
                                                <li>
                                                    <input type="radio" id="time_2" name="time"
                                                        value="08.30pm">
                                                    <label for="time_2">12.30<em>-40%</em></label>
                                                </li>
                                                <li>
                                                    <input type="radio" id="time_3" name="time"
                                                        value="09.00pm">
                                                    <label for="time_3">1.00<em>-40%</em></label>
                                                </li>
                                                <li>
                                                    <input type="radio" id="time_4" name="time"
                                                        value="09.30pm">
                                                    <label for="time_4">1.30<em>-40%</em></label>
                                                </li>
                                            </ul>
                                        </div>
                                        <!-- /time_select -->
                                        <h4>Dinner</h4>
                                        <div class="radio_select">
                                            <ul>
                                                <li>
                                                    <input type="radio" id="time_5" name="time"
                                                        value="08.00pm">
                                                    <label for="time_1">20.00<em>-40%</em></label>
                                                </li>
                                                <li>
                                                    <input type="radio" id="time_6" name="time"
                                                        value="08.30pm">
                                                    <label for="time_2">20.30<em>-40%</em></label>
                                                </li>
                                                <li>
                                                    <input type="radio" id="time_7" name="time"
                                                        value="09.00pm">
                                                    <label for="time_3">21.00<em>-40%</em></label>
                                                </li>
                                                <li>
                                                    <input type="radio" id="time_8" name="time"
                                                        value="09.30pm">
                                                    <label for="time_4">21.30<em>-40%</em></label>
                                                </li>
                                            </ul>
                                        </div>
                                        <!-- /time_select -->
                                    </div>
                                </div>
                            </div>
                            <!-- /dropdown -->



                        </div>
                    </div>
                    <!-- /box_order_form -->

                    <div class="box_order_form">
                        <div class="head">
                            <div class="title">
                                <h3>@autotranslate('Payment methods', app()->getLocale())</h3>
                            </div>
                        </div>
                        <!-- /head -->
                        <div class="main">
                            <div class="payment_select">
                                <label class="container_radio">@autotranslate('Cash payment', app()->getLocale())
                                    <input wire:model="payment_method" type="radio" value="cash" checked
                                        name="payment_method">
                                    <span class="checkmark"></span>
                                </label>
                                <i class="icon_wallet"></i>
                            </div>
                            <!--End row -->
                            <div class="payment_select" id="paypal">
                                <label class="container_radio">@autotranslate('Pay with Paypal', app()->getLocale())
                                    <input wire:model="payment_method" type="radio" value="paypal"
                                        name="payment_method">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="payment_select">
                                <label class="container_radio">@autotranslate('EC Card', app()->getLocale())
                                    <input wire:model="payment_method" type="radio" value="ec-card"
                                        name="payment_method">
                                    <span class="checkmark"></span>
                                </label>
                                <i class="icon_creditcard"></i>
                            </div>


                            <div class="payment_select">
                                <label class="container_radio">
                                    @autotranslate('Credit Card', app()->getLocale())
                                    <input wire:model="payment_method" type="radio" value="stripe" name="payment_method">
                                    <span class="checkmark"></span>
                                </label>

                                <div>
                                    <!-- Dein HTML-Formular -->
                                    <form id="payment-form">
                                        <div id="card-element" class="form-control" >
                                            <!-- Stripe Element wird hier eingebunden -->
                                        </div>
                                        <div id="card-errors" role="alert"></div>
                                        <button type="submit">Jetzt bestellen</button>
                                    </form>
                                </div>

                                <div id="card-errors" role="alert"></div>
                            </div>
                            <!--End row -->
                        </div>
                    </div>
                    <!-- /box_order_form -->
                </div>
                <!-- /col -->
                <div class="col-xl-4 col-lg-4" id="sidebar_fixed">
                    <div class="box_order">
                        <div class="head">
                            <h3>@autotranslate('Order Summary', app()->getLocale())</h3>
                            <div>{{ $shopData->title }}</div>
                        </div>
                        <!-- /head -->
                        <div class="main">
                            <ul>
                                <li>Date<span>Today 23/11/2019</span></li>
                                <li>Hour<span>08.30pm</span></li>
                                <li>Type<span>Delivery</span></li>
                                <li>Type<span>Delivery</span></li>
                            </ul>
                            <hr>
                            <livewire:frontend.card.cart-component />
                            <livewire:frontend.cart.tip-component />
                            <livewire:frontend.cart.timepicker-component :shopId="$this->shopData" />
                            <livewire:frontend.cart.order-button-component :restaurantId="$this->shopData->id" />




 <!-- Submit Button -->
 <button id="submit-button" type="submit">@autotranslate('Place Order', app()->getLocale())</button>

                            <div class="text-center"><small>@autotranslate('Or Call Us at', app()->getLocale())
                                    <strong>{{ $shopData->phone }}</strong></small></div>
                        </div>
                    </div>
                    <!-- /box_booking -->
                </div>

            </div>
            <!-- /row -->
        </form>
    </div>
    <!-- /container -->






</div>








    @push('head-script')

    @endpush






@once
    @push('styles')
    @endpush

    @push('head_scripts')


    @endpush
    @endonce
