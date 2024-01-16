<header class="header black_nav clearfix element_to_stick">
    <div class="container">
        <div id="logo">
            <a href="{{ url('/') }}">
                <img src="{{ asset('frontend/img/logo_sticky.svg') }}" width="162" height="35" alt="">
            </a>
        </div>
        <div class="layer"></div><!-- Opacity Mask Menu Mobile -->
        <ul id="top_menu">
            <li><a href="#sign-in-dialog" id="sign-in" class="login">Sign In</a></li>
            <li><a href="#0" class="wishlist_bt_top" title="Your wishlist">Your wishlist</a></li>
        </ul>
        <!-- /top_menu -->
        <a href="#0" class="open_close">
            <i class="icon_menu"></i><span>Menu</span>
        </a>


        @include('frontend.includes.nav-all')


    </div>
</header>
<!-- /header -->
