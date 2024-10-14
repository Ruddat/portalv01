@extends('frontend.layouts.default')
@section('content')
    <!-- seitenabhängig CSS -->
    @push('specific-css')
        <link href="{{ asset('frontend/css/listing.css') }}" rel="stylesheet">
        <link href="{{ asset('frontend/css/leaflet.css') }}" rel="stylesheet">
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
                        <a href="/" aria-label="@autotranslate('Change address', app()->getLocale())">@autotranslate('Change address', app()->getLocale())</a>
                        <!-- Im Header des Templates, wo die Stadt und der Ortsname angezeigt werden sollen -->
                    </div>
                    <div class="col-xl-4 col-lg-5 col-md-5">
                        <div class="search_bar_list">
                            <form action="{{ route('search.restaurants') }}" method="GET">
                                <label for="search-input" class="visually-hidden">@autotranslate('Search for dishes, restaurants or cuisines', app()->getLocale())</label>
                                <input type="text" class="form-control" id="search-input" name="query" placeholder="@autotranslate('Dishes, restaurants or cuisines', app()->getLocale())" required>
                                <button type="submit" aria-label="@autotranslate('Search', app()->getLocale())"><i class="icon_search"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /row -->
            </div>
        </div>
        <!-- /page_header -->

        <div class="filters_full clearfix add_bottom_15">
            <div class="container">
                <div class="type_delivery">
                    <ul class="clearfix">
                        <li>
                            <label class="container_radio" for="all">@autotranslate('All', app()->getLocale())
                                <input type="radio" name="type_d" value="all" id="all" checked data-filter="*" class="selected">
                                <span class="checkmark"></span>
                            </label>
                        </li>
                        <li>
                            <label class="container_radio" for="delivery">@autotranslate('Delivery', app()->getLocale())
                                <input type="radio" name="type_d" value="delivery" id="delivery" data-filter=".delivery">
                                <span class="checkmark"></span>
                            </label>
                        </li>
                        <li>
                            <label class="container_radio" for="takeaway">@autotranslate('Abholen', app()->getLocale())
                                <input type="radio" name="type_d" value="takeway" id="takeaway" data-filter=".takeaway">
                                <span class="checkmark"></span>
                            </label>
                        </li>
                    </ul>
                </div>
                <!-- /type_delivery -->
                <a class="btn_map mobile btn_filters d-none" data-bs-toggle="collapse" href="#collapseMap" aria-label="@autotranslate('Show map', app()->getLocale())">
                    <i class="icon_pin_alt"></i>
                </a>
                <a href="#collapseFilters" data-bs-toggle="collapse" class="btn_filters" aria-label="@autotranslate('Show filters', app()->getLocale())"><i class="icon_adjust-vert"></i><span>@autotranslate('Filters', app()->getLocale())</span></a>
            </div>
        </div>
        <!-- /filters_full -->
        <div class="collapse" id="collapseMap">
            <div id="map" class="map" role="region" aria-label="@autotranslate('Map of restaurants', app()->getLocale())"></div>
        </div>
        <!-- /Map -->

        <div class="collapse filters_2" id="collapseFilters">
            <div class="container margin_30_20">
                <form action="{{ route('search.index') }}" method="get">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="filter_type">
                                <h6>@autotranslate('Categories', app()->getLocale())</h6>
                                <ul>
                                    <li>
                                        <label class="container_check" for="category-pizza">Pizza - Italian <small>12</small>
                                            <input type="checkbox" id="category-pizza">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="container_check" for="category-sushi">Japanese - Sushi <small>24</small>
                                            <input type="checkbox" id="category-sushi">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="container_check" for="category-burghers">Burghers <small>23</small>
                                            <input type="checkbox" id="category-burghers">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="container_check" for="category-vegetarian">Vegetarian <small>11</small>
                                            <input type="checkbox" id="category-vegetarian">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="filter_type">
                                <h6>@autotranslate('Rating', app()->getLocale())</h6>
                                <ul>
                                    <li>
                                        <label class="container_check" for="rating-superb">Superb 9+ <small>06</small>
                                            <input type="checkbox" id="rating-superb">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="container_check" for="rating-very-good">Very Good 8+ <small>12</small>
                                            <input type="checkbox" id="rating-very-good">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="container_check" for="rating-good">Good 7+ <small>17</small>
                                            <input type="checkbox" id="rating-good">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="container_check" for="rating-pleasant">Pleasant 6+ <small>43</small>
                                            <input type="checkbox" id="rating-pleasant">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="filter_type">
                                <h6>@autotranslate('Distance', app()->getLocale())</h6>
                                <div class="distance">
                                    @autotranslate('Radius around selected destination', app()->getLocale())
                                    <span id="distanceValue">{{ $selectedDistance }}</span> km
                                </div>
                                <div class="mb-3">
                                    <label for="distance" class="visually-hidden">@autotranslate('Distance range', app()->getLocale())</label>
                                    <input type="range" name="distance" id="distance" min="5" max="50" step="5"
                                           value="{{ $selectedDistance }}" data-orientation="horizontal" oninput="updateDistanceValue()">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /row -->
                    <p>
                        <button class="btn_1 outline full-width" type="submit" aria-label="@autotranslate('Apply filter', app()->getLocale())">@autotranslate('Apply filter', app()->getLocale())</button>
                    </p>
                </form>
            </div>
        </div>
        <!-- /filters -->
        <div class="container margin_30_20">
            <hr>
            <div class="row isotope-wrapper">
                <!-- gesponsert start -->
                @if ($sponsoredRestaurants->count())
                    @foreach ($sponsoredRestaurants as $restaurant)
                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 isotope-item
                            {{ $restaurant->no_lieferung == 0 ? 'delivery' : '' }}
                            {{ $restaurant->no_abholung == 0 ? 'takeaway' : '' }}">
                            <div class="strip">
                                <figure>
                                    <span class="ribbon off">15% off</span>
                                    <span class="ribbon_sponsored on">Sponsored</span>
                                    <span class="ribbon_stampcard on">StampCard</span>
                                    <img src="{{ asset('frontend/img/lazy-placeholder.png') }}"
                                        data-src="{{ asset('frontend/img/location_1.jpg') }}" class="img-fluid lazy"
                                        alt="{{ $restaurant->title }} - Restaurant Logo">
                                    <a href="{{ localized_route('restaurant.index', ['slug' => $restaurant->shop_slug ?? $restaurant->id, 'source' => 'sponsored']) }}"
                                        class="strip_info" aria-label="@autotranslate('View details of', app()->getLocale()) {{ $restaurant->title }}">
                                        <small>@autotranslate('Pizza, Burger', app()->getLocale())</small>
                                        <div style="display: flex; align-items: center;">
                                            <img src="{{ $restaurant->logo_url }}" alt="{{ $restaurant->title }} - Restaurant Logo"
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
                                            {{ number_format($restaurant->distance, 2) }} km
                                        </strong>
                                    </li>
                                    <li>
                                        @if ($restaurant->voting_average !== null)
                                            <div class="score" title="Bewertung durchschnitt">
                                                <strong>{{ number_format($restaurant->voting_average, 1) }}</strong>
                                            </div>
                                        @endif
                                    </li>
                                </ul>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p>@autotranslate('No sponsored restaurants found.', app()->getLocale())</p>
                @endif
                <!-- gesponsert end -->
            </div>

            {{-- Admin PromoBanner --}}
            @livewire('backend.admin.promo-banner.promo-banner-list')
            {{-- /promo --}}

            <div class="row isotope-wrapper">
                @if (count($restaurants) > 0)
                    @foreach ($restaurants as $restaurant)
                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 isotope-item
                            {{ $restaurant->no_lieferung == 0 ? 'delivery' : '' }}
                            {{ $restaurant->no_abholung == 0 ? 'takeaway' : '' }}">
                            <div class="strip">
                                <figure>
                                    <span class="ribbon off">15% off</span>
                                    <img src="{{ asset('frontend/img/lazy-placeholder.png') }}"
                                        data-src="{{ asset('frontend/img/location_1.jpg') }}" class="img-fluid lazy"
                                        alt="{{ $restaurant->title }} - Restaurant Logo">
                                    <a href="{{ localized_route('restaurant.index', ['slug' => $restaurant->shop_slug ?? $restaurant->id]) }}"
                                        class="strip_info" aria-label="@autotranslate('View details of', app()->getLocale()) {{ $restaurant->title }}">
                                        <small>Pizza, Burger</small>
                                        <div style="display: flex; align-items: center;">
                                            <img src="{{ $restaurant->logo_url }}" alt="{{ $restaurant->title }} - Restaurant Logo"
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
                                        <span class="take {{ $restaurant->no_abholung == 1 ? 'no' : 'yes' }}"
                                            title="Takeaway">@autotranslate('Pick up', app()->getLocale())</span>
                                        <span class="deliv {{ $restaurant->no_lieferung == 1 ? 'no' : 'yes' }}"
                                            title="Delivery">@autotranslate('Delivery', app()->getLocale())</span>
                                        <strong class="icon-food_icon_shop fs2">
                                            {{ number_format($restaurant->distance, 2) }} km</strong>
                                    </li>
                                    <li>
                                        @if ($restaurant->voting_average !== null)
                                            <div class="score" title="Bewertung durchschnitt">
                                                <strong>{{ number_format($restaurant->voting_average, 1) }}</strong>
                                            </div>
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
            <!-- /strip row -->
            <div class="pagination_fg">
                {{ $restaurants->links('pagination::bootstrap-5') }}
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


            .ribbon_stampcard {
                color: #fff;
                display: inline-block;
                position: absolute;
                top: 60px;
                right: 15px;
                font-weight: 500;
                -webkit-border-radius: 3px;
                -moz-border-radius: 3px;
                -ms-border-radius: 3px;
                border-radius: 3px;
                padding: 2px 2px 2px 2px;
                line-height: 1;
                font-size: 12px;
                font-size: 0.85rem;
                z-index: 9;
            }



            .ribbon_stampcard.on {
                background-color: #f1b40b;
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
            <script src="{{ asset('frontend/js/isotope.min.js') }}"></script>

            <script>
                $(window).on("load", function() {
                    var $container = $('.isotope-wrapper');
                    $container.isotope({ itemSelector: '.isotope-item', layoutMode: 'masonry' });
                });
                $('.type_delivery').on('click', 'input', 'change', function() {
                    var selector = $(this).attr('data-filter');
                    $('.isotope-wrapper').isotope({ filter: selector });
                });
            </script>

            <script>
                function updateDistanceValue() {
                    var distanceInput = document.getElementById("distance");
                    var distanceValue = document.getElementById("distanceValue");
                    distanceValue.textContent = distanceInput.value;
                }
            </script>

<script>
    $(document).ready(function() {
    $('.search_bar_list form').on('submit', function(e) {
        e.preventDefault(); // Verhindert das normale Absenden des Formulars

        var query = $('input[name="query"]').val();

        $.ajax({
            url: $(this).attr('action'),
            method: 'GET',
            data: { query: query },
            success: function(response) {
                // Hier kannst du die Ergebnisse dynamisch auf der Seite anzeigen
                $('#restaurant-list').html(response);
            },
            error: function(xhr) {
                alert('Error: ' + xhr.responseText);
            }
        });
    });
});
</script>


            <!-- Map LeafLet + Mapbox-->
            <script src="{{ asset('frontend/js/leaflet_map/leaflet.min.js') }}"></script>
            <script src="{{ asset('frontend/js/leaflet_map/leaflet_markercluster.min.js') }}"></script>
            <script src="{{ asset('frontend/js/leaflet_map/leaflet_markers.js') }}"></script>
            <script src="{{ asset('frontend/js/leaflet_map/leaflet_func.js') }}"></script>
        @endpush
    @endsection
