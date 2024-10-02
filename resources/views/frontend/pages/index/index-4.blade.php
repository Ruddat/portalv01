@extends('frontend.layouts.default')
@section('content')
    <!-- seitenabhengig css -->
    @push('specific-css')
        <link href="{{ asset('frontend/css/home.css') }}" rel="stylesheet">
        <link href="{{ asset('frontend/css/custom/index.css') }}" rel="stylesheet">
        <link href="{{ asset('frontend/css/custom/sozialproof.css') }}" rel="stylesheet">
    @endpush

    <body>

        @include('frontend.includes.header-clearfix-element-to-stick')

        <div class="header-video">
            <div id="hero_video">
                <div class="shape_element one"></div>
                <div class="shape_element two"></div>
                <div class="opacity-mask d-flex align-items-center" data-opacity-mask="rgba(0, 0, 0, 0.6)">
                    <div class="container">
                        <div class="row justify-content-center text-center">
                            <div class="col-xl-7 col-lg-8 col-md-8">
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
                                <div class="search_trends">
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
                    </div>
                </div>
            </div>
            <img src="{{ asset('frontend/img/video_fix.png') }}" alt="" class="header-video--media" data-video-src="video/intro" data-teaser-source="video/intro" data-provider="" data-video-width="1920" data-video-height="960">
            <div class="wave hero"></div>
        </div>
        <!-- /header-video -->

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

        <div class="shape_element_2">
            <div class="container margin_60_0">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="box_how">
                                    <figure><img src="{{ asset('frontend/img/lazy-placeholder-100-100-white.png') }}" data-src="{{ asset('frontend/img/how_1.svg') }}" alt="" width="150" height="167" class="lazy"></figure>
                                    <h3>Easly Order</h3>
                                    <p>Faucibus ante, in porttitor tellus blandit et. Phasellus tincidunt metus lectus sollicitudin.</p>
                                </div>
                                <div class="box_how">
                                    <figure><img src="{{ asset('frontend/img/lazy-placeholder-100-100-white.png') }}" data-src="{{ asset('frontend/img/how_2.svg') }}" alt="" width="130" height="145" class="lazy"></figure>
                                    <h3>Quick Delivery</h3>
                                    <p>Maecenas pulvinar, risus in facilisis dignissim, quam nisi hendrerit nulla, id vestibulum.</p>
                                </div>
                            </div>
                            <div class="col-lg-6 align-self-center">
                                <div class="box_how">
                                    <figure><img src="{{ asset('frontend/img/lazy-placeholder-100-100-white.png') }}" data-src="{{ asset('frontend/img/how_3.svg') }}" alt="" width="150" height="132" class="lazy"></figure>
                                    <h3>Enjoy Food</h3>
                                    <p>Morbi convallis bibendum urna ut viverra. Maecenas quis consequat libero, a feugiat eros.</p>
                                </div>
                            </div>
                        </div>
                        <p class="text-center mt-3 d-block d-lg-none"><a href="#0" class="btn_1 medium gradient pulse_bt mt-2">Register Now!</a></p>
                    </div>
                    <div class="col-lg-5 offset-lg-1 align-self-center">
                        <div class="intro_txt">
                            <div class="main_title">
                                <span><em></em></span>
                                <h2>Start Ordering Now</h2>
                            </div>
                            <p class="lead">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed imperdiet libero id nisi euismod, sed porta est consectetur deserunt.</p>
                            <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                            <p><a href="#0" class="btn_1 medium gradient pulse_bt mt-2">Register</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /shape_element_2 -->

        @include('frontend.includes.page-snipped.broker-seller')


        @push('specific-scripts')
<!-- Video header -->
<script src="{{ asset('frontend/js/modernizr.min.js') }}"></script>
<script src="{{ asset('frontend/js/video_header.min.js') }}"></script>

<script>
    HeaderVideo.init({
        container: $('.header-video'),
        header: $('.header-video--media'),
        videoTrigger: $("#video-trigger"),
        autoPlayVideo: true
    });
</script>



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
<script>
function initMap() {
    var input = document.getElementById('autocomplete');
    var autocomplete = new google.maps.places.Autocomplete(input);

    autocomplete.addListener('place_changed', function() {
        var place = autocomplete.getPlace();
        if (!place.geometry) {
            window.alert("Autocomplete's returned place contains no geometry");
            return;
        }

        var address = '';
        if (place.address_components) {
            address = [
                (place.address_components[0] && place.address_components[0].short_name || ''),
                (place.address_components[1] && place.address_components[1].short_name || ''),
                (place.address_components[2] && place.address_components[2].short_name || '')
            ].join(' ');
        }
    });
}
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places&callback=initMap"></script>
        @endpush
    @endsection
