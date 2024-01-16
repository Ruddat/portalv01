@extends('frontend.layouts.default')
@section('content')
    <!-- seitenabhengig css -->
    @push('specific-css')

        <!-- REVOLUTION SLIDER CSS -->
        <link rel="stylesheet" type="text/css" href="{{ asset('frontend/revolution-slider/fonts/font-awesome/css/font-awesome.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('frontend/revolution-slider/css/settings.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('frontend/revolution-slider/css/layers.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('frontend/revolution-slider/css/navigation.css') }}">

            <!-- SPECIFIC CSS -->
        <link href="{{ asset('frontend/css/home.css') }}" rel="stylesheet">
    @endpush

    <body>

        @include('frontend.includes.header-clearfix-element-to-stick')




        <!-- START SLIDER -->
        <div id="rev_slider_44_wrapper" class="rev_slider_wrapper fullscreen-container" data-alias="mask-showcase" data-source="gallery">
            <!-- Start revolution slider 5.4.8 fullscreen mode -->
            <div id="rev_slider_44" class="rev_slider fullscreenbanner" style="display:none;" data-version="5.4.8">
                <ul>
                    <!-- start slide 01 -->
                    <li data-index="rs-73" data-transition="zoomout" data-slotamount="default" data-hideafterloop="0" data-hideslideonmobile="off" data-easein="Power3.easeInOut" data-easeout="Power3.easeInOut" data-masterspeed="1500"  data-rotate="0"  data-saveperformance="off"  data-title="01" data-param1="01" data-description="">
                        <!-- main image -->
                        <img src="revolution-slider/assets/images/slide_1.jpg" alt="" data-bgcolor="#ccc" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" data-bgparallax="off" class="rev-slidebg" data-no-retina>

                        <div class="rev-slider-mask"></div>

                        <!-- main text layer -->
                        <div class="tp-caption tp-resizeme text-center"
                             id="slide-411-layer-01"
                             data-frames='[{"delay":200,"speed":2000,"frame":"0","from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;","mask":"x:0px;y:[-100%];s:inherit;e:inherit;","to":"o:1;","ease":"Power2.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'
                             data-type="text"
                             data-whitespace="nowrap"
                             data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']"
                             data-y="['middle','middle','middle','middle']" data-voffset="['-50','-50','-115','-65']"
                             data-width="auto"
                             data-height="auto"
                             data-fontsize="['70','53','60','35']"
                             data-lineheight="['70','59','70','39']"
                             data-letterspacing="['-2','-1','-1','-1']"
                             data-responsive="off"
                             data-responsive_offset="off"
                             data-paddingtop="['0','0','0','0']"
                             data-paddingbottom="['15','8','8','8']"
                             data-paddingright="['0','0','0','0']"
                             data-paddingleft="['0','0','0','0']"
                             style="text-shadow: 0 0 20px rgba(0,0,0,0.3); font-weight: 600; color:#fff;">Start to Enjoy <br>unique food</div>

                        <!-- small text layer -->
                        <div class="tp-caption tp-resizeme text-center"
                             id="slide-411-layer-02"
                             data-frames='[{"delay":1200,"speed":1000,"frame":"0","from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;","mask":"x:0px;y:[-100%];s:inherit;e:inherit;","to":"o:1;","ease":"Power2.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'
                             data-type="text"
                             data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']"
                             data-y="['middle','middle','middle','middle']" data-voffset="['65','100','-5','15']"
                             data-width="auto"
                             data-height="auto"
                             data-fontsize="['21','16','19','14']"
                             data-lineheight="['28','14','23','20']"
                             data-letterspacing="['0.5','0.5','0.5','0.5']"
                             data-responsive="off"
                             data-responsive_offset="on" style="color: #fff;">The best restaurants at the best price
                        </div>

                        <!-- btn layer -->
                        <div class="tp-caption tp-resizeme btn_1"
                           data-actions='[{"event":"click","action":"scrollbelow","offset":"-49px","delay":"","speed":"300","ease":"Linear.easeNone"}]'
                           id="slide-411-layer-03"
                           data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']"
                           data-y="['middle','middle','middle','middle']" data-voffset="['152','130','82','80']"
                           data-whitespace="nowrap"
                           data-type="button"
                           data-responsive="off"
                           data-responsive_offset="off"
                           data-frames='[{"delay":1200,"speed":1000,"frame":"0","from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;","mask":"x:0px;y:[-100%];s:inherit;e:inherit;","to":"o:1;","ease":"Power2.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'
                           data-textAlign="['center','center','center','center']" style="line-height: 1; padding: 15px 20px; font-size: 16px;font-weight: 500;">Get Started Now
                        </div>
                    </li>
                    <!-- end slide 01 -->
                    <!-- start slide 02 -->
                    <li data-index="rs-74" data-transition="fadetotopfadefrombottom" data-slotamount="default" data-hideafterloop="0" data-hideslideonmobile="off" data-easein="Power3.easeInOut" data-easeout="Power3.easeInOut" data-masterspeed="1500"  data-rotate="0"  data-saveperformance="off"  data-title="02" data-param1="02" data-description="">
                        <!-- main image -->
                        <img src="revolution-slider/assets/images/slide_2.jpg" alt="" data-bgcolor="#ccc" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" data-bgparallax="off" class="rev-slidebg" data-no-retina>

                        <div class="rev-slider-mask" style="opacity: 0.5"></div>

                        <!-- main text layer -->
                        <div class="tp-caption tp-resizeme alt-font font-weight-600 text-center"
                             id="slide-411-layer-04"
                             data-frames='[{"delay":200,"speed":2000,"frame":"0","from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;","mask":"x:0px;y:[-100%];s:inherit;e:inherit;","to":"o:1;","ease":"Power2.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'
                             data-type="text"
                             data-whitespace="nowrap"
                             data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']"
                             data-y="['middle','middle','middle','middle']" data-voffset="['-50','-50','-115','-65']"
                             data-width="auto"
                             data-height="auto"
                             data-fontsize="['70','53','60','35']"
                             data-lineheight="['70','59','70','39']"
                             data-letterspacing="['-2','-1','-1','-1']"
                             data-responsive="off"
                             data-responsive_offset="off"
                             data-paddingtop="['0','0','0','0']"
                             data-paddingbottom="['15','8','8','8']"
                             data-paddingright="['0','0','0','0']"
                             data-paddingleft="['0','0','0','0']"
                             style="text-shadow: 0 0 20px rgba(0,0,0,0.3); font-weight: 600; color: #fff;">Discover<br> and Reserve</div>

                        <!-- small text layer -->
                        <div class="tp-caption tp-resizeme text-white text-center"
                             id="slide-411-layer-05"
                             data-frames='[{"delay":1200,"speed":1000,"frame":"0","from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;","mask":"x:0px;y:[-100%];s:inherit;e:inherit;","to":"o:1;","ease":"Power2.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'
                             data-type="text"
                             data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']"
                             data-y="['middle','middle','middle','middle']" data-voffset="['65','100','-5','15']"
                             data-width="auto"
                             data-height="auto"
                             data-fontsize="['21','13','19','14']"
                             data-lineheight="['28','14','23','20']"
                             data-letterspacing="['0.5','0.5','0.5','0.5']"
                             data-responsive="off"
                             data-responsive_offset="on" style="color: #fff;">The best restaurants at the best price
                         </div>

                        <!-- btn layer -->
                        <div class="tp-caption tp-resizeme btn_1"
                           data-actions='[{"event":"click","action":"scrollbelow","offset":"-49px","delay":"","speed":"300","ease":"Linear.easeNone"}]'
                           id="slide-411-layer-06"
                           data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']"
                           data-y="['middle','middle','middle','middle']" data-voffset="['152','130','82','80']"
                           data-whitespace="nowrap"
                           data-type="button"
                           data-responsive="off"
                           data-responsive_offset="off"
                           data-frames='[{"delay":1200,"speed":1000,"frame":"0","from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;","mask":"x:0px;y:[-100%];s:inherit;e:inherit;","to":"o:1;","ease":"Power2.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'
                           data-textAlign="['center','center','center','center']" style="line-height: 1; padding: 15px 20px; font-size: 16px;font-weight: 500;">Get Started Now
                        </div>
                    </li>
                    <!-- end slide 02 -->
                    <!-- start slide 03 -->
                    <li data-index="rs-75" data-transition="fadetotopfadefrombottom" data-slotamount="default" data-hideafterloop="0" data-hideslideonmobile="off" data-easein="Power3.easeInOut" data-easeout="Power3.easeInOut" data-masterspeed="1500"  data-rotate="0"  data-saveperformance="off"  data-title="03" data-param1="03" data-description="">
                        <!-- main image -->
                        <img src="revolution-slider/assets/images/slide_3.jpg" alt="" data-bgcolor="#ccc" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" data-bgparallax="off" class="rev-slidebg" data-no-retina>

                        <div class="rev-slider-mask" style="opacity: 0.6"></div>

                        <!-- main text layer -->
                        <div class="tp-caption tp-resizeme text-white text-center"
                             id="slide-411-layer-07"
                             data-frames='[{"delay":200,"speed":2000,"frame":"0","from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;","mask":"x:0px;y:[-100%];s:inherit;e:inherit;","to":"o:1;","ease":"Power2.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'
                             data-type="text"
                             data-whitespace="nowrap"
                             data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']"
                             data-y="['middle','middle','middle','middle']" data-voffset="['-50','-50','-115','-65']"
                             data-width="auto"
                             data-height="auto"
                             data-fontsize="['70','53','60','35']"
                             data-lineheight="['70','59','70','39']"
                             data-letterspacing="['-2','-1','-1','-1']"
                             data-responsive="off"
                             data-responsive_offset="off"
                             data-paddingtop="['0','0','0','0']"
                             data-paddingbottom="['15','8','8','8']"
                             data-paddingright="['0','0','0','0']"
                             data-paddingleft="['0','0','0','0']"
                             style="text-shadow: 0 0 20px rgba(0,0,0,0.3); font-weight: 600;color: #fff;">Finally...<br> it's time to relax</div>

                        <!-- small text layer -->
                        <div class="tp-caption tp-resizeme alt-font text-white font-weight-300 text-center"
                             id="slide-411-layer-08"
                             data-frames='[{"delay":1200,"speed":1000,"frame":"0","from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;","mask":"x:0px;y:[-100%];s:inherit;e:inherit;","to":"o:1;","ease":"Power2.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'
                             data-type="text"
                             data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']"
                             data-y="['middle','middle','middle','middle']" data-voffset="['65','100','-5','15']"
                             data-width="auto"
                             data-height="auto"
                             data-fontsize="['21','13','19','14']"
                             data-lineheight="['28','14','23','20']"
                             data-letterspacing="['0.5','0.5','0.5','0.5']"
                             data-responsive="off"
                             data-responsive_offset="on" style="color: #fff;">The best restaurants at the best price
                         </div>

                        <!-- btn layer -->
                        <div class="tp-caption tp-resizeme btn_1"
                           data-actions='[{"event":"click","action":"scrollbelow","offset":"-49px","delay":"","speed":"300","ease":"Linear.easeNone"}]'
                           id="slide-411-layer-09"
                           data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']"
                           data-y="['middle','middle','middle','middle']" data-voffset="['152','130','82','80']"
                           data-whitespace="nowrap"
                           data-type="button"
                           data-responsive="off"
                           data-responsive_offset="off"
                           data-frames='[{"delay":1200,"speed":1000,"frame":"0","from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;","mask":"x:0px;y:[-100%];s:inherit;e:inherit;","to":"o:1;","ease":"Power2.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'
                           data-textAlign="['center','center','center','center']" style="line-height: 1; padding: 15px 20px; font-size: 16px;font-weight: 500;">Get Started Now
                        </div>
                    </li>
                    <!-- end slide 01 -->
                </ul>
            </div>
        </div>
