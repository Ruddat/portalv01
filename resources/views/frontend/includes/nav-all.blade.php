<nav class="main-menu">
    <div id="header_menu">
        <a href="#0" class="open_close">
            <i class="icon_close"></i><span>{{ app(\App\Services\TranslationService::class)->trans('Menu', app()->getLocale()) }}</span>
        </a>
        <a href="{{ url('/') }}"><img src="{{ asset('frontend/img/logo.svg') }}" width="162" height="35" alt=""></a>
    </div>
    <ul>
        <li class="submenu">
            <a href="#0" class="show-submenu">{{ app(\App\Services\TranslationService::class)->trans('Home', app()->getLocale()) }}</a>
            <ul>
                <li><a href="{{ url('/index-13') }}">KenBurns Slider <strong>New!</strong></a></li>
                <li><a href="{{ url('/') }}">Address Autocomplete</a></li>
                <li><a href="{{ url('/index-2') }}">Search by Keyword</a></li>
                <li><a href="{{ url('/index-3') }}">Home Version 2</a></li>
                <li><a href="{{ url('/index-4') }}">Video Bg Fallback Mobile</a></li>
                <li class="third-level"><a href="#0">Sliders - Parallax <strong>New!</strong></a>
                    <ul>
                        <li><a href="{{ url('/index-6') }}">Owl Carousel</a></li>
                        <li><a href="{{ url('/index-7') }}">Revolution Slider 1</a></li>
                        <li><a href="{{ url('/index-8') }}">Revolution Slider 2</a></li>
                        <li><a href="{{ url('/index-9') }}">Youtube/Vimeo Parallax</a></li>
                        <li><a href="{{ url('/index-10') }}">MP4 Video Parallax</a></li>
                        <li><a href="{{ url('/index-11') }}">Parallax Image</a></li>
                    </ul>
                </li>
                <li><a href="{{ url('/index-12') }}">Text Rotator <strong>New!</strong></a></li>
                <li><a href="{{ url('/index-5') }}">GDPR Cookie Bar EU Law</a></li>
                <li><a href="header-user-logged.html">Header User Logged</a></li>
                <li><a href="header-cart-top.html">Header Cart Top</a></li>
                <li><a href="modal-advertise.html">Modal 1 Cookie Session</a></li>
                <li><a href="modal-newsletter.html">Modal 2 Cookie Session</a></li>
            </ul>
        </li>
        <li class="submenu">
            <a href="#0" class="show-submenu">{{ app(\App\Services\TranslationService::class)->trans('Listing', app()->getLocale()) }}</a>
            <ul>
                <li class="third-level"><a href="#0">List pages</a>
                    <ul>
                        <li><a href="{{ url('/grid-listing-filterscol') }}">List default</a></li>
                        <li><a href="{{ url('/grid-listing-filterscol-map') }}">List with map</a></li>
                        <li><a href="{{ url('/listing-map') }}">List side map</a></li>
                        <li><a href="{{ url('/grid-listing-masonry') }}">List Masonry Filter</a></li>
                    </ul>
                </li>
                <li class="third-level"><a href="#0">Detail pages</a>
                    <ul>
                        <li><a href="{{ url('/detail-restaurant') }}">Detail page 1</a></li>
                        <li><a href="{{ url('/detail-restaurant-2') }}">Detail page 2</a></li>
                        <li><a href="{{ url('/detail-restaurant-3') }}">Detail page 3</a></li>
                        <li><a href="{{ url('/detail-restaurant-4') }}">Detail page 4</a></li>
                    </ul>
                </li>
                <li class="third-level"><a href="#0">OpenStreetMap</a>
                    <ul>
                        <li><a href="{{ url('/grid-listing-filterscol-openstreetmap') }}">List with map</a></li>
                        <li><a href="{{ url('/listing-map-openstreetmap') }}">List side map</a></li>
                        <li><a href="{{ url('/grid-listing-masonry-openstreetmap') }}">List Masonry Filter</a></li>
                    </ul>
                </li>
                <li><a href="{{ url('/submit-restaurant') }}">{{ app(\App\Services\TranslationService::class)->trans('Submit Restaurant', app()->getLocale()) }}</a></li>
                <li><a href="submit-rider.html">Submit Rider</a></li>
                <li><a href="{{ url('/order-details') }}">Order</a></li>
                <li><a href="{{ url('/confirm-order') }}">Confirm Order</a></li>
            </ul>
        </li>
        <li class="submenu">
            <a href="#0" class="show-submenu">Other Pages</a>
           <ul>
            <li><a href="admin_section/index.html" target="_blank">Admin Section</a></li>
            <li><a href="404.html">404 Error</a></li>
            <li><a href="help.html">Help and Faq</a></li>
            <li><a href="{{ url('/blog') }}">Blog</a></li>
            <li><a href="{{ url('/leave-review') }}">Leave a review</a></li>
            <li><a href="{{ url('/contacts') }}">Contacts</a></li>
            <li><a href="coming_soon/index.html">Coming Soon</a></li>
            <li><a href="{{ url('/login') }}">Sign In</a></li>
            <li><a href="{{ url('/register') }}">Sign Up</a></li>
            <li><a href="icon-pack-1.html">Icon Pack 1</a></li>
            <li><a href="icon-pack-2.html">Icon Pack 2</a></li>
            <li><a href="shortcodes.html">Shortcodes</a></li>
        </ul>
        </li>
        <li><a href="{{ url('/submit-restaurant') }}">{{ app(\App\Services\TranslationService::class)->trans('Submit Restaurant', app()->getLocale()) }}</a></li>
    </ul>
</nav>
