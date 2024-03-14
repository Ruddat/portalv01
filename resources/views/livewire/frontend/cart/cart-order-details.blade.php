<div>
    {{-- Stop trying to control. --}}

    <div class="container margin_60_20">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-8">
                <div class="box_order_form">
                    <div class="head">
                        <div class="title">
                            <h3>{{ app(\App\Services\TranslationService::class)->trans('Personal Details -  Ihre Bestellung', app()->getLocale()) }}</h3>
                        </div>
                    </div>
                    <!-- /head -->
                    <div class="main">

                        <div class="row opt_order">
                            <div class="col-3">
                                <label class="container_radio">Frau
                                    <input type="radio" value="option1" name="opt_order" checked="">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="col-3">
                                <label class="container_radio">Herr
                                    <input type="radio" value="option1" name="opt_order">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="col-3">
                                <label class="container_radio">Divers
                                    <input type="radio" value="option1" name="opt_order">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="col-3">
                                <label class="container_radio">Firma
                                    <input type="radio" value="option1" name="opt_order">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                            <div class="form-group">
                            <label>Company</label>
                            <input class="form-control" placeholder="First and Last Name">
                            </div>
                        </div>
                        <div class="col-6">
                        <div class="form-group">
                            <label>Abteilung</label>
                            <input class="form-control" placeholder="First and Last Name">
                            </div>
                        </div>
                        <hr>
                        </div>



                        <div class="row">
                            <div class="col-6">
                            <div class="form-group">
                            <label>Last Name</label>
                            <input class="form-control" placeholder="First and Last Name">
                            </div>
                        </div>
                        <div class="col-6">
                        <div class="form-group">
                            <label>First Name</label>
                            <input class="form-control" placeholder="First and Last Name">
                            </div>
                        </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email Address</label>
                                    <input class="form-control" placeholder="Email Address">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input class="form-control" placeholder="Phone">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                            <textarea class="form-control" style="height: 120px;" placeholder="Order Comment" id="order_comment" name="order_comment"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Full Address</label>
                            <input class="form-control" placeholder="Full Address">
                        </div>
                        <div class="row">
                            <div class="col-md-9">
                                <div class="form-group">
                                    <label>City</label>
                                    <input class="form-control" placeholder="City">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Postal Code</label>
                                    <input class="form-control" placeholder="0123">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                            <textarea class="form-control" style="height: 120px;" placeholder="Shipping Comment" id="shipping_comment" name="order_comment"></textarea>
                            </div>
                        </div>


                        <div class="row opt_order">
                            <div class="col-12">
                                <label class="container_radio">Ja, ich möchte gelegentlich Neuigkeiten und Coupons erfahren.
                                    <input type="checkbox" value="option1" name="opt_news_coupons" checked="">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="col-12">
                                <label class="container_radio">Meine Daten für den nächsten Besuch speichern.
                                    <input type="checkbox" value="option1" name="opt_save_data" checked="">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /box_order_form -->
                <div class="box_order_form">
                    <div class="head">
                        <div class="title">
                            <h3>{{ app(\App\Services\TranslationService::class)->trans('Zahlungsarten', app()->getLocale()) }}</h3>
                        </div>
                    </div>
                    <!-- /head -->
                    <div class="main">
                        <div class="payment_select">
                            <label class="container_radio">Pay with Cash
                                <input type="radio" value="" checked name="payment_method">
                                <span class="checkmark"></span>
                            </label>
                            <i class="icon_wallet"></i>
                        </div>


                        <!--End row -->
                        <div class="payment_select" id="paypal">
                            <label class="container_radio">Pay with Paypal
                                <input type="radio" value="" name="payment_method">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <div class="payment_select">
                            <label class="container_radio">EC Card
                                <input type="radio" value="" name="payment_method">
                                <span class="checkmark"></span>
                            </label>
                            <i class="icon_creditcard"></i>
                        </div>
                    </div>
                </div>
                <!-- /box_order_form -->
            </div>
            <!-- /col -->
            <div class="col-xl-4 col-lg-4" id="sidebar_fixed">
                <div class="box_order">
                    <div class="head">
                        <h3>{{ app(\App\Services\TranslationService::class)->trans('Order Summary', app()->getLocale()) }}</h3>
                        <div>{{ $shopData->title }}</div>
                    </div>
                    <!-- /head -->
                    <div class="main">
                        <ul>
                            <li>Date<span>Today 23/11/2019</span></li>
                            <li>Hour<span>08.30pm</span></li>
                            <li>Type<span>Delivery</span></li>
                        </ul>
                        <hr>
                        <livewire:frontend.card.cart-component />


                        <a href="confirm.html" class="btn_1 gradient full-width mb_5">{{ app(\App\Services\TranslationService::class)->trans('Order Now', app()->getLocale()) }}</a>
                        <div class="text-center"><small>{{ app(\App\Services\TranslationService::class)->trans('Or Call Us at', app()->getLocale()) }} <strong>{{ $shopData->phone }}</strong></small></div>
                    </div>
                </div>
                <!-- /box_booking -->
            </div>

        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