<!-- END REVOLUTION SLIDER -->

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
    <div class="container margin_60_40">
        <div class="main_title">
            <span><em></em></span>
            <h2>Top Rated Restaurants</h2>
            <p>Cum doctus civibus efficiantur in imperdiet deterruisset.</p>
            <a href="#0">View All &rarr;</a>
        </div>
        <div class="row add_bottom_25">
            <div class="col-lg-6">
                <div class="list_home">
                    <ul>
                        <li>
                            <a href="detail-restaurant.html">
                                <figure>
                                    <img src="img/location_list_placeholder.png" data-src="img/location_list_1.jpg" alt="" class="lazy" width="350" height="233">
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
                                    <img src="img/location_list_placeholder.png" data-src="img/location_list_2.jpg" alt="" class="lazy" width="350" height="233">
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
                                    <img src="img/location_list_placeholder.png" data-src="img/location_list_3.jpg" alt="" class="lazy" width="350" height="233">
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
                                    <img src="img/location_list_placeholder.png" data-src="img/location_list_4.jpg" alt="" class="lazy" width="350" height="233">
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
                                    <img src="img/location_list_placeholder.png" data-src="img/location_list_5.jpg" alt="" class="lazy" width="350" height="233">
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
                                    <img src="img/location_list_placeholder.png" data-src="img/location_list_6.jpg" alt="" class="lazy" width="350" height="233">
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
        <div class="banner lazy" data-bg="url(img/banner_bg_desktop.jpg)">
            <div class="wrapper d-flex align-items-center opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.3)">
                <div>
                    <small>FooYes Delivery</small>
                    <h3>We Deliver to your Office</h3>
                    <p>Enjoy a tasty food in minutes!</p>
                    <a href="grid-listing-filterscol.html" class="btn_1 gradient">Start Now!</a>
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

