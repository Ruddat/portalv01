@extends('frontend.layouts.default')
@section('content')
    <!-- seitenabhengig css -->
    @push('specific-css')
        <link href="{{ asset('frontend/css/home.css') }}" rel="stylesheet">

        <style>
            .button-container {
                display: flex;
                gap: 10px;
                align-items: center;

            }

            .btn_1 {
                /* Stile für den ersten Button (Search) */
                color: #fff;
                border: none;
                cursor: pointer;
                /* Weitere Stilisierungen nach Bedarf */
            }

            .btn_2 {
                /* Stile für den zweiten Button (Standort abrufen) */
                padding: 10px 20px;
                background-color: #f3723b;
                color: #fff;
                border: none;
                cursor: pointer;
                /* Weitere Stilisierungen nach Bedarf */
            }

            .icon_pin {

                width: 24px;
                /* Passe die Breite nach Bedarf an */
                height: 24px;
                /* Passe die Höhe nach Bedarf an */
                display: inline-block;
                vertical-align: middle;
                /* Zentriere das Icon vertikal im Button */
                /* Weitere Stilisierungen nach Bedarf */
            }

            .custom-button {
                width: 38px;
                /* Breite des Symbols */
                height: 38px;
                /* Höhe des Symbols */
                border: none;
                /* Kein Rahmen */
                cursor: pointer;
                /* Zeige den Mauszeiger als Zeiger an */
                padding: 0;
                /* Kein Innenabstand */
                transition: transform 0.3s, background-color 0.3s;
                /* Übergangseffekt für flüssige Größenänderung und Farbwechsel */
            }

            .custom-button:hover {
                transform: scale(1.2);
                /* Skaliere den Button beim Überfahren mit der Maus */
                background-color: #f0f0f0;
                /* Ändere die Hintergrundfarbe des Symbols */
            }

            /* Stil für den Toast-Container */
        /* Stil für das Toast-Element */
        .toast-container {
            position: fixed;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            z-index: 1000;
        }
        </style>
    @endpush

    <body>

        @include('frontend.includes.headerblack')


        <div class="hero_single version_1">
            <div class="opacity-mask">
                <div class="container">
                    <div class="row justify-content-lg-start justify-content-md-center">
                        <div class="col-xl-7 col-lg-8">
                            <h1>@autotranslate('Delivery or Takeaway Food', app()->getLocale())
                            </h1>
                            <p>@autotranslate('The best restaurants at the best price', app()->getLocale())
                                <span class="element" style="font-weight: 500"></span></p>

                            <form method="post" action="{{ route('search.index') }}" id="searchForm">
                                @csrf <!-- CSRF token for Laravel form submission -->
                                <div class="row g-0 custom-search-input">
                                    <div class="col-lg-9">
                                        <div class="form-group">
                                            <input class="form-control no_border_r" type="text" name="query"
                                                id="autocomplete"
                                                placeholder="@autotranslate('Street or location...', app()->getLocale())"
                                                value="{{ session('selectedLocation') }}">
                                            @error('query')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-3 button-container">
                                        <button class="btn_2 gradient"
                                            type="submit">@autotranslate('Search', app()->getLocale())</button>
                                    </div>
                                </div>
                            </form>
                            <!-- /row -->
                            <div class="search_trends">
                                <h5>@autotranslate('Trending', app()->getLocale())
                                </h5>
                                <ul>
                                    <li><a href="#0">Sushi</a></li>
                                    <li><a href="#0">Burgher</a></li>
                                    <li><a href="#0">Chinese</a></li>
                                    <li><a href="#0">Pizza</a></li>
                                </ul>
                            </div>
                            @livewire('frontend.search-shops.search-location')
                        </div>
                    </div>
                    <!-- /row -->
                </div>
            </div>

        </div>
        <!-- /hero_single -->



        <div class="container margin_30_60">
            <div class="main_title center">
                <span><em></em></span>
                <h2>@autotranslate('Popular Categories', app()->getLocale())</h2>
                <p>Cum doctus civibus efficiantur in imperdiet deterruisset</p>
            </div>
            <!-- /main_title -->

            <div class="owl-carousel owl-theme categories_carousel">
                <div class="item_version_2">
                    <a href="grid-listing-filterscol.html">
                        <figure>
                            <span>98</span>
                            <img src="{{ asset('frontend/img/home_cat_placeholder.jpg') }}"
                                data-src="{{ asset('frontend/img/home_cat_pizza.jpg') }}" alt="" class="owl-lazy"
                                width="350" height="450">
                            <div class="info">
                                <h3>Pizza</h3>
                                <small>Avg price $40</small>
                            </div>
                        </figure>
                    </a>
                </div>
                <div class="item_version_2">
                    <a href="grid-listing-filterscol.html">
                        <figure>
                            <span>87</span>
                            <img src="{{ asset('frontend/img/home_cat_placeholder.jpg') }}"
                                data-src="{{ asset('frontend/img/home_cat_sushi.jpg') }}" alt="" class="owl-lazy"
                                width="350" height="450">
                            <div class="info">
                                <h3>Japanese</h3>
                                <small>Avg price $50</small>
                            </div>
                        </figure>
                    </a>
                </div>
                <div class="item_version_2">
                    <a href="grid-listing-filterscol.html">
                        <figure>
                            <span>55</span>
                            <img src="{{ asset('frontend/img/home_cat_placeholder.jpg') }}"
                                data-src="{{ asset('frontend/img/home_cat_hamburgher.jpg') }}" alt=""
                                class="owl-lazy" width="350" height="450">
                            <div class="info">
                                <h3>Burghers</h3>
                                <small>Avg price $55</small>
                            </div>
                        </figure>
                    </a>
                </div>
                <div class="item_version_2">
                    <a href="grid-listing-filterscol.html">
                        <figure>
                            <span>55</span>
                            <img src="{{ asset('frontend/img/home_cat_placeholder.jpg') }}"
                                data-src="{{ asset('frontend/img/home_cat_vegetarian.jpg') }}" alt=""
                                class="owl-lazy" width="350" height="450">
                            <div class="info">
                                <h3>Vegetarian</h3>
                                <small>Avg price $40</small>
                            </div>
                        </figure>
                    </a>
                </div>
                <div class="item_version_2">
                    <a href="grid-listing-filterscol.html">
                        <figure>
                            <span>65</span>
                            <img src="{{ asset('frontend/img/home_cat_placeholder.jpg') }}"
                                data-src="{{ asset('frontend/img/home_cat_bakery.jpg') }}" alt="" class="owl-lazy"
                                width="350" height="450">
                            <div class="info">
                                <h3>Bakery</h3>
                                <small>Avg price $60</small>
                            </div>
                        </figure>
                    </a>
                </div>
                <div class="item_version_2">
                    <a href="grid-listing-filterscol.html">
                        <figure>
                            <span>25</span>
                            <img src="{{ asset('frontend/img/home_cat_placeholder.jpg') }}"
                                data-src="{{ asset('frontend/img/home_cat_chinesse.jpg') }}" alt=""
                                class="owl-lazy" width="350" height="450">
                            <div class="info">
                                <h3>Chinese</h3>
                                <small>Avg price $40</small>
                            </div>
                        </figure>
                    </a>
                </div>
                <div class="item_version_2">
                    <a href="grid-listing-filterscol.html">
                        <figure>
                            <span>35</span>
                            <img src="{{ asset('frontend/img/home_cat_placeholder.jpg') }}"
                                data-src="{{ asset('frontend/img/home_cat_mexican.jpg') }}" alt=""
                                class="owl-lazy" width="350" height="450">
                            <div class="info">
                                <h3>Mexican</h3>
                                <small>Avg price $35</small>
                            </div>
                        </figure>
                    </a>
                </div>
            </div>
            <!-- /carousel -->
        </div>
        <!-- /container -->



                <div class="bg_gray">
                    <div class="container margin_60_40">
                        <div class="main_title">
                            <span><em></em></span>
                            <h2>@autotranslate('Top Rated Restaurants', app()->getLocale())</h2>
                            <p>@autotranslate('Discover the best-rated restaurants in your area.', app()->getLocale())</p>
                            <a href="{{ route('best-ratet-restaurants.viewAll') }}">@autotranslate('View All', app()->getLocale()) &rarr;</a>
                        </div>
                        <div class="row add_bottom_25">
                            @foreach($restaurants as $restaurant)
                                <div class="col-lg-6">
                                    <div class="list_home">
                                        <ul>
                                            <li>
                                                <a href="{{ route('restaurant.index', ['slug' => $restaurant->shop_slug ?? $restaurant->id]) }}">
                                                    <figure>
                                                        <img src="{{ $restaurant->logo_url ? $restaurant->logo_url : asset('frontend/img/location_list_placeholder.png') }}"
                                                             data-src="{{ $restaurant->logo_url ? $restaurant->logo_url : asset('frontend/img/location_list_placeholder.png') }}"
                                                             alt="{{ $restaurant->title }}"
                                                             class="lazy" width="350" height="233" style="max-width: 50%; height: auto;">
                                                    </figure>
                                                    <div class="score"><strong>{{ $restaurant->voting_average }}</strong></div>
                                                    <em>{{ $restaurant->categories }}</em>
                                                    <h3>{{ $restaurant->title }}</h3>
                                                    <small>{{ $restaurant->street }} {{ $restaurant->zip }} {{ $restaurant->city }}</small>
                                                    <ul>
                                                        <li><span class="ribbon off">{{ $restaurant->charge }}%</span></li>
                                                        <li>@autotranslate('Average price ', app()->getLocale()) ${{ $restaurant->per_order }}</li>
                                                    </ul>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <!-- /row -->








                <div class="banner lazy" data-bg="url({{ asset('frontend/img/banner_bg_desktop.jpg') }}">
                    <div class="wrapper d-flex align-items-center opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.3)">
                        <div>
                            <small>@autotranslate('MamasExpress', app()->getLocale())</small>
                            <h3>@autotranslate('We Deliver to your Office', app()->getLocale())
                            </h3>
                            <p>@autotranslate('Enjoy a tasty food in minutes!', app()->getLocale())
                            </p>
                            <a href="/get-location"
                                class="btn_1 gradient">@autotranslate('Start Now!', app()->getLocale())</a>
                        </div>
                    </div>
                    <!-- /wrapper -->
                </div>
                <!-- /banner -->
            </div>
        </div>
        <!-- /bg_gray -->



        @include('frontend.includes.page-snipped.broker-seller')


