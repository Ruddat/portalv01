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
                            <p>{{ app(\App\Services\TranslationService::class)->trans(
                                'The best restaurants at the best price
                                                            ',
                                app()->getLocale(),
                            ) }}
                                <span class="element" style="font-weight: 500"></span></p>

                            <form method="post" action="{{ route('search.index') }}" id="searchForm">
                                @csrf <!-- CSRF token for Laravel form submission -->
                                <div class="row g-0 custom-search-input">
                                    <div class="col-lg-9">
                                        <div class="form-group">
                                            <input class="form-control no_border_r" type="text" name="query"
                                                id="autocomplete"
                                                placeholder="{{ app(\App\Services\TranslationService::class)->trans('Strasse oder Ort...', app()->getLocale()) }}"
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

                            <button class="custom-button" id="btn1" type="loc_button" onclick="getLocation()"
                                aria-label="Custom Button" ontouchstart="">
                                <i class="feather-map-pin h4 icofont-3x text-success"></i>
                            </button>

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
                    <h2>@autotranslate('Top Rated Restaurants', app()->getLocale())
                    </h2>
                    <p>Cum doctus civibus efficiantur in imperdiet deterruisset.</p>
                    <a href="#0">@autotranslate('View All', app()->getLocale()) &rarr;</a>
                </div>
                <div class="row add_bottom_25">
                    <div class="col-lg-6">
                        <div class="list_home">
                            <ul>
                                <li>
                                    <a href="detail-restaurant.html">
                                        <figure>
                                            <img src="{{ asset('frontend/img/location_list_placeholder.png') }}"
                                                data-src="{{ asset('frontend/img/location_list_1.jpg') }}" alt=""
                                                class="lazy" width="350" height="233">
                                        </figure>
                                        <div class="score"><strong>9.5</strong></div>
                                        <em>Italian</em>
                                        <h3>La Monnalisa</h3>
                                        <small>8 Patriot Square E2 9NF</small>
                                        <ul>
                                            <li><span class="ribbon off">-30%</span></li>
                                            <li>Average price $35</li>
                                        </ul>
                                    </a>
                                </li>
                                <li>
                                    <a href="detail-restaurant.html">
                                        <figure>
                                            <img src="{{ asset('frontend/img/location_list_placeholder.png') }}"
                                                data-src="{{ asset('frontend/img/location_list_2.jpg') }}" alt=""
                                                class="lazy" width="350" height="233">
                                        </figure>
                                        <div class="score"><strong>8.0</strong></div>
                                        <em>Mexican</em>
                                        <h3>Alliance</h3>
                                        <small>27 Old Gloucester St, 4563</small>
                                        <ul>
                                            <li><span class="ribbon off">-40%</span></li>
                                            <li>Average price $30</li>
                                        </ul>
                                    </a>
                                </li>
                                <li>
                                    <a href="detail-restaurant.html">
                                        <figure>
                                            <img src="{{ asset('frontend/img/location_list_placeholder.png') }}"
                                                data-src="{{ asset('frontend/img/location_list_3.jpg') }}" alt=""
                                                class="lazy" width="350" height="233">
                                        </figure>
                                        <div class="score"><strong>9.0</strong></div>
                                        <em>Sushi - Japanese</em>
                                        <h3>Sushi Gold</h3>
                                        <small>Old Shire Ln EN9 3RX</small>
                                        <ul>
                                            <li><span class="ribbon off">-25%</span></li>
                                            <li>Average price $20</li>
                                        </ul>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="list_home">
                            <ul>
                                <li>
                                    <a href="detail-restaurant.html">
                                        <figure>
                                            <img src="{{ asset('frontend/img/location_list_placeholder.png') }}"
                                                data-src="{{ asset('frontend/img/location_list_4.jpg') }}" alt=""
                                                class="lazy" width="350" height="233">
                                        </figure>
                                        <div class="score"><strong>9.5</strong></div>
                                        <em>Vegetarian</em>
                                        <h3>Mr. Pepper</h3>
                                        <small>27 Old Gloucester St, 4563</small>
                                        <ul>
                                            <li><span class="ribbon off">-30%</span></li>
                                            <li>Average price $20</li>
                                        </ul>
                                    </a>
                                </li>
                                <li>
                                    <a href="detail-restaurant.html">
                                        <figure>
                                            <img src="{{ asset('frontend/img/location_list_placeholder.png') }}"
                                                data-src="{{ asset('frontend/img/location_list_5.jpg') }}" alt=""
                                                class="lazy" width="350" height="233">
                                        </figure>
                                        <div class="score"><strong>8.0</strong></div>
                                        <em>Chinese</em>
                                        <h3>Dragon Tower</h3>
                                        <small>22 Hertsmere Rd E14 4ED</small>
                                        <ul>
                                            <li><span class="ribbon off">-50%</span></li>
                                            <li>Average price $35</li>
                                        </ul>
                                    </a>
                                </li>
                                <li>
                                    <a href="detail-restaurant.html">
                                        <figure>
                                            <img src="{{ asset('frontend/img/location_list_placeholder.png') }}"
                                                data-src="{{ asset('frontend/img/location_list_6.jpg') }}" alt=""
                                                class="lazy" width="350" height="233">
                                        </figure>
                                        <div class="score"><strong>8.5</strong></div>
                                        <em>Pizza - Italian</em>
                                        <h3>Bella Napoli</h3>
                                        <small>135 Newtownards Road BT4</small>
                                        <ul>
                                            <li><span class="ribbon off">-45%</span></li>
                                            <li>Average price $25</li>
                                        </ul>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /row -->
                <div class="banner lazy" data-bg="url({{ asset('frontend/img/banner_bg_desktop.jpg') }}">
                    <div class="wrapper d-flex align-items-center opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.3)">
                        <div>
                            <small>{{ app(\App\Services\TranslationService::class)->trans('FooYes Delivery', app()->getLocale()) }}</small>
                            <h3>@autotranslate('We Deliver to your Office', app()->getLocale())
                            </h3>
                            <p>@autotranslate('Enjoy a tasty food in minutes!', app()->getLocale())
                            </p>
                            <a href="grid-listing-filterscol.html"
                                class="btn_1 gradient">@autotranslate('Start Now!', app()->getLocale())</a>
                        </div>
                    </div>
                    <!-- /wrapper -->
                </div>
                <!-- /banner -->
            </div>
        </div>
        <!-- /bg_gray -->

        <div class="shape_element_2">
            <div class="container margin_60_0">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="box_how">
                                    <figure><img src="{{ asset('frontend/img/lazy-placeholder-100-100-white.png') }}"
                                            data-src="{{ asset('frontend/img/how_1.svg') }}" alt=""
                                            width="150" height="167" class="lazy"></figure>
                                    <h3>@autotranslate('Easly Order', app()->getLocale())
                                    </h3>
                                    <p>Faucibus ante, in porttitor tellus blandit et. Phasellus tincidunt metus lectus
                                        sollicitudin.</p>
                                </div>
                                <div class="box_how">
                                    <figure><img src="{{ asset('frontend/img/lazy-placeholder-100-100-white.png') }}"
                                            data-src="{{ asset('frontend/img/how_2.svg') }}" alt=""
                                            width="130" height="145" class="lazy"></figure>
                                    <h3>{{ app(\App\Services\TranslationService::class)->trans('Quick Delivery', app()->getLocale()) }}
                                    </h3>
                                    <p>Maecenas pulvinar, risus in facilisis dignissim, quam nisi hendrerit nulla, id
                                        vestibulum.</p>
                                </div>
                            </div>
                            <div class="col-lg-6 align-self-center">
                                <div class="box_how">
                                    <figure><img src="{{ asset('frontend/img/lazy-placeholder-100-100-white.png') }}"
                                            data-src="{{ asset('frontend/img/how_3.svg') }}" alt=""
                                            width="150" height="132" class="lazy"></figure>
                                    <h3>@autotranslate('Enjoy Food', app()->getLocale())
                                    </h3>
                                    <p>Morbi convallis bibendum urna ut viverra. Maecenas quis consequat libero, a feugiat
                                        eros.</p>
                                </div>
                            </div>
                        </div>
                        <p class="text-center mt-3 d-block d-lg-none"><a href="#0"
                                class="btn_1 medium gradient pulse_bt mt-2">@autotranslate('Register Now!', app()->getLocale())</a>
                        </p>
                    </div>
                    <div class="col-lg-5 offset-lg-1 align-self-center">
                        <div class="intro_txt">
                            <div class="main_title">
                                <span><em></em></span>
                                <h2>@autotranslate('Start Ordering Now', app()->getLocale())
                                </h2>
                            </div>
                            <p class="lead">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed imperdiet libero
                                id nisi euismod, sed porta est consectetur deserunt.</p>
                            <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
                                pariatur.</p>
                            <p><a href="#0"
                                    class="btn_1 medium gradient pulse_bt mt-2">@autotranslate('Register', app()->getLocale())</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /shape_element_2 -->


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

            <!-- Axios JavaScript -->

            <script src="{{ asset('extra-assets\axios\axios.min.js') }}"></script>

            <script>
                document.getElementById('btn1').addEventListener('click', getLocation);

                async function getLocation() {
                    if (navigator.geolocation) {
                        try {
                            const position = await new Promise((resolve, reject) => {
                                navigator.geolocation.getCurrentPosition(resolve, reject, {
                                    enableHighAccuracy: true,
                                    timeout: 10000,
                                    maximumAge: 0
                                });
                            });
                            await showPosition(position);
                        } catch (error) {
                            showError(error);
                        }
                    } else {
                        console.log('Ihr Browser unterst�tzt keine Geolocation.');
                    }
                }

                async function showPosition(position) {
                    const latitude = position.coords.latitude;
                    const longitude = position.coords.longitude;

                    // Leere das Eingabefeld f�r die Suchabfrage
                    $('#autocomplete').val('');

                    // L�sche die alten Koordinaten aus der Session
                    sessionStorage.removeItem('userLatitude');
                    sessionStorage.removeItem('userLongitude');

                    // CSRF-Token aus dem Meta-Tag der Seite abrufen
                    const csrfToken = $('meta[name="csrf-token"]').attr('content');

                    try {
                        const response = await axios.post('/speichere-standort', {
                            latitude: latitude,
                            longitude: longitude
                        }, {
                            headers: {
                                'X-CSRF-TOKEN': csrfToken,
                                'Content-Type': 'application/json'
                            }
                        });

                        // Erfolgreiche Anfrage
                        console.log(response.data);
                        // Überpr�fe, ob die Koordinaten erfolgreich gespeichert wurden
                        if (response.data.success) {
                            // Validierung erfolgreich, das Suchformular automatisch senden
                            $('#searchForm').submit();
                        } else {
                            // Fehlermeldung anzeigen
                            alert(response.data.message);
                        }
                    } catch (error) {
                        // Fehlerbehandlung
                        console.error('Fehler bei der Standortabfrage:', error);
                        console.log("Ein Fehler ist aufgetreten, bitte versuchen Sie es erneut.");
                    }
                }

                function showError(error) {
                    switch (error.code) {
                        case error.PERMISSION_DENIED:
                            console.log("Benutzer lehnte Standortabfrage ab.");
                            break;
                        case error.POSITION_UNAVAILABLE:
                            console.log("Standortdaten sind nicht verf�gbar.");
                            break;
                        case error.TIMEOUT:
                            console.log("Die Standortabfrage dauerte zu lange (Time-out). Bitte versuchen Sie es erneut.");
                            break;
                        case error.UNKNOWN_ERROR:
                            console.log("Unbekannter Fehler.");
                            break;
                    }
                }
            </script>

        @endpush
    @endsection