<!-- SLIDER REVOLUTION SCRIPTS  -->
<script src="{{ asset('frontend/revolution-slider/js/jquery.themepunch.tools.min.js') }}"></script>
<script src="{{ asset('frontend/revolution-slider/js/jquery.themepunch.revolution.min.js') }}"></script>
<script src="{{ asset('frontend/revolution-slider/js/extensions/revolution.extension.actions.min.js') }}"></script>
<script src="{{ asset('frontend/revolution-slider/js/extensions/revolution.extension.carousel.min.js') }}"></script>
<script src="{{ asset('frontend/revolution-slider/js/extensions/revolution.extension.kenburn.min.js') }}"></script>
<script src="{{ asset('frontend/revolution-slider/js/extensions/revolution.extension.layeranimation.min.js') }}"></script>
<script src="{{ asset('frontend/revolution-slider/js/extensions/revolution.extension.migration.min.js') }}"></script>
<script src="{{ asset('frontend/revolution-slider/js/extensions/revolution.extension.navigation.min.js') }}"></script>
<script src="{{ asset('frontend/revolution-slider/js/extensions/revolution.extension.parallax.min.js') }}"></script>
<script src="{{ asset('frontend/revolution-slider/js/extensions/revolution.extension.slideanims.min.js') }}"></script>
<script src="{{ asset('frontend/revolution-slider/js/extensions/revolution.extension.video.min.js') }}"></script>
<script>
var tpj = jQuery;