@push('specific-scripts')

@endpush


<style>
.social-proof-container {
    position: fixed;
    bottom: 20px;
    right: 20px;
    z-index: 99999;
    display: none; /* Hidden by default */
}

.social-proof-container.active {
    display: block; /* Display when the active class is added */
}

.popup-container {
    position: fixed;
    bottom: 20px;
    left: 20px;
    z-index: 99999;
}

.popup {
    background-color: #fff;
    padding: 20px;
    border: 1px solid #ccc;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    margin-bottom: 10px;
    opacity: 1;
    transition: opacity 0.3s ease-in-out;
    animation: fadeIn 0.3s ease-in-out;
    z-index: 99999;
}

.close {
    position: absolute;
    top: 10px;
    right: 10px;
    cursor: pointer;
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

</style>




        <script>
            document.addEventListener("DOMContentLoaded", function() {
                // Event-Listener für Klickereignis auf Schaltfläche
                document.getElementById("btn1").addEventListener("click", function() {
                    showToast("@autotranslate('The radius search has been initiated. Please wait a moment while we gather the results for you.', app()->getLocale())");
                });

                function showToast(message) {
                    // Erstellen des Toast-Elements
                    var toast = document.createElement("div");
                    toast.classList.add("toast-container");
                    toast.textContent = message;
                    // Hinzufügen des Toast-Elements zum body
                    document.body.appendChild(toast);
                    // Timeout zum Ausblenden des Toasts nach 3 Sekunden
                    setTimeout(function() {
                        toast.style.display = "none";
                        document.body.removeChild(toast);
                    }, 3000);
                }
            });
        </script>

        @push('specific-scripts')



            <!-- Typeahead.js CSS -->
            <link rel="stylesheet"
                href="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js-bootstrap-css/1.2.1/typeaheadjs.min.css" />

            <!-- Typeahead.js JavaScript -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script>


            <script>
                // Initialisiere Typeahead.js für das Autocomplete-Input
                $(document).ready(function() {
                    $('#autocomplete').typeahead({
                        minLength: 3, // Minimale Länge für die Sucheingabe
                        highlight: false,
                        hint: true,
                    }, {
                        name: 'places',
                        source: function(query, syncResults, asyncResults) {
                            // OpenStreetMap Nominatim API für Autocomplete
                            $.get('https://nominatim.openstreetmap.org/search', {
                                q: query,
                                format: 'json'
                            }, function(data) {
                                asyncResults(data.map(function(place) {
                                    return place.display_name;
                                }));
                            });
                        },
                        limit: 10, // Anzahl der angezeigten Ergebnisse
                    });
                });
            </script>



        @endpush
    @endsection
