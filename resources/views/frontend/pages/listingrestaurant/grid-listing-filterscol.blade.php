@extends('frontend.layouts.default')
@section('content')
    <!-- seitenabhengig css -->
    @push('specific-css')
        <link href="{{ asset('frontend/css/listing.css') }}" rel="stylesheet">
    @endpush

    <body>

        @include('frontend.includes.header-in-clearfix')


        <div class="page_header element_to_stick">
            <div class="container">
                <div class="row">
                    <div class="col-xl-8 col-lg-7 col-md-7 d-none d-md-block">
                        <h1> {{ $restaurants->total() }} @autotranslate('Restaurants in', app()->getLocale())
                            @php
                                $findCityName = Session::get('selectedName');
                                $words = explode(' ', $findCityName); // Den String in Wörter aufteilen
                                $firstTwoWords = implode(' ', array_slice($words, 0, 2)); // Die ersten beiden Wörter wieder zusammenfügen
                            @endphp


                            @if ($findCityName)
                                {{ rtrim($firstTwoWords, ',') }} <!-- rtrim-Funktion entfernt das Komma -->
                                @autotranslate('found!', app()->getLocale())
                            @else
                                Stadt oder Ortsname nicht verfügbar.
                            @endif
                        </h1>
                        <a href="/">@autotranslate('Change address', app()->getLocale())</a>
                        <!-- Im Header des Templates, wo die Stadt und der Ortsname angezeigt werden sollen -->

                    </div>
                    <div class="col-xl-4 col-lg-5 col-md-5">
                        <div class="search_bar_list">
                            <input type="text" class="form-control" placeholder="@autotranslate('Dishes, restaurants or cuisines', app()->getLocale())">
                            <button type="submit"><i class="icon_search"></i></button>
                        </div>
                    </div>
                </div>
                <!-- /row -->
            </div>
        </div>
        <!-- /page_header -->

        <div class="container margin_30_20">
            <div class="row">
                <aside class="col-lg-3" id="sidebar_fixed">
                    <form action="{{ route('search.index') }}" method="get">
                        <div class="type_delivery">
                            <ul class="clearfix">
                                <li>
                                    <label class="container_radio">@autotranslate('Delivery', app()->getLocale())
                                        <input type="radio" name="type_d" checked="checked">
                                        <span class="checkmark"></span>
                                    </label>
                                </li>
                                <li>
                                    <label class="container_radio">@autotranslate('Pick up', app()->getLocale())
                                        <input type="radio" name="type_d">
                                        <span class="checkmark"></span>
                                    </label>
                                </li>
                            </ul>
                        </div>
                        <!-- /type_delivery -->

                        <a href="#0" class="open_filters btn_filters"><i
                                class="icon_adjust-vert"></i><span>@autotranslate('Filters', app()->getLocale())</span></a>

                        <div class="filter_col">
                            <div class="inner_bt clearfix">@autotranslate('Filters', app()->getLocale())<a href="#" class="open_filters"><i
                                        class="icon_close"></i></a></div>
                            <div class="filter_type">
                                <h4><a href="#filter_1" data-bs-toggle="collapse" class="opened">Sort</a></h4>
                                <div class="collapse show" id="filter_1">
                                    <ul>
                                        <li>
                                            <label class="container_radio">@autotranslate('Top Rated', app()->getLocale())
                                                <input type="radio" name="filter_sort" checked="">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="container_radio">@autotranslate('Reccomended', app()->getLocale())
                                                <input type="radio" name="filter_sort">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="container_radio">@autotranslate('Price: low to high', app()->getLocale())
                                                <input type="radio" name="filter_sort">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="container_radio">@autotranslate('Up to 15% off', app()->getLocale())
                                                <input type="radio" name="filter_sort">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="container_radio">All Offers
                                                <input type="radio" name="filter_sort">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="container_radio">Distance
                                                <input type="radio" name="filter_sort">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- /filter_type -->
                            <div class="filter_type">
                                <h4><a href="#filter_2" data-bs-toggle="collapse" class="closed">@autotranslate('Categories', app()->getLocale())</a></h4>
                                <div class="collapse" id="filter_2">
                                    <ul>
                                        <li>
                                            <label class="container_check">Pizza - Italian <small>12</small>
                                                <input type="checkbox">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="container_check">Japanese - Sushi <small>24</small>
                                                <input type="checkbox">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="container_check">Burghers <small>23</small>
                                                <input type="checkbox">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="container_check">Vegetarian <small>11</small>
                                                <input type="checkbox">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="container_check">Bakery <small>18</small>
                                                <input type="checkbox">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="container_check">Chinese <small>12</small>
                                                <input type="checkbox">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="container_check">Mexican <small>15</small>
                                                <input type="checkbox">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- /filter_type -->
                            <div class="filter_type">
                                <h4><a href="#filter_3" data-bs-toggle="collapse" class="closed">@autotranslate('Distance', app()->getLocale())</a>
                                </h4>
                                <div class="collapse" id="filter_3">
                                    <div class="distance"> @autotranslate('Radius around selected destination', app()->getLocale()) <span
                                            id="distanceValue">{{ $selectedDistance }}</span> km</div>
                                    <div class="add_bottom_25">
                                        <input type="range" name="distance" id="distance" min="5"
                                            max="50" step="5" value="{{ $selectedDistance }}"
                                            data-orientation="horizontal" oninput="updateDistanceValue()">
                                    </div>
                                </div>
                            </div>
                            <!-- /filter_type -->
                            <div class="filter_type last">
                                <h4><a href="#filter_4" data-bs-toggle="collapse" class="closed">Rating</a></h4>
                                <div class="collapse" id="filter_4">
                                    <ul>
                                        <li>
                                            <label class="container_check">Superb 9+ <small>06</small>
                                                <input type="checkbox">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="container_check">Very Good 8+ <small>12</small>
                                                <input type="checkbox">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="container_check">Good 7+ <small>17</small>
                                                <input type="checkbox">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="container_check">Pleasant 6+ <small>43</small>
                                                <input type="checkbox">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- /filter_type -->
                            <p> <button class="btn_1 outline full-width" type="submit">@autotranslate('Apply filter', app()->getLocale())</button>
                            <p>
                    </form>
            </div>
            <script>
                function updateDistanceValue() {
                    var distanceValue = document.getElementById('distance').value;
                    document.getElementById('distanceValue').innerText = distanceValue;
                }
            </script>

            </aside>

            <div class="col-lg-9">
                <div class="row">
                    <div class="col-12">
                        <h2 class="title_small">@autotranslate('Top Categories', app()->getLocale())</h2>
                        <div class="owl-carousel owl-theme categories_carousel_in listing">
                            <div class="item">
                                <figure>
                                    <img src="{{ asset('frontend/img/cat_listing_placeholder.png') }}"
                                        data-src="{{ asset('frontend/img/cat_listing_1.jpg') }}" alt=""
                                        class="owl-lazy"></a>
                                    <a href="#0">
                                        <h3>Pizza</h3>
                                    </a>
                                </figure>
                            </div>
                            <div class="item">
                                <figure>
                                    <img src="{{ asset('frontend/img/cat_listing_placeholder.png') }}"
                                        data-src="{{ asset('frontend/img/cat_listing_2.jpg') }}" alt=""
                                        class="owl-lazy"></a>
                                    <a href="#0">
                                        <h3>Sushi</h3>
                                    </a>
                                </figure>
                            </div>
                            <div class="item">
                                <figure>
                                    <img src="{{ asset('frontend/img/cat_listing_placeholder.png') }}"
                                        data-src="{{ asset('frontend/img/cat_listing_3.jpg') }}" alt=""
                                        class="owl-lazy"></a>
                                    <a href="#0">
                                        <h3>Dessert</h3>
                                    </a>
                                </figure>
                            </div>
                            <div class="item">
                                <figure>
                                    <img src="{{ asset('frontend/img/cat_listing_placeholder.png') }}"
                                        data-src="{{ asset('frontend/img/cat_listing_4.jpg') }}" alt=""
                                        class="owl-lazy"></a>
                                    <a href="#0">
                                        <h3>Hamburgher</h3>
                                    </a>
                                </figure>
                            </div>
                            <div class="item">
                                <figure>
                                    <img src="{{ asset('frontend/img/cat_listing_placeholder.png') }}"
                                        data-src="{{ asset('frontend/img/cat_listing_5.jpg') }}" alt=""
                                        class="owl-lazy"></a>
                                    <a href="#0">
                                        <h3>Ice Cream</h3>
                                    </a>
                                </figure>
                            </div>
                            <div class="item">
                                <figure>
                                    <img src="{{ asset('frontend/img/cat_listing_placeholder.png') }}"
                                        data-src="{{ asset('frontend/img/cat_listing_6.jpg') }}" alt=""
                                        class="owl-lazy"></a>
                                    <a href="#0">
                                        <h3>Kebab</h3>
                                    </a>
                                </figure>
                            </div>
                            <div class="item">
                                <figure>
                                    <img src="{{ asset('frontend/img/cat_listing_placeholder.png') }}"
                                        data-src="{{ asset('frontend/img/cat_listing_7.jpg') }}" alt=""
                                        class="owl-lazy"></a>
                                    <a href="#0">
                                        <h3>Italian</h3>
                                    </a>
                                </figure>
                            </div>
                            <div class="item">
                                <figure>
                                    <img src="{{ asset('frontend/img/cat_listing_placeholder.png') }}"
                                        data-src="{{ asset('frontend/img/cat_listing_8.jpg') }}" alt=""
                                        class="owl-lazy"></a>
                                    <a href="#0">
                                        <h3>Chinese</h3>
                                    </a>
                                </figure>
                            </div>
                        </div>
                        <!-- /carousel -->
                    </div>
                </div>
                <!-- /row -->


                <div class="row">

                    <hr>
                    @if (count($restaurants) < 0)
                        @foreach ($restaurants as $restaurant)
                            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                                <div class="strip">
                                    <figure>
                                        <span class="ribbon off">15% off</span>
                                        <span class="ribbon_sponsored on">Sponsored</span>
                                        <img src="{{ asset('frontend/img/lazy-placeholder.png') }}"
                                            data-src="{{ asset('frontend/img/location_1.jpg') }}" class="img-fluid lazy"
                                            alt="">
                                        <a href="{{ route('detail-restaurant-2.index', ['slug' => $restaurant->slug]) }}"
                                            class="strip_info">
                                            <small>@autotranslate('Pizza, Burger', app()->getLocale())</small>
                                        </a>
                                        <div style="display: flex; align-items: center;">
                                            <img src="{{ $restaurant->logo_url }}" alt="Restaurant Logo"
                                                style="max-width: 89px; max-height: 89px; margin-right: 10px; border-radius: 10px;">
                                            <div class="item_title">
                                                <h3>{{ $restaurant->title }}</h3>
                                                <small>{{ $restaurant->street }}</small>
                                            </div>
                                        </div>
                                        </a>
                                    </figure>
                                    <ul>
                                        <li>
                                            <span class="take {{ $restaurant->no_abholung ? 'yes' : 'no' }}"
                                                title="Takeaway">@autotranslate('Pick up', app()->getLocale())</span>
                                            <span class="deliv {{ $restaurant->no_lieferung ? 'yes' : 'no' }}"
                                                title="Delivery">@autotranslate('Delivery', app()->getLocale())</span>
                                            <strong class="icon-food_icon_shop fs2">
                                                {{ number_format($restaurant->distance, 2) }} km</strong>
                                        </li>
                                        <li>
                                            @if ($restaurant->voting_average !== null)
                                                <div class="score" title="Bewertung durchschnitt">
                                                    <strong>{{ number_format($restaurant->voting_average, 1) }}</strong>
                                                </div>
                                            @else
                                            @endif
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            @foreach ($restaurant->openingHours as $openingHour)
                                <li>{{ $openingHour->day_of_week }}: {{ $openingHour->open_time }} -
                                    {{ $openingHour->close_time }}</li>
                            @endforeach
                        @endforeach
                        <!-- /strip grid -->
                    @else
                        <p>@autotranslate('No sponsored restaurants found.', app()->getLocale())</p>
                    @endif





                </div>






                {{-- Admin PromoBanner --}}
                @livewire('backend.admin.promo-banner.promo-banner-list')

                {{-- /promo --}}

                <div class="row">


                    @if (count($restaurants) > 0)
                        @foreach ($restaurants as $restaurant)
                            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                                <div class="strip">
                                    <figure>
                                        <span class="ribbon off">15% off</span>

                                        <img src="{{ asset('frontend/img/lazy-placeholder.png') }}"
                                            data-src="{{ asset('frontend/img/location_1.jpg') }}" class="img-fluid lazy"
                                            alt="">

                                        <a href="{{ route('restaurant.index', ['slug' => $restaurant->shop_slug ?? $restaurant->id]) }}"
                                            class="strip_info">
                                            <small>Pizza, Burger</small>
                                            <div style="display: flex; align-items: center;">
                                                <img src="{{ $restaurant->logo_url }}" alt="Restaurant Logo"
                                                    style="max-width: 89px; max-height: 89px; margin-right: 10px; border-radius: 10px;">
                                                <div class="item_title">
                                                    <h3>{{ $restaurant->title }}</h3>
                                                    <small>{{ $restaurant->street }}</small>
                                                </div>
                                            </div>
                                        </a>
                                    </figure>


                                    <p>{{ $restaurantStatus[$restaurant->id] }}</p>

                                    <ul>
                                        <li>
                                            <span class="take {{ $restaurant->no_abholung ? 'yes' : 'no' }}"
                                                title="Takeaway">@autotranslate('Pick up', app()->getLocale())</span>
                                            <span class="deliv {{ $restaurant->no_lieferung ? 'yes' : 'no' }}"
                                                title="Delivery">@autotranslate('Delivery', app()->getLocale())</span>
                                            <strong class="icon-food_icon_shop fs2">
                                                {{ number_format($restaurant->distance, 2) }} km</strong>
                                        </li>
                                        <li>
                                            @if ($restaurant->voting_average !== null)
                                                <div class="score" title="Bewertung durchschnitt">
                                                    <strong>{{ number_format($restaurant->voting_average, 1) }}</strong>
                                                </div>
                                            @else
                                            @endif
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        @endforeach
                        <!-- /strip grid -->
                    @else
                        <p>Keine Restaurants gefunden.</p>
                    @endif

                </div>
                <!-- /row -->

                <div class="pagination_fg">
                    {{ $restaurants->links('pagination::bootstrap-5') }}

                </div>
            </div>
        </div>
        <!-- /col -->
        </div>
        </div>
        <!-- /container -->



        <style>
            /* Stil für das Produkt */
            .product {
                position: relative;
                width: 300px;
                /* Passen Sie die Breite nach Bedarf an */
                height: 300px;
                /* Passen Sie die Höhe nach Bedarf an */
                border: 1px solid #ccc;
                padding: 10px;
                overflow: hidden;
            }

            /* Stil für den neuen Text */
            .new-badge {
                position: absolute;
                top: 10px;
                left: 10px;
                background-color: #ff0000;
                /* Hintergrundfarbe des Textes */
                color: #fff;
                /* Textfarbe */
                padding: 5px 10px;
                border-radius: 5px;
                font-weight: bold;
                animation: fadeIn 1s ease-in-out;
                /* Animationsstil */
            }

            /* CSS-Animation für das Einblenden des neuen Textes */
            @keyframes fadeIn {
                from {
                    opacity: 0;
                    /* Start mit einer undurchsichtigen Opazität */
                }

                to {
                    opacity: 1;
                    /* Enden mit einer vollständigen Opazität */
                }
            }

            .ribbon_sponsored {
                color: #fff;
                display: inline-block;
                position: absolute;
                top: 40px;
                right: 15px;
                font-weight: 500;
                -webkit-border-radius: 3px;
                -moz-border-radius: 3px;
                -ms-border-radius: 3px;
                border-radius: 3px;
                padding: 2px 2px 2px 2px;
                line-height: 1;
                font-size: 12px;
                font-size: 0.75rem;
                z-index: 9;
            }



            .ribbon_sponsored.on {
                background-color: #D63920;
            }


            .promo {
                background: #47e5b6 url(../frontend/img/pattern.svg) center center repeat;
                -webkit-border-radius: 5px;
                -moz-border-radius: 5px;
                -ms-border-radius: 5px;
                border-radius: 5px;
                margin-bottom: 25px;
                padding: 20px 25px;
                color: #fff;
                position: relative;
            }

            .promo i {
                position: absolute;
                left: -100%;
                /* Startposition auf der linken Seite, außerhalb des Bildschirms */
                animation: moveIcon 6s linear forwards;
                /* Animation mit linearem Timing */
                animation-delay: 0.5s
                    /* Verzögerung von 1 Sekunde */
            }

            @keyframes moveIcon {
                0% {
                    left: -100%;
                    /* Startposition, außerhalb des Bildschirms */
                    top: 50%;
                    /* Startposition in der Mitte des Containers */
                }

                100% {
                    left: 90%;
                    /* Endposition, rechts außerhalb des Bildschirms */
                    top: calc(50% + 50px * sin(2 * pi * (1 - ((time - delay) / duration))));
                    /* Berechnung der Sinus-Bewegung */
                }
            }
        </style>



        @push('specific-scripts')
            <!-- SPECIFIC SCRIPTS -->
            <script src="{{ asset('frontend/js/sticky_sidebar.min.js') }}"></script>
            <script src="{{ asset('frontend/js/specific_listing.js') }}"></script>
        @endpush
    @endsection
