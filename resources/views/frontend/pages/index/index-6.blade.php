@extends('frontend.layouts.default')
@section('content')
    <!-- seitenabhengig css -->
    @push('specific-css')
        <link href="{{ asset('frontend/css/home.css') }}" rel="stylesheet">
    @endpush

    <body>

        @include('frontend.includes.header-clearfix-element-to-stick')










        <div id="carousel-home">
            <div class="owl-carousel owl-theme">
                <div class="owl-slide cover" style="background-image: url(img/slides/slide_home_1.jpg);"><!-- /Would probably better not use LazyLoad fo the first item -->
                    <div class="opacity-mask d-flex align-items-center" data-opacity-mask="rgba(0, 0, 0, 0.5)">
                        <div class="container">
                            <div class="row justify-content-center justify-content-md-end">
                                <div class="col-lg-6 static">
                                    <div class="slide-text text-end white">
                                        <h2 class="owl-slide-animated owl-slide-title">Enjoy<br>unique food</h2>
                                        <p class="owl-slide-animated owl-slide-subtitle">
                                            Huge variery of food at the best price
                                        </p>
                                        <div class="owl-slide-animated owl-slide-cta"><a class="btn_1" href="grid-listing-filterscol.html" role="button">Read more</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/owl-slide-->
                <div class="owl-slide cover owl-lazy" data-src="img/slides/slide_home_2.jpg">
                    <div class="opacity-mask d-flex align-items-center" data-opacity-mask="rgba(0, 0, 0, 0.5)">
                        <div class="container">
                            <div class="row justify-content-center justify-content-md-start">
                                <div class="col-lg-6 static">
                                    <div class="slide-text white">
                                        <h2 class="owl-slide-animated owl-slide-title">Discover<br>and Order</h2>
                                        <p class="owl-slide-animated owl-slide-subtitle">
                                            The best restaurants at the best price
                                        </p>
                                        <div class="owl-slide-animated owl-slide-cta"><a class="btn_1" href="grid-listing-filterscol.html" role="button">Read more</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/owl-slide-->
                <div class="owl-slide cover owl-lazy" data-src="img/slides/slide_home_3.jpg">
                    <div class="opacity-mask d-flex align-items-center" data-opacity-mask="rgba(0, 0, 0, 0.6)">
                        <div class="container">
                            <div class="row justify-content-center justify-content-md-start">
                                <div class="col-lg-12 static">
                                    <div class="slide-text text-center white">
                                        <h2 class="owl-slide-animated owl-slide-title">Enjoy<br>a friends dinner</h2>
                                        <p class="owl-slide-animated owl-slide-subtitle">
                                            The best restaurants at the best price
                                        </p>
                                        <div class="owl-slide-animated owl-slide-cta"><a class="btn_1" href="grid-listing-filterscol.html" role="button">Read more</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/owl-slide-->
                </div>
            </div>
            <div id="icon_drag_mobile"></div>
            <div class="wave hero"></div>
        </div>
        <!--/carousel-->

        <div class="container margin_30_60">
            <div class="main_title center">
                <span><em></em></span>
                <h2>Popular Categories</h2>
                <p>Cum doctus civibus efficiantur in imperdiet deterruisset</p>
            </div>
            <!-- /main_title -->
            <div class="row small-gutters categories_grid">
                <div class="col-sm-12 col-md-6">
                    <a href="grid-listing-filterscol.html">
                        <img src="img/img_cat_home_placeholder.png" data-src="img/img_cat_home_1.jpg" alt="" class="img-fluid lazy">
                        <div class="wrapper">
                            <h2>Pizza - Italian</h2>
                            <p>115 Restaurants</p>
                        </div>
                    </a>
                </div>
                <div class="col-sm-12 col-md-6">
                    <div class="row small-gutters">
                        <div class="col-sm-6">
                            <a href="grid-listing-filterscol.html">
                                <img src="img/img_cat_home_placeholder.png" data-src="img/img_cat_home_2.jpg" alt="" class="img-fluid lazy">
                                <div class="wrapper">
                                    <h2>Sushi</h2>
                                    <p>150 Restaurants</p>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-6">
                            <a href="grid-listing-filterscol.html">
                                <img src="img/img_cat_home_placeholder.png" data-src="img/img_cat_home_3.jpg" alt="" class="img-fluid lazy">
                                <div class="wrapper">
                                    <h2>Burghers</h2>
                                    <p>90 Restaurants</p>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-12 margin">
                            <a href="grid-listing-filterscol.html">
                                <img src="img/img_cat_home_placeholder.png" data-src="img/img_cat_home_4.jpg" alt="" class="img-fluid lazy">
                                <div class="wrapper">
                                    <h2>Bakery Cakes</h2>
                                    <p>120 Restaurants</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!--/categories_grid-->
        </div>
        <!-- /container -->

        <div class="bg_gray">
            <div class="container margin_60">
                <div class="main_title">
                    <span><em></em></span>
                    <h2>Top Rated Restaurants</h2>
                    <p>Cum doctus civibus efficiantur in imperdiet deterruisset.</p>
                    <a href="#0">View All</a>
                </div>
                <div class="owl-carousel owl-theme carousel_4">
                    <div class="item">
                        <div class="strip">
                            <figure>
                                <span class="ribbon off">-30%</span>
                                <img src="img/lazy-placeholder.jpg" data-src="img/location_1.jpg" class="owl-lazy" alt="" width="460" height="310">
                                <a href="detail-restaurant.html" class="strip_info">
                                    <small>Pizza</small>
                                    <div class="item_title">
                                        <h3>Da Alfredo</h3>
                                        <small>27 Old Gloucester St</small>
                                    </div>
                                </a>
                            </figure>
                            <ul>
                                <li><span class="take yes">Take away</span> <span class="deliv yes">Delivery</span></li>
                                <li>
                                    <div class="score"><strong>8.9</strong></div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="item">
                        <div class="strip">
                            <figure>
                                <span class="ribbon off">-40%</span>
                                <img src="img/lazy-placeholder.jpg" data-src="img/location_2.jpg" class="owl-lazy" alt="" width="460" height="310">
                                <a href="detail-restaurant.html" class="strip_info">
                                    <small>Burghers</small>
                                    <div class="item_title">
                                        <h3>Best Burghers</h3>
                                        <small>27 Old Gloucester St</small>
                                    </div>
                                </a>
                            </figure>
                            <ul>
                                <li><span class="take yes">Take away</span> <span class="deliv yes">Delivery</span></li>
                                <li>
                                    <div class="score"><strong>7.5</strong></div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="item">
                        <div class="strip">
                            <figure>
                                <span class="ribbon off">-30%</span>
                                <img src="img/lazy-placeholder.jpg" data-src="img/location_3.jpg" class="owl-lazy" alt="" width="460" height="310">
                                <a href="detail-restaurant.html" class="strip_info">
                                    <small>Vegetarian</small>
                                    <div class="item_title">
                                        <h3>Vego Life</h3>
                                        <small>27 Old Gloucester St</small>
                                    </div>
                                </a>
                            </figure>
                            <ul>
                                <li><span class="take no">Take away</span> <span class="deliv yes">Delivery</span></li>
                                <li>
                                    <div class="score yes"><strong>8.9</strong></div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="item">
                        <div class="strip">
                            <figure>
                                <span class="ribbon off">-25%</span>
                                <img src="img/lazy-placeholder.jpg" data-src="img/location_4.jpg" class="owl-lazy" alt="" width="460" height="310">
                                <a href="detail-restaurant.html" class="strip_info">
                                    <small>Japanese</small>
                                    <div class="item_title">
                                        <h3>Sushi Temple</h3>
                                        <small>27 Old Gloucester St</small>
                                    </div>
                                </a>
                            </figure>
                            <ul>
                                <li><span class="take yes">Take away</span> <span class="deliv no">Delivery</span></li>
                                <li>
                                    <div class="score yes"><strong>8.9</strong></div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="item">
                        <div class="strip">
                            <figure>
                                <span class="ribbon off">-30%</span>
                                <img src="img/lazy-placeholder.jpg" data-src="img/location_5.jpg" class="owl-lazy" alt="" width="460" height="310">
                                <a href="detail-restaurant.html" class="strip_info">
                                    <small>Pizza</small>
                                    <div class="item_title">
                                        <h3>Auto Pizza</h3>
                                        <small>27 Old Gloucester St</small>
                                    </div>
                                </a>
                            </figure>
                            <ul>
                                <li><span class="take no">Take away</span> <span class="deliv yes">Delivery</span></li>
                                <li>
                                    <div class="score yes"><strong>8.9</strong></div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="item">
                        <div class="strip">
                            <figure>
                                <span class="ribbon off">-15%</span>
                                <img src="img/lazy-placeholder.jpg" data-src="img/location_6.jpg" class="owl-lazy" alt="" width="460" height="310">
                                <a href="detail-restaurant.html" class="strip_info">
                                    <small>Burghers</small>
                                    <div class="item_title">
                                        <h3>Alliance</h3>
                                        <small>27 Old Gloucester St</small>
                                    </div>
                                </a>
                            </figure>
                            <ul>
                                <li><span class="take yes">Take away</span> <span class="deliv yes">Delivery</span></li>
                                <li>
                                    <div class="score yes"><strong>8.9</strong></div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="item">
                        <div class="strip">
                            <figure>
                                <span class="ribbon off">-30%</span>
                                <img src="img/lazy-placeholder.jpg" data-src="img/location_7.jpg" class="owl-lazy" alt="" width="460" height="310">
                                <a href="detail-restaurant.html" class="strip_info">
                                    <small>Chinese</small>
                                    <div class="item_title">
                                        <h3>Alliance</h3>
                                        <small>27 Old Gloucester St</small>
                                    </div>
                                </a>
                            </figure>
                            <ul>
                                <li><span class="take no">Take away</span> <span class="deliv yes">Delivery</span></li>
                                <li>
                                    <div class="score yes"><strong>8.9</strong></div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /carousel -->
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
                                    <figure><img src="img/lazy-placeholder-100-100-white.png" data-src="img/how_1.svg" alt="" width="150" height="167" class="lazy"></figure>
                                    <h3>Easly Order</h3>
                                    <p>Faucibus ante, in porttitor tellus blandit et. Phasellus tincidunt metus lectus sollicitudin.</p>
                                </div>
                                <div class="box_how">
                                    <figure><img src="img/lazy-placeholder-100-100-white.png" data-src="img/how_2.svg" alt="" width="130" height="145" class="lazy"></figure>
                                    <h3>Quick Delivery</h3>
                                    <p>Maecenas pulvinar, risus in facilisis dignissim, quam nisi hendrerit nulla, id vestibulum.</p>
                                </div>
                            </div>
                            <div class="col-lg-6 align-self-center">
                                <div class="box_how">
                                    <figure><img src="img/lazy-placeholder-100-100-white.png" data-src="img/how_3.svg" alt="" width="150" height="132" class="lazy"></figure>
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




        @push('specific-scripts')

<script src="{{ asset('frontend/js/slider.js') }}"></script>
   @endpush



@endsection
