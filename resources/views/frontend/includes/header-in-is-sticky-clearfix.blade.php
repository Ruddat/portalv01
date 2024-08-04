<header class="header_in is_sticky clearfix">
    <div class="container-fluid">
        <div id="logo">
            <a href="index.html">
                <img src="{{ asset('frontend/img/logo_sticky.svg') }}" width="140" height="35" alt="">
            </a>
        </div>
        <div class="layer"></div><!-- Opacity Mask Menu Mobile -->

            <ul id="top_menu" class="drop_user">
                @if (Auth::guard('client')->check())
                <!-- If the client is authenticated, show the dropdown menu -->
                <li>
                    <div class="dropdown user clearfix">
                        <a href="#" data-bs-toggle="dropdown" aria-expanded="false" class="">
                            <figure><img src="{{ Auth::guard('client')->user()->avatar }}" alt=""></figure><span>{{ Auth::guard('client')->user()->name }}</span>
                        </a>
                        <div class="dropdown-menu" style="">
                            <div class="dropdown-menu-content">
                                <ul>
                                    <li><a href="{{ route('client.dashboard') }}"><i class="icon_cog"></i>Dashboard</a></li>
                                    <li><a href="#"><i class="icon_document"></i>Bookings</a></li>
                                    <li><a href="#"><i class="icon_heart"></i>Wish List</a></li>
                                    <li><a href="{{ route('client.logout-handler') }}"><i class="icon_key"></i>Log out</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- /dropdown -->
                </li>
                @else
                <!-- If the client is not authenticated, show the sign-in and wishlist links -->
                <li><a href="#sign-in-dialog" id="sign-in" class="login">Sign In</a></li>
                <li><a href="#0" class="wishlist_bt_top" title="Your wishlist">Your wishlist</a></li>
                @endif
            </ul>

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
