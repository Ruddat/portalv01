<div>
    {{-- Stop trying to control. --}}

    <div class="container margin_60_20">
        <form wire:submit.prevent="orderNowForm">

        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-8">
                <div class="box_order_form">
                    <div class="head">
                        <div class="title">
                            <h3>{{ app(\App\Services\TranslationService::class)->trans('Personal Details -  Ihre Bestellung', app()->getLocale()) }}</h3>
                        </div>
                    </div>
                    {{-- /head --}}
                    <div class="main">

                        <div class="row opt_order">
                            <div class="col-2">
                                <label class="container_radio">Familie
                                    <input type="radio" wire:model.change="selectedOption" value="familie">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="col-2">
                                <label class="container_radio">Frau
                                    <input type="radio" wire:model.change="selectedOption" value="frau" checked>
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="col-2">
                                <label class="container_radio">Herr
                                    <input type="radio" wire:model.change="selectedOption" value="herr">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="col-2">
                                <label class="container_radio">Divers
                                    <input type="radio" wire:model.change="selectedOption" value="Divers">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="col-2">
                                <label class="container_radio">Firma
                                    <input type="radio" wire:model.change="selectedOption" value="firma">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div>

                        @if($selectedOption === 'firma')
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Firma</label>
                                    <input wire:model="company" name="company" class="form-control" placeholder="Firma">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Abteilung</label>
                                    <input wire:model="department" class="form-control" placeholder="Abteilung" value="department">
                                </div>
                            </div>
                            <hr>
                        </div>
                    @else
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Last Name</label>
                                    <input wire:model="last_name" class="form-control" placeholder="Last Name">
                                    @error('last_name') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>First Name</label>
                                    <input wire:model="first_name" class="form-control" placeholder="First Name">
                                    @error('first_name') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                    @endif


                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{ app(\App\Services\TranslationService::class)->trans('Email Address', app()->getLocale()) }}</label>
                                    <input wire:model="email" class="form-control" placeholder="Email Address">
                                    @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input wire:model="phone" class="form-control" placeholder="Phone">
                                    @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <textarea  wire:model="order_comment" class="form-control" style="height: 80px;" placeholder="Order Comment" id="order_comment" name="order_comment"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Full Address</label>
                            <input wire:model="full_address" class="form-control" placeholder="Full Address">
                            @error('full_address') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Postal Code</label>
                                    <input wire:model="postal_code" class="form-control" placeholder="0123">
                                    @error('postal_code') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <label>City</label>
                                    <input wire:model="city" class="form-control" placeholder="City">
                                    @error('city') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <textarea wire:model="description_of_way" class="form-control" style="height: 80px;" placeholder="Shipping Comment" id="shipping_comment" name="order_comment"></textarea>
                            </div>
                        </div>


                        <div class="row opt_order_news">
                            <div class="col-12">
                                <label class="container_radio">Ja, ich möchte gelegentlich Neuigkeiten und Coupons erfahren.
                                    <input wire:model="opt_news_coupons" type="checkbox" value="1">
                                    <span class="checkmark"></span>
                                </label>
                                @error('opt_news_coupons') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-12">
                                <label class="container_radio">Meine Daten für den nächsten Besuch speichern.
                                    <input wire:model="opt_save_data" type="checkbox" value="1">
                                    <span class="checkmark"></span>
                                </label>
                                @error('opt_save_data') <span class="text-danger">{{ $message }}</span> @enderror
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

                        <div class="row opt_order">
                            <div class="col-6">
                                <label class="container_radio">{{ app(\App\Services\TranslationService::class)->trans('Delivery', app()->getLocale()) }}
                                    <input type="radio" value="option1" name="opt_order" checked>
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="col-6">
                                <label class="container_radio">{{ app(\App\Services\TranslationService::class)->trans('Selbstabholen', app()->getLocale()) }}
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
                                                <input type="radio" id="day_1" name="day" value="Today">
                                                <label for="day_1">Today<em>-40%</em></label>
                                            </li>
                                            <li>
                                                <input type="radio" id="day_2" name="day" value="Tomorrow">
                                                <label for="day_2">Tomorrow<em>-40%</em></label>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- /people_select -->
                                </div>
                            </div>
                        </div>


                        @props(['options' => "{dateFormat:'Y-m-d H:i', altFormat:'F j, Y H:i', altInput:true, enableTime: true, time_24hr: true }"])

                        <div wire:ignore>
                            <input
                                x-data
                                x-init="flatpickr($refs.input, {{ $options }} );"
                                x-ref="input"
                                type="text"
                                data-input
                                {{ $attributes->merge(['class' => 'block w-full disabled:bg-gray-200 p-2 border border-gray-300 rounded-md focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 sm:text-sm sm:leading-5']) }}
                            />
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
		                                                <input type="radio" id="time_1" name="time" value="12.00am">
		                                                <label for="time_1">12.00<em>-40%</em></label>
		                                            </li>
		                                            <li>
		                                                <input type="radio" id="time_2" name="time" value="08.30pm">
		                                                <label for="time_2">12.30<em>-40%</em></label>
		                                            </li>
		                                            <li>
		                                                <input type="radio" id="time_3" name="time" value="09.00pm">
		                                                <label for="time_3">1.00<em>-40%</em></label>
		                                            </li>
		                                            <li>
		                                                <input type="radio" id="time_4" name="time" value="09.30pm">
		                                                <label for="time_4">1.30<em>-40%</em></label>
		                                            </li>
		                                        </ul>
		                                    </div>
		                                    <!-- /time_select -->
		                                    <h4>Dinner</h4>
		                                    <div class="radio_select">
		                                        <ul>
		                                            <li>
		                                                <input type="radio" id="time_5" name="time" value="08.00pm">
		                                                <label for="time_1">20.00<em>-40%</em></label>
		                                            </li>
		                                            <li>
		                                                <input type="radio" id="time_6" name="time" value="08.30pm">
		                                                <label for="time_2">20.30<em>-40%</em></label>
		                                            </li>
		                                            <li>
		                                                <input type="radio" id="time_7" name="time" value="09.00pm">
		                                                <label for="time_3">21.00<em>-40%</em></label>
		                                            </li>
		                                            <li>
		                                                <input type="radio" id="time_8" name="time" value="09.30pm">
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
                            <h3>{{ app(\App\Services\TranslationService::class)->trans('Zahlungsarten', app()->getLocale()) }}</h3>
                        </div>
                    </div>
                    <!-- /head -->
                    <div class="main">
                        <div class="payment_select">
                            <label class="container_radio">Pay with Cash
                                <input wire:model="payment_method" type="radio" value="cash" checked name="payment_method">
                                <span class="checkmark"></span>
                            </label>
                            <i class="icon_wallet"></i>
                        </div>
                        <!--End row -->
                        <div class="payment_select" id="paypal">
                            <label class="container_radio">Pay with Paypal
                                <input wire:model="payment_method" type="radio" value="paypal" name="payment_method">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <div class="payment_select">
                            <label class="container_radio">EC Card
                                <input wire:model="payment_method" type="radio" value="ec-card" name="payment_method">
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

                        <button wire:loading.class="opacity-50" type="submit" class="btn_1 gradient full-width mb_5">{{ app(\App\Services\TranslationService::class)->trans('Order Now', app()->getLocale()) }}</button>
                        <div wire:loading>
                            Bestellung wird uebertragen......
                        </div>




                        <div class="text-center"><small>{{ app(\App\Services\TranslationService::class)->trans('Or Call Us at', app()->getLocale()) }} <strong>{{ $shopData->phone }}</strong></small></div>
                    </div>
                </div>
                <!-- /box_booking -->
            </div>

        </div>
        <!-- /row -->
        </form>
    </div>
    <!-- /container -->
    <div class="mt-4">
        <h4>Generiertes XML-Dokument:</h4>
        <pre>{{ $xml }}</pre>
    </div>





</div>




@once
@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endpush

@push('head_scripts')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
@endpush
@endonce



