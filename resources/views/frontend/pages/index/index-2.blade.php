@extends('frontend.layouts.default')
@section('content')
    <!-- seitenabhengig css -->
    @push('specific-css')
        <link href="{{ asset('frontend/css/home.css') }}" rel="stylesheet">
    @endpush

    <body>

        @include('frontend.includes.headerblack')



        <div class="hero_single version_1">
            <div class="opacity-mask">
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

        <div class="shape_element_2">
            <div class="container margin_30_40">
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
                    </div>
                    <div class="col-lg-5 offset-lg-1 align-self-center">
                        <div class="intro_txt">
                            <div class="main_title">
                                <span><em></em></span>
                                <h2>How FooYes Works</h2>
                            </div>
                            <p class="lead">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed imperdiet libero id nisi euismod, sed porta est consectetur deserunt.</p>
                            <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                            <p><a href="https://www.youtube.com/watch?v=MO7Hi_kBBBg" class="btn_1 medium gradient pulse_bt plus_icon btn_play mt-2">Play Promo Video<i class="arrow_triangle-right"></i></a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /shape_element_2 -->

        <div class="bg_gray">
            <div class="container margin_60">
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
                                <img src="{{ asset('frontend/img/home_cat_placeholder.jpg') }}" data-src="{{ asset('frontend/img/home_cat_pizza.jpg') }}" alt="" class="owl-lazy" width="350" height="450">
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
                                <img src="{{ asset('frontend/img/home_cat_placeholder.jpg') }}" data-src="{{ asset('frontend/img/home_cat_sushi.jpg') }}" alt="" class="owl-lazy" width="350" height="450">
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
                                <img src="{{ asset('frontend/img/home_cat_placeholder.jpg') }}" data-src="{{ asset('frontend/img/home_cat_hamburgher.jpg') }}" alt="" class="owl-lazy" width="350" height="450">
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
                                <img src="{{ asset('frontend/img/home_cat_placeholder.jpg') }}" data-src="{{ asset('frontend/img/home_cat_vegetarian.jpg') }}" alt="" class="owl-lazy" width="350" height="450">
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
                                <img src="{{ asset('frontend/img/home_cat_placeholder.jpg') }}" data-src="{{ asset('frontend/img/home_cat_bakery.jpg') }}" alt="" class="owl-lazy" width="350" height="450">
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
                                <img src="{{ asset('frontend/img/home_cat_placeholder.jpg') }}" data-src="{{ asset('frontend/img/home_cat_chinesse.jpg') }}" alt="" class="owl-lazy" width="350" height="450">
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
                                <img src="{{ asset('frontend/img/home_cat_placeholder.jpg') }}" data-src="{{ asset('frontend/img/home_cat_mexican.jpg') }}" alt="" class="owl-lazy" width="350" height="450">
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
        </div>
        <!-- /bg_gray -->

        <div class="container margin_60_0">
            <div class="row justify-content-center">
                <div class="col-xl-9">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="box_info_1 pr-lg-3">
                                <div class="wrapper_img">
                                    <figure><img src="{{ asset('frontend/img/lazy-placeholder-600-400.png') }}" data-src="{{ asset('frontend/img/submit_restaurant_home.jpg') }}" alt="" class="img-fluid lazy"></figure><span></span>
                                </div>
                                <h3>Add Your Restaurant</h3>
                                <p>Neque sodales ut etiam sit amet nisl purus in. Et leo duis ut diam. Tristique senectus et netus et malesuada. Est ultricies integer quis auctor elit.</p>
                                <a href="#0"><strong>Read more &rarr;</strong></a>
                            </div>
                        </div>
                        <div class="col-md-6 ">
                            <div class="box_info_1 pl-lg-3">
                                <div class="wrapper_img">
                                    <figure><img src="{{ asset('frontend/img/lazy-placeholder-600-400.png') }}" data-src="{{ asset('frontend/img/submit_rider_home.jpg') }}" alt="" class="img-fluid lazy"></figure><span></span>
                                </div>
                                <h3>Become a Rider</h3>
                                <p>Pharetra diam sit amet nisl suscipit adipiscing bibendum est ultricies. Diam maecenas ultricies mi eget mauris pharetra et ultrices neque. Id leo in vitae massa sed duis diam.</p>
                                <a href="#0"><strong>Read more &rarr;</strong></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /container -->


    @endsection
