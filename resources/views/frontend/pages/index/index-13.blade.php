@extends('frontend.layouts.default')
@section('content')
    <!-- seitenabhengig css -->
    @push('specific-css')
        <link href="{{ asset('frontend/css/home.css') }}" rel="stylesheet">
        <link href="{{ asset('frontend/css/vegas.min.css') }}" rel="stylesheet">
    @endpush

    <body>

        @include('frontend.includes.header-clearfix-element-to-stick')






        <div class="hero_single version_2 kenburns_slider" style="background: none;">
            <div class="opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.6)">
                <div class="container">
                    <div class="row justify-content-lg-start justify-content-md-center">
                        <div class="col-xl-7 col-lg-8">
                            <h1>Delivery or Takeaway Food</h1>
                            <p>The best restaurants at the best price</p>
                            <form method="post" action="grid-listing-filterscol.html">
                                <div class="row g-0 custom-search-input">
                                    <div class="col-lg-10">
                                        <div class="form-group">
                                            <input class="form-control no_border_r" type="text" placeholder="What are you looking for...">
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <button class="btn_1 gradient" type="submit">Search</button>
                                    </div>
                                </div>
                                <!-- /row -->
                                <div class="search_trends">
                                    <h5>Trending:</h5>
                                    <ul>
                                        <li><a href="#0">Sushi</a></li>
                                        <li><a href="#0">Burgher</a></li>
                                        <li><a href="#0">Chinese</a></li>
                                        <li><a href="#0">Pizza</a></li>
                                    </ul>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /row -->
                </div>
            </div>
            <div class="wave hero"></div>
        </div>
        <!-- /hero_single -->

        <div class="container margin_30_60">
            <div class="main_title center">
                <span><em></em></span>
                <h2>Popular Categories</h2>
                <p>Cum doctus civibus efficiantur in imperdiet deterruisset</p>
            </div>
            <!-- /main_title -->
            <div class="owl-carousel owl-theme categories_carousel">
                <div class="item_version_2">
                    <a href="grid-listing-filterscol.html">
                        <figure>
                            <span>98</span>
                            <img src="img/home_cat_placeholder.jpg" data-src="img/home_cat_pizza.jpg" alt="" class="owl-lazy" width="350" height="450">
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
                            <img src="img/home_cat_placeholder.jpg" data-src="img/home_cat_sushi.jpg" alt="" class="owl-lazy" width="350" height="450">
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
                            <img src="img/home_cat_placeholder.jpg" data-src="img/home_cat_hamburgher.jpg" alt="" class="owl-lazy" width="350" height="450">
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
                            <img src="img/home_cat_placeholder.jpg" data-src="img/home_cat_vegetarian.jpg" alt="" class="owl-lazy" width="350" height="450">
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
                            <img src="img/home_cat_placeholder.jpg" data-src="img/home_cat_bakery.jpg" alt="" class="owl-lazy" width="350" height="450">
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
                            <img src="img/home_cat_placeholder.jpg" data-src="img/home_cat_chinesse.jpg" alt="" class="owl-lazy" width="350" height="450">
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
                            <img src="img/home_cat_placeholder.jpg" data-src="img/home_cat_mexican.jpg" alt="" class="owl-lazy" width="350" height="450">
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

<!-- SPECIFIC SCRIPTS -->
<script src="{{ asset('frontend/js/vegas.min.js') }}"></script>
<script>
        $(function() {
        "use strict";
        $('.kenburns_slider').vegas({
            slides: [
                { src: 'img/slides/slide_home_1.jpg' },
                { src: 'img/slides/slide_home_2.jpg' },
                { src: 'img/slides/slide_home_3.jpg' }
            ],
            overlay: false,
                transition: 'fade2',
                animation: 'kenburnsUpRight',
                transitionDuration: 1000,
                delay: 4000,
                animationDuration: 70000
        });
    });
</script>
           @endpush






@endsection
