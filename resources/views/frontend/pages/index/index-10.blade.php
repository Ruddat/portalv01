@extends('frontend.layouts.default')
@section('content')
    <!-- seitenabhengig css -->
    @push('specific-css')
        <link href="{{ asset('frontend/css/home.css') }}" rel="stylesheet">
        <link href="{{ asset('frontend/css/custom/index.css') }}" rel="stylesheet">
        <link href="{{ asset('frontend/css/custom/sozialproof.css') }}" rel="stylesheet">
    @endpush


        @include('frontend.includes.header-clearfix-element-to-stick')

        <div class="hero_single jarallax" data-jarallax-video="mp4:./video/intro-handy.mp4,webm:./video/intro.webm,ogv:./video/intro.ogv">
            <div class="placeholder-image" style="background-image: url('path/to/placeholder-image.jpg');"></div>
            <div class="opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.5)">
                <div class="container">
                    <div class="row justify-content-lg-start justify-content-md-center">
                        <div class="col-xl-7 col-lg-8">
                            <h1>@autotranslate('Delivery or Takeaway Food', app()->getLocale())</h1>
                            <p>@autotranslate('The best restaurants at the best price', app()->getLocale())
                                <span class="element" style="font-weight: 500"></span>
                            </p>
                            <form method="get" action="{{ localized_route('search.index') }}" id="searchForm">
                                @csrf <!-- CSRF token for Laravel form submission -->
                                <div class="row g-0 custom-search-input">
                                    <div class="col-lg-9">
                                        <div class="form-group">
                                            <input class="form-control no_border_r" type="text" name="query"
                                                id="autocomplete" placeholder="@autotranslate('Street or location...', app()->getLocale())"
                                                value="{{ session('selectedLocation') }}">
                                            <input type="hidden" name="latitude" id="latitude">
                                            <input type="hidden" name="longitude" id="longitude">
                                        </div>
                                    </div>
                                    <div class="col-lg-3 button-container">
                                        <button class="btn_1 gradient" type="submit">@autotranslate('Search', app()->getLocale())</button>
                                    </div>
                                </div>
                                @error('query')
                                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                        <strong>Hunger!</strong> {{ $message }}.
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @enderror
                            </form>
                            <!-- /row -->
                            <div class="search_trends white">
                                <h5>@autotranslate('Trending', app()->getLocale())</h5>
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
            <div class="wave hero"></div>
        </div>
        <!-- /hero_single -->


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
                    @foreach ($restaurants as $restaurant)
                        <div class="col-lg-6">
                            <div class="list_home">
                                <ul>
                                    <li>
                                        <a
                                            href="{{ localized_route('restaurant.index', ['slug' => $restaurant->shop_slug ?? $restaurant->id]) }}">
                                            <figure>
                                                <img src="{{ $restaurant->logo_url ? $restaurant->logo_url : asset('frontend/img/location_list_placeholder.png') }}"
                                                    data-src="{{ $restaurant->logo_url ? $restaurant->logo_url : asset('frontend/img/location_list_placeholder.png') }}"
                                                    alt="{{ $restaurant->title }}" class="lazy" width="350"
                                                    height="233" style="max-width: 50%; height: auto;">
                                            </figure>
                                            <div class="score"><strong>{{ $restaurant->voting_average }}</strong></div>
                                            <em>{{ $restaurant->categories }}</em>
                                            <h3>{{ $restaurant->title }}</h3>
                                            <small>{{ $restaurant->street }} {{ $restaurant->zip }}
                                                {{ $restaurant->city }}</small>
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
                            <a href="/get-location" class="btn_1 gradient">@autotranslate('Start Now!', app()->getLocale())</a>
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


        <style>
            .placeholder-image {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-size: cover;
                background-position: center;
                z-index: 1;
            }
            .dropdown-menu-content {
                background-color: black;
            }

</style>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var placeholderImage = document.querySelector('.placeholder-image');
                var videoElement = document.querySelector('.jarallax-video');

                if (videoElement) {
                    videoElement.addEventListener('loadeddata', function() {
                        placeholderImage.style.display = 'none';
                    });
                }
            });
        </script>




<!-- SPECIFIC SCRIPTS -->
<script src="{{ asset('frontend/js/jarallax.min.js') }}"></script>
<script src="{{ asset('frontend/js/jarallax-video.min.js') }}"></script>



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




<!-- Autocomplete -->


<!-- Typeahead.js CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js-bootstrap-css/1.2.1/typeaheadjs.min.css" />

<!-- Typeahead.js JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script>

<script>
    // Initialisiere Typeahead.js für das Autocomplete-Input
    $(document).ready(function() {
        $('#autocomplete').typeahead({
            minLength: 3, // Minimale Länge für die Sucheingabe
            highlight: true,
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
                        return {
                            value: place.display_name,
                            lat: place.lat,
                            lon: place.lon
                        };
                    }));
                });
            },
            limit: 10, // Anzahl der angezeigten Ergebnisse
            display: function(item) {
                return item.value;
            },
            templates: {
                suggestion: function(item) {
                    return '<div>' + item.value + '</div>';
                }
            }
        });

        // Event-Handler für die Auswahl eines Autocomplete-Ergebnisses
        $('#autocomplete').on('typeahead:select', function(e, suggestion) {
            // Setze die Koordinaten in versteckte Input-Felder
            $('#latitude').val(suggestion.lat);
            $('#longitude').val(suggestion.lon);
        });
    });
</script>



@endpush



















@endsection
