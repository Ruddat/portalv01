@extends('frontend.layouts.default-shop-index')
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
                                <h3>@autotranslate('Warenkorb', app()->getLocale())
                                </h3>
                                <a href="#0" class="close_panel_mobile"><i class="icon_close"></i></a>

                            </div>
                            <!-- /head -->
                            <div class="main">




                                <livewire:frontend.card.cart-component />
                                <livewire:frontend.cart.tip-component />
                                <livewire:frontend.cart.timepicker-component :shopId="$restaurant" />
                                <livewire:frontend.cart.order-button-component :restaurantId="$restaurant->id" />
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

<style>




/* new Card */



    /* Desktop */
.secondary_nav {
    display: flex;
}

#secondary_nav {
    display: flex;
    flex-wrap: wrap;
    list-style: none;
    padding: 0;
}

#secondary_nav li {
    margin-right: 20px;
}

/* Mobile */
@media (max-width: 768px) {
    .secondary_nav {
        position: relative;
    }

    #secondary_nav {
        display: none;
        flex-direction: column;
        background: #fff;
        position: absolute;
        top: 100%;
        left: 0;
        width: 100%;
        z-index: 1000;
    }

    #secondary_nav.show {
        display: flex;
    }

    #secondary_nav li {
        margin: 10px 0;
    }

    .hamburger {
        display: block;
        cursor: pointer;
    }
}

.secondary_nav {
    --bg-color: #f8f9fa;
    --active-color: #007bff;
    background-color: var(--bg-color);
}

#secondary_nav li a {
    text-decoration: none;
    color: #333;
    padding: 10px 15px;
    display: block;
}

#secondary_nav li a.active {
    color: var(--active-color);
    border-bottom: 2px solid var(--active-color);
}


</style>


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