var revapi44;
tpj(document).ready(function() {
    if (tpj("#rev_slider_44").revolution == undefined) {
        revslider_showDoubleJqueryError("#rev_slider_44");
    } else {
        revapi44 = tpj("#rev_slider_44").show().revolution({
            sliderType: "standard",
            jsFileLocation: "revolution-slider/js/",
            sliderLayout: "fullscreen",
            dottedOverlay: "none",
            delay: 4500,
            navigation: {
                keyboardNavigation: "on",
                keyboard_direction: "horizontal",
                mouseScrollNavigation: "off",
                mouseScrollReverse: "default",
                onHoverStop: "off",
                touch: {
                    touchenabled: "on",
                    touchOnDesktop: "on",
                    swipe_threshold: 75,
                    swipe_min_touches: 1,
                    swipe_direction: "horizontal",
                    drag_block_vertical: false
                },
                arrows: {
                    enable: true,
                    style: 'erinyen',
                    tmp: '',
                    rtl: false,
                    hide_onleave: true,
                    hide_onmobile: true,
                    hide_under: 767,
                    hide_over: 9999,
                    hide_delay: 0,
                    hide_delay_mobile: 0,

                    left: {
                        container: 'slider',
                        h_align: 'left',
                        v_align: 'center',
                        h_offset: 60,
                        v_offset: 0
                    },

                    right: {
                        container: 'slider',
                        h_align: 'right',
                        v_align: 'center',
                        h_offset: 60,
                        v_offset: 0
                    }
                },
                bullets: {
                    enable: true,
                    style: 'zeus',
                    direction: 'horizontal',
                    rtl: false,

                    container: 'slider',
                    h_align: 'center',
                    v_align: 'bottom',
                    h_offset: 0,
                    v_offset: 30,
                    space: 7,

                    hide_onleave: false,
                    hide_onmobile: false,
                    hide_under: 0,
                    hide_over: 767,
                    hide_delay: 200,
                    hide_delay_mobile: 1200
                },
            },
            responsiveLevels: [1240, 1025, 778, 480],
            visibilityLevels: [1920, 1500, 1025, 768],
            gridwidth: [1200, 991, 778, 480],
            gridheight: [1025, 1366, 1025, 868],
            lazyType: "none",
            shadow: 0,
            spinner: "spinner4",
            stopLoop: "off",
            stopAfterLoops: -1,
            stopAtSlide: -1,
            shuffle: "off",
            autoHeight: "on",
            fullScreenAutoWidth: "on",
            fullScreenAlignForce: "off",
            fullScreenOffsetContainer: "",
            disableProgressBar: "on",
            hideThumbsOnMobile: "on",
            hideSliderAtLimit: 0,
            hideCaptionAtLimit: 0,
            hideAllCaptionAtLimit: 0,
            debugMode: false,
            fallbacks: {
                simplifyAll: "off",
                nextSlideOnWindowFocus: "off",
                disableFocusListener: false,
            }
        });
    }
});
</script>
   @endpush










@endsection
