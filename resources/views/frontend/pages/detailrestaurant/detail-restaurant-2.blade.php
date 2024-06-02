@extends('frontend.layouts.default')
@section('content')
    {{-- seitenabhengig css --}}
    @push('specific-css')
        <link href="{{ asset('frontend/css/detail-page.css') }}" rel="stylesheet">
    @endpush

    <body data-spy="scroll" data-bs-target="#secondary_nav" data-offset="75">

        @include('frontend.includes.header-in-clearfix')
        <div class="hero_in detail_page background-image"
            data-background="url({{ asset('frontend/img/hero_general_2.jpg') }})">
            <div class="wrapper opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.5)">
                <div class="container">
                    <div class="main_info">
                        <div class="row">
                            <div class="col-xl-4 col-lg-5 col-md-6">
                                <div class="head">
                                    <img src="{{ $restaurant->logo_url }}" alt="Restaurant Logo"
                                        style="max-width: 100px; border-radius: 10px;">

                                    <div class="neon-sign">
                                        <span class="open-text">Open</span>
                                    </div>

                                    @livewire('frontend.votings.rating-summary', ['shopId' => $restaurant->id])

                                </div>
                                <h1>{{ $restaurant->title }}</h1>
                                {{ $restaurant->street }} - {{ $restaurant->city }}, {{ $restaurant->zip }} - <a href="https://www.google.com/maps/dir/?api=1&destination={{ $restaurant->lat }},{{ $restaurant->lng }}" target="_blank">@autotranslate('Get directions to', app()->getLocale()) {{ $restaurant->title }}</a>


                            </div>


                            <div class="col-xl-8 col-lg-7 col-md-6 position-relative">
                                <div class="buttons clearfix">
                                    <span class="magnific-gallery">
                                        <a href="{{ asset('frontend/img/detail_1.jpg') }}" class="btn_hero"
                                            title="Photo title" data-effect="mfp-zoom-in"><i class="icon_image"></i>@autotranslate('Gallerie', app()->getLocale())</a>
                                        <a href="{{ asset('frontend/img/detail_2.jpg') }}" title="Photo title"
                                            data-effect="mfp-zoom-in"></a>
                                        <a href="{{ asset('frontend/img/detail_3.jpg') }}" title="Photo title"
                                            data-effect="mfp-zoom-in"></a>
                                    </span>
                                    <a href="#0" class="btn_hero wishlist" title="@autotranslate('Wishlist', app()->getLocale())">
                                        <i class="icon_heart"></i>
                                    </a>

                                    <!-- Info Link -->
                                    <a href="#0" class="btn_hero wishlist" data-toggle="tooltip" data-placement="top" title="@autotranslate('Shop Informationen', app()->getLocale())">
                                        <i class="icon_info"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- /row -->
                    </div>
                    <!-- /main_info -->
                </div>
            </div>
        </div>
        <!--/hero_in-->

        <nav class="secondary_nav sticky_horizontal">
            <div class="container">
                <ul id="secondary_nav">
                    @foreach ($categories as $category)
                        <li><a href="#section-{{ $category->id }}">{{ $category->category_name }}</a></li>
                    @endforeach
                    <li><a href="#section-999"><i class="icon_chat_alt"></i>@autotranslate('Reviews', app()->getLocale())</a></li>
                </ul>
            </div>
            <span></span>
        </nav>
        <!-- /secondary_nav -->

        <div class="bg_gray">
            <div class="container margin_detail">
                <div class="row">
                    <div class="col-lg-8 list_menu">

                        <livewire:frontend.product.index :restaurant="$restaurant" :categories="$categories" :sizesWithPrices="$sizesWithPrices"
                            :productsByCategory="$productsByCategory" />

                    </div>
                    <!-- /col -->

                    <div class="col-lg-4" id="sidebar_fixed">
                        <div class="box_order mobile_fixed">
                            <div class="head">
                                <h3>@autotranslate('Order Summary', app()->getLocale())
                                </h3>
                                <a href="#0" class="close_panel_mobile"><i class="icon_close"></i></a>

                            </div>
                            <!-- /head -->
                            <div class="main">
                                <livewire:frontend.card.cart-component />

                                <div class="row opt_order">
                                    <div class="col-6">
                                        <label
                                            class="container_radio">@autotranslate('Delivery', app()->getLocale())
                                            <input type="radio" value="option1" name="opt_order" checked>
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <div class="col-6">
                                        <label
                                            class="container_radio">@autotranslate('Selbstabholen', app()->getLocale())
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
                                <div class="btn_1_mobile">
                                    <a href="{{ route('order', ['restaurantId' => $restaurant->id]) }}"
                                        class="btn_1 gradient full-width mb_5">{{ app(\App\Services\TranslationService::class)->trans('Order Now', app()->getLocale()) }}</a>
                                    <div class="text-center">
                                        <small>@autotranslate('No money charged on this steps', app()->getLocale())</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /box_order -->
                        <div class="btn_reserve_fixed"><a href="#0"
                                class="btn_1 gradient full-width">{{ app(\App\Services\TranslationService::class)->trans('View Basket', app()->getLocale()) }}</a>
                        </div>
                    </div>


                </div>
                <!-- /row -->
            </div>
            <!-- /container -->
        </div>
        <!-- /bg_gray -->


        <div class="container margin_30_20">
            <div class="row">
                <div class="col-lg-8 list_menu">
                    <section id="section-5">
                        <h4>@autotranslate('Reviews', app()->getLocale())</h4>
                        @livewire('frontend.votings.rating-list', ['shopId' => $restaurant->id])
                    </section>
                    <!-- /section -->
                </div>
            </div>
        </div>
        <!-- /container -->

        <!-- Script zum Öffnen des Popups nach dem Laden der Seite -->
        <!-- Einbindung der Livewire-Komponente -->

        <livewire:frontend.storeinfos.store-popup :restaurant="$restaurant" :shopId="$restaurant->id"/>



        @push('specific-scripts')
            <!-- SPECIFIC SCRIPTS -->
            <script src="{{ asset('frontend/js/sticky_sidebar.min.js') }}"></script>
            <script src="{{ asset('frontend/js/sticky-kit.min.js') }}"></script>
            <script src="{{ asset('frontend/js/specific_detail.js') }}"></script>

         <script>
                document.addEventListener('livewire:load', function () {
                    Livewire.on('openPopup', function (status, storeName = null) {
                        $.fancybox.open({
                            src  : '#storePopup',
                            type : 'inline',
                            opts : {
                                afterClose: function () {
                                    Livewire.dispatch('closePopup');
                                }
                            }
                        });
                    });
                });
            </script>


        @endpush
    @endsection
    @if (isset($modalScript) && $modalScript)
        @push('specific-header')
            <link href="{{ asset('frontend/css/modal_popup.css') }}" rel="stylesheet">
        @endpush



        <div class="popup_wrapper">
            <div class="popup_content newsletter_c">
                <span class="popup_close"><i class="icon_close"></i></span>
                <div class="row g-0">
                    <div class="col-md-5 d-none d-md-flex align-items-center justify-content-center">
                        <figure><img src="{{ asset('frontend/img/newsletter_img.jpg') }}" alt=""></figure>
                    </div>
                    <div class="col-md-7">
                        <div class="content">
                            <div class="wrapper">
                                <img src="{{ asset('frontend/img/logo_sticky.svg') }}" width="162" height="35"
                                    alt="">
                                <h3>Entschuldigung, außerhalb des Liefergebiets</h3>
                                <p>Es tut uns leid, aber Ihre Adresse befindet sich außerhalb unseres Liefergebiets.
                                    Bitte überprüfen Sie Ihre Adresse oder kontaktieren Sie uns für weitere
                                    Informationen.</p>
                                <p>Falls Sie weitere Fragen haben, stehen wir Ihnen gerne zur Verfügung.</p>
                                <form action="#">
                                    <div class="form-group">
                                        <input type="email" class="form-control"
                                            placeholder="Enter your email address">
                                    </div>
                                    <button type="submit" class="btn_1 mt-2 mb-4">Subscribe</button>
                                </form>
                                <div class="row opt_order">
                                    <div class="col-6">
                                        <label class="container_radio">Delivery
                                            <input type="radio" value="option1" name="opt_order" checked="">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <div class="col-6">
                                        <label class="container_radio">Take away
                                            <input type="radio" value="option1" name="opt_order">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- row --}}
            </div>
        </div>




        @push('specific-scripts')





            <script>
                (function($) {
                    "use strict";

                    // Popup up
                    setTimeout(function() {
                        $('.popup_wrapper').css('opacity', '1');
                    }, 500); // Entrance delay

                    $('.popup_wrapper');
                    $('.popup_close').click(function() { // Class for the close button
                        $('.popup_wrapper').fadeOut(300); // Hide the CTA div
                    });



                })(window.jQuery);
            </script>




        @endpush
    @endif

    <style>
        .reviews #review_summary {
            text-align: center;
            background-color: #66cc66;
            color: #fff;
            padding: 20px 10px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s; /* Übergangseffekt für die Hintergrundfarbe */
        }

        /* Hover-Stil */
        .reviews #review_summary:hover {
            background-color: #4CAF50; /* Neue Hintergrundfarbe beim Hover */
        }
    </style>





        </div>
