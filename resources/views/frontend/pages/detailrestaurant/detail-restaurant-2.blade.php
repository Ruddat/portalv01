@extends('frontend.layouts.default')
@section('content')
    <!-- seitenabhengig css -->
    @push('specific-css')
        <link href="{{ asset('frontend/css/detail-page.css') }}" rel="stylesheet">
    @endpush

    <body data-spy="scroll" data-bs-target="#secondary_nav" data-offset="75">

        @include('frontend.includes.header-in-clearfix')




        <div class="hero_in detail_page background-image"
            data-background="url({{ asset('frontend/img/hero_general_2.jpg') }})">
            <div class="wrapper opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.5)">
                <div class="container">
                    <div class="main_info">
                        <div class="row">
                            <div class="col-xl-4 col-lg-5 col-md-6">
                                <div class="head">
                                    <img src="{{ $restaurant->logo_url }}" alt="Restaurant Logo" style="max-width: 100px; border-radius: 10px;">

                                    <div class="neon-sign">
                                        <span class="open-text">Open</span>
                                      </div>

                                <div class="score"><span>
                                    @if ($overallRating !== null)
                                    @php
                                        $ratingText = ($overallRating >= 8.5) ? 'Best' : (($overallRating >= 7) ? 'Superb' : (($overallRating >= 5) ? 'Good' : 'Average'));
                                    @endphp
                                    <div>{{ $ratingText }}</div>
                                @else
                                    <div>No reviews yet</div>
                                @endif
                            <em>{{ $numberOfRatings }} Reviews</em></span><strong>{{ number_format($overallRating, 1) }}</strong></div>
                            </div>
								<h1>{{ $restaurant->title }}</h1>
								{{ $restaurant->street }} - {{ $restaurant->city }}, {{ $restaurant->zip }} - <a href="https://www.google.com/maps/dir/{{ $restaurant->lat }},{{ $restaurant->lng }}/{{ urlencode($restaurant->title) }}" target="_blank">Get directions to {{ $restaurant->title }}</a>


							</div>
							<div class="col-xl-8 col-lg-7 col-md-6 position-relative">
								<div class="buttons clearfix">
									<span class="magnific-gallery">
										<a href="{{ asset('frontend/img/detail_1.jpg') }}" class="btn_hero" title="Photo title" data-effect="mfp-zoom-in"><i class="icon_image"></i>View photos</a>
										<a href="{{ asset('frontend/img/detail_2.jpg') }}" title="Photo title" data-effect="mfp-zoom-in"></a>
										<a href="{{ asset('frontend/img/detail_3.jpg') }}" title="Photo title" data-effect="mfp-zoom-in"></a>
									</span>
									<a href="#0" class="btn_hero wishlist"><i class="icon_heart"></i>Wishlist</a>
                                    <a href="#0" class="btn_hero wishlist"><i class="icon_info"></i>Info</a>
								</div>
							</div>
						</div>
                        <!-- /row -->
                    </div>
                    <!-- /main_info -->
                </div>
            </div>
        </div>
        <!--/hero_in-->

        <nav class="secondary_nav sticky_horizontal">
            <div class="container">
                <ul id="secondary_nav">
                    @foreach($categories as $category)
                        <li><a href="#section-{{ $category->id }}">{{ $category->category_name }}</a></li>
                    @endforeach
                    <li><a href="#section-20"><i class="icon_chat_alt"></i>Reviews</a></li>
                </ul>
            </div>
            <span></span>
        </nav>
        <!-- /secondary_nav -->

        <div class="bg_gray">
            <div class="container margin_detail">
                <div class="row">
                    <div class="col-lg-8 list_menu">

                        <livewire:frontend.product.index :restaurant="$restaurant" :categories="$categories" :sizesWithPrices="$sizesWithPrices" :productsByCategory="$productsByCategory" />

                        <section id="section-1">
                            <h4>Starters</h4>
                            <div class="table_wrapper">


                                <div class="container">


                                    <div class="col-xs-12 col-md-12">
                                        <!-- Produkt -->
                                        <div class="product-content product-wrap clearfix">
                                            <div class="row">
                                                <div class="col-md-3 col-sm-12 col-xs-12">
                                                    <div class="product-image">
                                                        <img src="https://www.bootdey.com/image/194x228/87CEFA" alt="194x228" class="img-responsive">
                                                        <span class="tag2 hot">
                                                            HOT
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-md-9 col-sm-12 col-xs-12">
                                                    <div class="product-detail">
                                                        <h5 class="name">
                                                            <a href="#">
                                                                Product Name Title Here <i class="feather-star"></i>&#x1f331;
                                                            </a>
                                                        </h5>
                                                    </div>
                                                    <div class="description">
                                                        <p>Proin in ullamcorper lorem. Maecenas eu ipsum </p>
                                                    </div>
                                                    <div class="product-info smart-form">
                                                        <div class="row">
                                                            <div class="col-md-12 col-sm-12 col-xs-12 price-container">
                                                                <!-- Preisboxen -->
                                                                <div role="button" class="price-box add-to-cart animated-box" title="Pizza Urknall in den Warenkorb legen und in Braunschweig Westring bestellen" onclick="addToCart({productID: 31, location:'#'})">
                                                                    <span class="price-box-title">Single ca. 20cm</span>
                                                                    <span class="price-box-price">11,90&nbsp;€</span>
                                                                </div>
                                                                <div role="button" class="price-box add-to-cart animated-box" title="Pizza Urknall in den Warenkorb legen und in Braunschweig Westring bestellen" onclick="addToCart({productID: 31, location:'#'})">
                                                                    <span class="price-box-title">Single ca. 26cm</span>
                                                                    <span class="price-box-price">11,90&nbsp;€</span>
                                                                </div>
                                                                <div role="button" class="price-box add-to-cart animated-box" title="Pizza Urknall in den Warenkorb legen und in Braunschweig Westring bestellen" onclick="addToCart({productID: 31, location:'#'})">
                                                                    <span class="price-box-title">Single ca. 32cm</span>
                                                                    <span class="price-box-price">11,90&nbsp;€</span>
                                                                </div>
                                                                <div role="button" class="price-box add-to-cart animated-box" title="Pizza Urknall in den Warenkorb legen und in Braunschweig Westring bestellen" onclick="addToCart({productID: 31, location:'#'})">
                                                                    <span class="price-box-title">Single ca. 40cm</span>
                                                                    <span class="price-box-price">11,90&nbsp;€</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Ende Produkt -->
                                    </div>

                                    <div class="col-xs-12 col-md-12">
                                        <!-- Produkt -->
                                        <div class="product-content product-wrap clearfix">
                                            <div class="row">
                                                <div class="col-md-3 col-sm-12 col-xs-12">
                                                    <div class="product-image">
                                                        <img src="https://www.bootdey.com/image/194x228/87CEFA" alt="194x228" class="img-responsive">
                                                        <span class="tag2 hot">
                                                            HOT
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-md-9 col-sm-12 col-xs-12">
                                                    <div class="product-detail">
                                                        <h5 class="name">
                                                            <a href="#">
                                                                Product Name Title Here <i class="feather-star"></i>&#x1f331;
                                                            </a>
                                                        </h5>
                                                    </div>
                                                    <div class="description">
                                                        <p>Proin in ullamcorper lorem. Maecenas eu ipsum </p>
                                                    </div>
                                                    <!-- Preisboxen -->
                                                    <div class="price-container">
                                                        <div role="button" class="price-box add-to-cart animated-box" title="Pizza Urknall in den Warenkorb legen und in Braunschweig Westring bestellen" onclick="addToCart({productID: 31, location:'#'})">
                                                            <span class="price-box-title">Single ca. 20cm</span>
                                                            <span class="price-box-price">11,90&nbsp;€</span>
                                                        </div>
                                                        <div role="button" class="price-box add-to-cart animated-box" title="Pizza Urknall in den Warenkorb legen und in Braunschweig Westring bestellen" onclick="addToCart({productID: 31, location:'#'})">
                                                            <span class="price-box-title">Single ca. 26cm</span>
                                                            <span class="price-box-price">11,90&nbsp;€</span>
                                                        </div>
                                                        <div role="button" class="price-box add-to-cart animated-box" title="Pizza Urknall in den Warenkorb legen und in Braunschweig Westring bestellen" onclick="addToCart({productID: 31, location:'#'})">
                                                            <span class="price-box-title">Single ca. 32cm</span>
                                                            <span class="price-box-price">11,90&nbsp;€</span>
                                                        </div>
                                                        <div role="button" class="price-box add-to-cart animated-box" title="Pizza Urknall in den Warenkorb legen und in Braunschweig Westring bestellen" onclick="addToCart({productID: 31, location:'#'})">
                                                            <span class="price-box-title">Single ca. 40cm</span>
                                                            <span class="price-box-price">11,90&nbsp;€</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Ende Produkt -->
                                    </div>


                                    <style>

.price-box {
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 8px;
    cursor: pointer;
    background-color: #dc3545;
    color: #fff;
    display: flex;
    width: 66px;
    height: 66px;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    transition: transform 0.5s ease;
    transform: border-radius 2.5s ease;
    background: linear-gradient(to bottom, #fd4558, #c82333);
}

.price-box:hover {
    transform: translateY(-5px);
    border-radius: 20%; /* Rund machen beim Schweben */
}

.price-box-title {
    font-weight: lighter;
    text-align: center;
    font-size: xx-small;
}

.price-box-price {
    font-size: small;
}

@media (max-width: 767px) {
    .product-content .row {
        flex-direction: column;
    }

    .product-content .col-md-3,
    .product-content .col-md-9 {
        width: 100%;
    }
}



.zoom-effect {
    border-radius: 10px; /* Füge abgerundete Ecken hinzu */
}

.zoom-effect img {
    transition: transform 0.3s ease; /* Füge eine Transitions-Eigenschaft hinzu, um den Übergang weich zu gestalten */
}

.zoom-effect:hover img {
    transform: scale(1.2); /* Vergrößere das Bild um 20% */
}

.hot-icon::before {
    content: "Hot";
    background-color: #ff0000; /* Startfarbe */
    color: #ffffff; /* Textfarbe */
    padding: 4px 8px; /* Innenabstand */
    border-radius: 4px; /* Abgerundete Ecken */
    font-weight: bold; /* Fetter Text */
    animation: flicker 1s infinite alternate; /* Animationsdefinition */
}

@keyframes flicker {
    0% { background-color: #ff0000; } /* Startfarbe */
    100% { background-color: #ff4500; } /* Endfarbe */
}

/* CSS */
.vegan-icon::before {
    content: "V";
    font-size: 16px; /* Symbolgröße */
    color: #008000; /* Farbe für vegan */
    font-weight: bold; /* Fetter Text */
}


.halal-icon::before {
    content: "H";
    font-size: 16px; /* Symbolgröße */
    color: #008000; /* Farbe für Halal */
    font-weight: bold; /* Fetter Text */
    border-radius: 50%; /* Runde Form */
    background-color: #ffffff; /* Hintergrundfarbe des Kreises */
    display: inline-flex; /* Inline-Element verwenden */
    justify-content: center; /* Zentrierung des Inhalts horizontal */
    align-items: center; /* Zentrierung des Inhalts vertikal */
    width: 24px; /* Breite des Kreises */
    height: 24px; /* Höhe des Kreises */
}




                                    </style>









                                <div class="col-xs-12 col-md-12">
                                    <!-- product -->
                                    <div class="product-content product-wrap clearfix">
                                        <div class="row">
                                                <div class="col-md-3 col-sm-12 col-xs-12">
                                                    <div class="product-image">
                                                        <img src="https://www.bootdey.com/image/194x228/87CEFA" alt="194x228" class="img-responsive">
                                                        <span class="tag2 hot">
                                                            HOT
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-md-9 col-sm-12 col-xs-12">
                                                <div class="product-deatil fa-2x">
                                                        <h5 class="name">
                                                            <a href="#">
                                                                Product Name Title Here <i class="feather-star"></i>&#x1f331; <i class="fa-solid fa-pepper-hot"></i> <span>Category</span><i class="feather-star"></i><i class="feather-star"></i>
                                                            </a>
                                                        </h5>

                                                        <span class="hot">12</span>
                                                </div>
                                                <div class="description">
                                                    <p>Proin in ullamcorper lorem. Maecenas eu ipsum </p>
                                                </div>
                                                <div class="product-info smart-form">
                                                    <div class="row">
                                                        <div class="col-md-12 col-sm-12 col-xs-12 price-container">

                                                            <div role="button" class="price_box add-to-cart" title="Pizza Urknall in den Warenkorb legen und in Braunschweig Westring bestellen" onclick="addToCart({productID: 31, location:'#'})">
                                                                <span class="price_box_title">Single ca. 20cm</span>
                                                                <span class="price_box_price">11,90&nbsp;€</span>
                                                            </div>
                                                            <div role="button" class="price_box add-to-cart" title="Pizza Urknall in den Warenkorb legen und in Braunschweig Westring bestellen" onclick="addToCart({productID: 31, location:'#'})">
                                                                <span class="price_box_title">Single ca. 26cm</span>
                                                                <span class="price_box_price">11,90&nbsp;€</span>
                                                            </div>
                                                            <div role="button" class="price_box add-to-cart" title="Pizza Urknall in den Warenkorb legen und in Braunschweig Westring bestellen" onclick="addToCart({productID: 31, location:'#'})">
                                                                <span class="price_box_title">Single ca. 32cm</span>
                                                                <span class="price_box_price">11,90&nbsp;€</span>
                                                            </div>
                                                            <div role="button" class="price_box add-to-cart" title="Pizza Urknall in den Warenkorb legen und in Braunschweig Westring bestellen" onclick="addToCart({productID: 31, location:'#'})">
                                                                <span class="price_box_title">Single ca. 40cm</span>
                                                                <span class="price_box_price">11,90&nbsp;€</span>
                                                            </div>

                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end product -->
                                </div>



                                </div>


                                   </tbody>
                                </table>
                            </div>
                        </section>
                        <!-- /section -->









<style>

.product-content {
    border: 0.5px solid #dfe5e9;
    margin-bottom: 4px;
    margin-top: 4px;
    background: #fff;
    padding: 4px;
        -webkit-box-shadow: 0 1px 4px 0 rgba(0,0,0,0.37);
    box-shadow: 0 1px 4px 0 rgba(0,0,0,0.37);
}


.product-content .product-image {
    display: flex;
    margin: 0;
    overflow: hidden;
    position: relative;
    image-rendering: -webkit-optimize-contrast;
    flex-direction: column;
    width: auto;
    height: auto;
    align-items: center;
}


.product-content .product-detail {
    border-bottom: 1px solid #dfe5e9;
    padding-bottom: 17px;
    padding-left: 16px;
    padding-top: 16px;
    position: relative;
    background: #fff
}

.product-content .product-detail h5 a {
    color: #2f383d;
    font-size: 15px;
    line-height: 19px;
    text-decoration: none;
    padding-left: 0;
    margin-left: 0
}

.product-content .product-detail h5 a span {
    color: #9aa7af;
    display: block;
    font-size: 13px
}

.product-content .product-detail span.tag1 {
    border-radius: 50%;
    color: #3d0808;
    font-size: 15px;
    height: 50px;
    padding: 13px 0;
    position: absolute;
    right: 10px;
    text-align: center;
    top: 10px;
    width: 50px
}

.product-content .product-deatil span.sale {
    background-color: #21c2f8
}

.product-content .product-deatil span.discount {
    background-color: #71e134
}

.product-content .product-deatil span.hot {
    background-color: #fa9442
}

.product-content .description {
    font-size: 12.5px;
    line-height: 20px;
    padding: 10px 14px 16px 19px;
    background: #fff
}

.product-content .product-info {
    padding: 2px 8px 4px 20px;
}


.product-content .product-info a.add-to-cart {
    color: #2f383d;
    font-size: 13px;
    padding-left: 16px
}

.product-content name.a {
    padding: 5px 10px;
    margin-left: 16px
}

.product-info.smart-form .btn {
    padding: 6px 12px;
    margin-left: 12px;
    margin-top: -10px
}

.product-entry .product-detail {
    border-bottom: 1px solid #dfe5e9;
    padding-bottom: 17px;
    padding-left: 16px;
    padding-top: 16px;
    position: relative
}

.product-entry .product-detail h5 a {
    color: #2f383d;
    font-size: 15px;
    line-height: 19px;
    text-decoration: none
}

.product-entry .product-detail h5 a span {
    color: #9aa7af;
    display: block;
    font-size: 13px
}



.product-block .product-deatil p.price-container span,
.product-content .product-deatil p.price-container span,
.product-entry .product-deatil p.price-container span,
.shipping table tbody tr td p.price-container span,
.shopping-items table tbody tr td p.price-container span {
    color: #21c2f8;
    font-family: Lato, sans-serif;
    font-size: 24px;
    line-height: 20px
}

.product-info.smart-form .rating label {
    margin-top: 0
}

.product-wrap .product-image span.tag2 {
    position: absolute;
    top: 10px;
    right: 10px;
    width: 36px;
    height: 36px;
    border-radius: 50%;
    padding: 10px 0;
    color: #fff;
    font-size: 11px;
    text-align: center
}

.product-wrap .product-image span.sale {
    background-color: #57889c
}

.product-wrap .product-image span.hot {
    background-color: #a90329
}

.shop-btn {
    position: relative
}


.description-tabs {
    padding: 30px 0 5px!important
}

.description-tabs .tab-content {
    padding: 10px 0
}

.product-detail {
    padding: 30px 30px 50px
}

.product-detail hr+.description-tabs {
    padding: 0 0 5px!important
}

.product-detail .carousel-control.left,
.product-detail .carousel-control.right {
    background: none!important
}

.product-detail .glyphicon {
    color: #3276b1
}

.product-deatil .product-image {
    border-right: 0px solid #fff !important
}

.product-detail .name {
    margin-top: 0;
    margin-bottom: 0
}

.product-detail .name small {
    display: block
}

.product-detail .name a {
    margin-left: 0
}

.product-deatil .price-container {
    font-size: 24px;
    margin: 0;
    font-weight: 300
}

.product-deatil .price-container small {
    font-size: 12px
}

.product-deatil .fa-2x {
    font-size: 16px!important
}

.product-detail .fa-2x>h5 {
    font-size: 12px;
    margin: 0
}

.product-deatil .fa-2x+a,
.product-deatil .fa-2x+a+a {
    font-size: 13px
}

.product-deatil .certified {
    margin-top: 10px
}

.product-deatil .certified ul {
    padding-left: 0
}

.product-deatil .certified ul li:not(first-child) {
    margin-left: -3px
}

.product-deatil .certified ul li {
    display: inline-block;
    background-color: #f9f9f9;
    padding: 13px 19px
}

.product-deatil .certified ul li:first-child {
    border-right: none
}

.product-deatil .certified ul li a {
    text-align: left;
    font-size: 12px;
    color: #6d7a83;
    line-height: 16px;
    text-decoration: none
}

.product-deatil .certified ul li a span {
    display: block;
    color: #21c2f8;
    font-size: 13px;
    font-weight: 700;
    text-align: center
}

.product-deatil .message-text {
    width: calc(100% - 70px)
}


@media only screen and (min-width:1024px) {
    .product-content div[class*=col-md-4] {
        padding-right: 0
    }
    .product-content div[class*=col-md-8] {
        padding: 0 13px 0 0
    }
    .product-wrap div[class*=col-md-5] {
        padding-right: 0
    }
    .product-wrap div[class*=col-md-7] {
        padding: 0 13px 0 0
    }
    .product-content .product-image {
        border-right: 1px solid #dfe5e9
    }
    .product-content .product-info {
        position: relative
    }
}





.price-container {
    display: flex;
    align-items: center;
    justify-content: flex-end;

    }


    .price_box {
    padding: 5px 10px;
    border: 1px solid #ccc;
    border-radius: 8px;
    cursor: pointer;
    color: #fff;
    width: 66px;
    height: 66px;
    display: flex;
    justify-content: center;
    align-items: center;
    transition: border-radius 0.3s ease;
    flex-direction: column;
    background: linear-gradient(to bottom, #fd4558, #c82333);
}

.price_box:hover {
    border-radius: 50%; /* Rund machen beim Schweben */

}

.price_box:hover .price_box_price {
    animation-name: wobble;
    animation-duration: 0.5s;
    animation-timing-function: ease;
    animation-iteration-count: 1; /* Animation nur einmal abspielen */
}

@keyframes wobble {
    0% { transform: translateX(0); }
    25% { transform: translateX(5px); }
    50% { transform: translateX(-5px); }
    75% { transform: translateX(3px); }
    100% { transform: translateX(0); }
}

.price_box_title {
    font-weight: lighter;
    text-align: center;
    font-size: xx-small;
}

.price_box_price {
    font-weight: bold;
    text-align: center;
    font-family: auto;
}

</style>

























                        <section id="section-2">
                            <h4>Main Courses</h4>
                            <div class="table_wrapper">
                                <table class="table table-borderless cart-list menu-gallery">
                                    <thead>
                                        <tr>
                                            <th>
                                                Item
                                            </th>
                                            <th>
                                                Price
                                            </th>
                                            <th>
                                                Order
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="d-md-flex align-items-center">
                                                <figure>
                                                    <a href="{{ asset('frontend/img/menu_item_large_1.jpg') }}"
                                                        title="Photo title" data-effect="mfp-zoom-in"><img
                                                            src="{{ asset('frontend/img/menu-thumb-placeholder.jpg') }}"
                                                            data-src="{{ asset('frontend/img/menu-thumb-5.jpg') }}"
                                                            alt="thumb" class="lazy"></a>
                                                </figure>
                                                <div class="flex-md-column">
                                                    <h4>5. Cheese Quesadilla</h4>
                                                    <p>
                                                        Fuisset mentitum deleniti sit ea.
                                                    </p>
                                                </div>
                                            </td>
                                            <td>
                                                <strong>$12.00</strong>
                                            </td>
                                            <td class="options">
                                                <a href="#0"><i class="icon_plus_alt2"></i></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="d-md-flex align-items-center">
                                                <figure>
                                                    <a href="{{ asset('frontend/img/menu_item_large_2.jpg') }}"
                                                        title="Photo title" data-effect="mfp-zoom-in"><img
                                                            src="{{ asset('frontend/img/menu-thumb-placeholder.jpg') }}"
                                                            data-src="{{ asset('frontend/img/menu-thumb-6.jpg') }}"
                                                            alt="thumb" class="lazy"></a>
                                                </figure>
                                                <div class="flex-md-column">
                                                    <h4>6. Chorizo & Cheese</h4>
                                                    <p>
                                                        Fuisset mentitum deleniti sit ea.
                                                    </p>
                                                </div>
                                            </td>
                                            <td>
                                                <strong>$24.71</strong>
                                            </td>
                                            <td class="options">
                                                <a href="#0"><i class="icon_plus_alt2"></i></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="d-md-flex align-items-center">
                                                <figure>
                                                    <a href="{{ asset('frontend/img/menu_item_large_3.jpg') }}"
                                                        title="Photo title" data-effect="mfp-zoom-in"><img
                                                            src="{{ asset('frontend/img/menu-thumb-placeholder.jpg') }}"
                                                            data-src="{{ asset('frontend/img/menu-thumb-7.jpg') }}"
                                                            alt="thumb" class="lazy"></a>
                                                </figure>
                                                <div class="flex-md-column">
                                                    <h4>7. Beef Taco</h4>
                                                    <p>
                                                        Fuisset mentitum deleniti sit ea.
                                                    </p>
                                                </div>
                                            </td>
                                            <td>
                                                <strong>$8.70</strong>
                                            </td>
                                            <td class="options">
                                                <a href="#0"><i class="icon_plus_alt2"></i></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="d-md-flex align-items-center">
                                                <figure>
                                                    <a href="{{ asset('frontend/img/menu_item_large_4.jpg') }}"
                                                        title="Photo title" data-effect="mfp-zoom-in"><img
                                                            src="{{ asset('frontend/img/menu-thumb-placeholder.jpg') }}"
                                                            data-src="{{ asset('frontend/img/menu-thumb-8.jpg') }}"
                                                            alt="thumb" class="lazy"></a>
                                                </figure>
                                                <div class="flex-md-column">
                                                    <h4>8. Minced Beef Double Layer</h4>
                                                    <p>
                                                        Fuisset mentitum deleniti sit ea.
                                                    </p>
                                                </div>
                                            </td>
                                            <td>
                                                <strong>$6.30</strong>
                                            </td>
                                            <td class="options">
                                                <a href="#0"><i class="icon_plus_alt2"></i></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="d-md-flex align-items-center">
                                                <figure>
                                                    <a href="{{ asset('frontend/img/menu_item_large_1.jpg') }}"
                                                        title="Photo title" data-effect="mfp-zoom-in"><img
                                                            src="{{ asset('frontend/img/menu-thumb-placeholder.jpg') }}"
                                                            data-src="{{ asset('frontend/img/menu-thumb-9.jpg') }}"
                                                            alt="thumb" class="lazy"></a>
                                                </figure>
                                                <div class="flex-md-column">
                                                    <h4>9. Piri Piri Chicken</h4>
                                                    <p>
                                                        Fuisset mentitum deleniti sit ea.
                                                    </p>
                                                </div>
                                            </td>
                                            <td>
                                                <strong>$7.40</strong>
                                            </td>
                                            <td class="options">
                                                <a href="#0"><i class="icon_plus_alt2"></i></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="d-md-flex align-items-center">
                                                <figure>
                                                    <a href="{{ asset('frontend/img/menu_item_large_2.jpg') }}"
                                                        title="Photo title" data-effect="mfp-zoom-in"><img
                                                            src="{{ asset('frontend/img/menu-thumb-placeholder.jpg') }}"
                                                            data-src="{{ asset('frontend/img/menu-thumb-10.jpg') }}"
                                                            alt="thumb" class="lazy"></a>
                                                </figure>
                                                <div class="flex-md-column">
                                                    <h4>10. Burrito Al Pastor</h4>
                                                    <p>
                                                        Fuisset mentitum deleniti sit ea.
                                                    </p>
                                                </div>
                                            </td>
                                            <td>
                                                <strong>$7.70</strong>
                                            </td>
                                            <td class="options">
                                                <a href="#0"><i class="icon_plus_alt2"></i></a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </section>
                        <!-- /section -->

                        <section id="section-3">
                            <h4>Desserts</h4>
                            <div class="table_wrapper">
                                <table class="table table-borderless cart-list menu-gallery">
                                    <thead>
                                        <tr>
                                            <th>
                                                Item
                                            </th>
                                            <th>
                                                Price
                                            </th>
                                            <th>
                                                Order
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="d-md-flex align-items-center">
                                                <figure>
                                                    <a href="{{ asset('frontend/img/menu_item_large_1.jpg') }}"
                                                        title="Photo title" data-effect="mfp-zoom-in"><img
                                                            src="{{ asset('frontend/img/menu-thumb-placeholder.jpg') }}"
                                                            data-src="{{ asset('frontend/img/menu-thumb-17.jpg') }}"
                                                            alt="thumb" class="lazy"></a>
                                                </figure>
                                                <div class="flex-md-column">
                                                    <h4>11. Chocolate Fudge Cake</h4>
                                                    <p>
                                                        Fuisset mentitum deleniti sit ea.
                                                    </p>
                                                </div>
                                            </td>
                                            <td>
                                                <strong>$24.71</strong>
                                            </td>
                                            <td class="options">
                                                <a href="#0"><i class="icon_plus_alt2"></i></a>
                                            </td>
                                        </tr>

                                        <div class="col-md-6">
                                            <a class="menu_item modal_dialog" href="#modal-dialog">
                                                <figure><img src="{{ asset('frontend/img/menu-thumb-placeholder.jpg') }}" data-src="{{ asset('frontend/img/menu-thumb-9.jpg') }}" alt="thumb" class="lazy"></figure>
                                                <h3>15. Mineral Water</h3>
                                                <p>Fuisset mentitum deleniti sit ea.</p>
                                                <strong>$1.40</strong>
                                            </a>
                                        </div>

                                        <tr>
                                            <td class="d-md-flex align-items-center">
                                                <figure>
                                                    <a href="{{ asset('frontend/img/menu_item_large_2.jpg') }}"
                                                        title="Photo title" data-effect="mfp-zoom-in"><img
                                                            src="{{ asset('frontend/img/menu-thumb-placeholder.jpg') }}"
                                                            data-src="{{ asset('frontend/img/menu-thumb-18.jpg') }}"
                                                            alt="thumb" class="lazy"></a>
                                                </figure>
                                                <div class="flex-md-column">
                                                    <h4>12. Cheesecake</h4>
                                                    <p>
                                                        Fuisset mentitum deleniti sit ea.
                                                    </p>
                                                </div>
                                            </td>
                                            <td>
                                                <strong>$7.50</strong>
                                            </td>
                                            <td class="options">
                                                <a href="#0"><i class="icon_plus_alt2"></i></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="d-md-flex align-items-center">
                                                <figure>
                                                    <a href="{{ asset('frontend/img/menu_item_large_3.jpg') }}"
                                                        title="Photo title" data-effect="mfp-zoom-in"><img
                                                            src="{{ asset('frontend/img/menu-thumb-placeholder.jpg') }}"
                                                            data-src="{{ asset('frontend/img/menu-thumb-19.jpg') }}"
                                                            alt="thumb" class="lazy"></a>
                                                </figure>
                                                <div class="flex-md-column">
                                                    <h4>19. Apple Pie & Custard</h4>
                                                    <p>
                                                        Fuisset mentitum deleniti sit ea.
                                                    </p>
                                                </div>
                                            </td>
                                            <td>
                                                <strong>$9.70</strong>
                                            </td>
                                            <td class="options">
                                                <a href="#0"><i class="icon_plus_alt2"></i></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="d-md-flex align-items-center">
                                                <figure>
                                                    <a href="{{ asset('frontend/img/menu_item_large_4.jpg') }}"
                                                        title="Photo title" data-effect="mfp-zoom-in"><img
                                                            src="{{ asset('frontend/img/menu-thumb-placeholder.jpg') }}"
                                                            data-src="{{ asset('frontend/img/menu-thumb-20.jpg') }}"
                                                            alt="thumb" class="lazy"></a>
                                                </figure>
                                                <div class="flex-md-column">
                                                    <h4>14. Profiteroles</h4>
                                                    <p>
                                                        Fuisset mentitum deleniti sit ea.
                                                    </p>
                                                </div>
                                            </td>
                                            <td>
                                                <strong>$12.00</strong>
                                            </td>
                                            <td class="options">
                                                <a href="#0"><i class="icon_plus_alt2"></i></a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </section>
                        <!-- /section -->

                        <section id="section-4">
                            <h4>Drinks</h4>
                            <div class="table_wrapper">
                                <table class="table table-borderless cart-list menu-gallery">
                                    <thead>
                                        <tr>
                                            <th>
                                                Item
                                            </th>
                                            <th>
                                                Price
                                            </th>
                                            <th>
                                                Order
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="d-md-flex align-items-center">
                                                <figure>
                                                    <a href="{{ asset('frontend/img/menu_item_large_1.jpg') }}"
                                                        title="Photo title" data-effect="mfp-zoom-in"><img
                                                            src="{{ asset('frontend/img/menu-thumb-placeholder.jpg') }}"
                                                            data-src="{{ asset('frontend/img/menu-thumb-15.jpg') }}"
                                                            alt="thumb" class="lazy"></a>
                                                </figure>
                                                <div class="flex-md-column">
                                                    <h4>15. Coca Cola</h4>
                                                    <p>
                                                        Fuisset mentitum deleniti sit ea.
                                                    </p>
                                                </div>
                                            </td>
                                            <td>
                                                <strong>$4.71</strong>
                                            </td>
                                            <td class="options">
                                                <a href="#0"><i class="icon_plus_alt2"></i></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="d-md-flex align-items-center">
                                                <figure>
                                                    <a href="{{ asset('frontend/img/menu_item_large_2.jpg') }}"
                                                        title="Photo title" data-effect="mfp-zoom-in"><img
                                                            src="{{ asset('frontend/img/menu-thumb-placeholder.jpg') }}"
                                                            data-src="{{ asset('frontend/img/menu-thumb-16.jpg') }}"
                                                            alt="thumb" class="lazy"></a>
                                                </figure>
                                                <div class="flex-md-column">
                                                    <h4>16. Beer Corona</h4>
                                                    <p>
                                                        Fuisset mentitum deleniti sit ea.
                                                    </p>
                                                </div>
                                            </td>
                                            <td>
                                                <strong>$7.50</strong>
                                            </td>
                                            <td class="options">
                                                <a href="#0"><i class="icon_plus_alt2"></i></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="d-md-flex align-items-center">
                                                <figure>
                                                    <a href="{{ asset('frontend/img/menu_item_large_3.jpg') }}"
                                                        title="Photo title" data-effect="mfp-zoom-in"><img
                                                            src="{{ asset('frontend/img/menu-thumb-placeholder.jpg') }}"
                                                            data-src="{{ asset('frontend/img/menu-thumb-17.jpg') }}"
                                                            alt="thumb" class="lazy"></a>
                                                </figure>
                                                <div class="flex-md-column">
                                                    <h4>17. Red Wine</h4>
                                                    <p>
                                                        Fuisset mentitum deleniti sit ea.
                                                    </p>
                                                </div>
                                            </td>
                                            <td>
                                                <strong>$9.70</strong>
                                            </td>
                                            <td class="options">
                                                <a href="#0"><i class="icon_plus_alt2"></i></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="d-md-flex align-items-center">
                                                <figure>
                                                    <a href="{{ asset('frontend/img/menu_item_large_4.jpg') }}"
                                                        title="Photo title" data-effect="mfp-zoom-in"><img
                                                            src="{{ asset('frontend/img/menu-thumb-placeholder.jpg') }}"
                                                            data-src="{{ asset('frontend/img/menu-thumb-18.jpg') }}"
                                                            alt="thumb" class="lazy"></a>
                                                </figure>
                                                <div class="flex-md-column">
                                                    <h4>18. White Wine</h4>
                                                    <p>
                                                        Fuisset mentitum deleniti sit ea.
                                                    </p>
                                                </div>
                                            </td>
                                            <td>
                                                <strong>$12.00</strong>
                                            </td>
                                            <td class="options">
                                                <a href="#0"><i class="icon_plus_alt2"></i></a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </section>
                        <!-- /section -->
                    </div>
                    <!-- /col -->

		            <div class="col-lg-4" id="sidebar_fixed">
		                <div class="box_order mobile_fixed">
		                    <div class="head">
		                        <h3>{{ app(\App\Services\TranslationService::class)->trans('Order Summary', app()->getLocale()) }}</h3>
		                        <a href="#0" class="close_panel_mobile"><i class="icon_close"></i></a>

		                    </div>
		                    <!-- /head -->
		                    <div class="main">
                                <livewire:frontend.card.cart-component />

		                        <div class="row opt_order">
		                            <div class="col-6">
		                                <label class="container_radio">{{ app(\App\Services\TranslationService::class)->trans('Delivery', app()->getLocale()) }}
		                                    <input type="radio" value="option1" name="opt_order" checked>
		                                    <span class="checkmark"></span>
		                                </label>
		                            </div>
		                            <div class="col-6">
		                                <label class="container_radio">{{ app(\App\Services\TranslationService::class)->trans('Selbstabholen', app()->getLocale()) }}
		                                    <input type="radio" value="option1" name="opt_order">
		                                    <span class="checkmark"></span>
		                                </label>
		                            </div>
		                        </div>
		                        <div class="dropdown day">
		                            <a href="#" data-bs-toggle="dropdown">Day <span id="selected_day"></span></a>
		                            <div class="dropdown-menu">
		                                <div class="dropdown-menu-content">
		                                    <h4>Which day delivered?</h4>
		                                    <div class="radio_select chose_day">
		                                        <ul>
		                                            <li>
		                                                <input type="radio" id="day_1" name="day" value="Today">
		                                                <label for="day_1">Today<em>-40%</em></label>
		                                            </li>
		                                            <li>
		                                                <input type="radio" id="day_2" name="day" value="Tomorrow">
		                                                <label for="day_2">Tomorrow<em>-40%</em></label>
		                                            </li>
		                                        </ul>
		                                    </div>
		                                    <!-- /people_select -->
		                                </div>
		                            </div>
		                        </div>
		                        <!-- /dropdown -->
		                        <div class="dropdown time">
		                            <a href="#" data-bs-toggle="dropdown">Time <span id="selected_time"></span></a>
		                            <div class="dropdown-menu">
		                                <div class="dropdown-menu-content">
		                                    <h4>Lunch</h4>
		                                    <div class="radio_select add_bottom_15">
		                                        <ul>
		                                            <li>
		                                                <input type="radio" id="time_1" name="time" value="12.00am">
		                                                <label for="time_1">12.00<em>-40%</em></label>
		                                            </li>
		                                            <li>
		                                                <input type="radio" id="time_2" name="time" value="08.30pm">
		                                                <label for="time_2">12.30<em>-40%</em></label>
		                                            </li>
		                                            <li>
		                                                <input type="radio" id="time_3" name="time" value="09.00pm">
		                                                <label for="time_3">1.00<em>-40%</em></label>
		                                            </li>
		                                            <li>
		                                                <input type="radio" id="time_4" name="time" value="09.30pm">
		                                                <label for="time_4">1.30<em>-40%</em></label>
		                                            </li>
		                                        </ul>
		                                    </div>
		                                    <!-- /time_select -->
		                                    <h4>Dinner</h4>
		                                    <div class="radio_select">
		                                        <ul>
		                                            <li>
		                                                <input type="radio" id="time_5" name="time" value="08.00pm">
		                                                <label for="time_1">20.00<em>-40%</em></label>
		                                            </li>
		                                            <li>
		                                                <input type="radio" id="time_6" name="time" value="08.30pm">
		                                                <label for="time_2">20.30<em>-40%</em></label>
		                                            </li>
		                                            <li>
		                                                <input type="radio" id="time_7" name="time" value="09.00pm">
		                                                <label for="time_3">21.00<em>-40%</em></label>
		                                            </li>
		                                            <li>
		                                                <input type="radio" id="time_8" name="time" value="09.30pm">
		                                                <label for="time_4">21.30<em>-40%</em></label>
		                                            </li>
		                                        </ul>
		                                    </div>
		                                    <!-- /time_select -->
		                                </div>
		                            </div>
		                        </div>
		                        <!-- /dropdown -->
		                        <div class="btn_1_mobile">
		                            <a href="{{ route('order', ['restaurantId' => $restaurant->id]) }}" class="btn_1 gradient full-width mb_5">{{ app(\App\Services\TranslationService::class)->trans('Order Now', app()->getLocale()) }}</a>
		                            <div class="text-center"><small>{{ app(\App\Services\TranslationService::class)->trans('No money charged on this steps', app()->getLocale()) }}</small></div>
		                        </div>
		                    </div>
		                </div>
		                <!-- /box_order -->
		                <div class="btn_reserve_fixed"><a href="#0" class="btn_1 gradient full-width">{{ app(\App\Services\TranslationService::class)->trans('View Basket', app()->getLocale()) }}</a></div>
		            </div>


                </div>
                <!-- /row -->
            </div>
            <!-- /container -->
        </div>
        <!-- /bg_gray -->

        <div class="container margin_30_20">
            <div class="row">
                <div class="col-lg-8 list_menu">
                    <section id="section-5">
                        <h4>Reviews</h4>
                        <div class="row add_bottom_30 d-flex align-items-center reviews">
                            <div class="col-md-3">
                                <div id="review_summary">
                                    <strong>8.5</strong>
                                    <em>Superb</em>
                                    <small>Based on 4 reviews</small>
                                </div>
                            </div>
                            <div class="col-md-9 reviews_sum_details">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h6>Food Quality</h6>
                                        <div class="row">
                                            <div class="col-xl-10 col-lg-9 col-9">
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: 90%"
                                                        aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            <div class="col-xl-2 col-lg-3 col-3"><strong>9.0</strong></div>
                                        </div>
                                        <!-- /row -->
                                        <h6>Service</h6>
                                        <div class="row">
                                            <div class="col-xl-10 col-lg-9 col-9">
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: 95%"
                                                        aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            <div class="col-xl-2 col-lg-3 col-3"><strong>9.5</strong></div>
                                        </div>
                                        <!-- /row -->
                                    </div>
                                    <div class="col-md-6">
                                        <h6>Punctuality</h6>
                                        <div class="row">
                                            <div class="col-xl-10 col-lg-9 col-9">
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: 60%"
                                                        aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            <div class="col-xl-2 col-lg-3 col-3"><strong>6.0</strong></div>
                                        </div>
                                        <!-- /row -->
                                        <h6>Price</h6>
                                        <div class="row">
                                            <div class="col-xl-10 col-lg-9 col-9">
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: 60%"
                                                        aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            <div class="col-xl-2 col-lg-3 col-3"><strong>6.0</strong></div>
                                        </div>
                                        <!-- /row -->
                                    </div>
                                </div>
                                <!-- /row -->
                            </div>
                        </div>
                        <!-- /row -->
                        <div id="reviews">
                            <div class="review_card">
                                <div class="row">
                                    <div class="col-md-2 user_info">
                                        <figure><img src="{{ asset('frontend/img/avatar4.jpg') }}" alt="">
                                        </figure>
                                        <h5>Lukas</h5>
                                    </div>
                                    <div class="col-md-10 review_content">
                                        <div class="clearfix add_bottom_15">
                                            <span class="rating">8.5<small>/10</small> <strong>Rating
                                                    average</strong></span>
                                            <em>Published 54 minutes ago</em>
                                        </div>
                                        <h4>"Great Location!!"</h4>
                                        <p>Eos tollit ancillae ea, lorem consulatu qui ne, eu eros eirmod scaevola sea. Et
                                            nec tantas accusamus salutatus, sit commodo veritus te, erat legere fabulas has
                                            ut. Rebum laudem cum ea, ius essent fuisset ut. Viderer petentium cu his. Tollit
                                            molestie suscipiantur his et.</p>
                                        <ul>
                                            <li><a href="#0"><i class="icon_like"></i><span>Useful</span></a></li>
                                            <li><a href="#0"><i class="icon_dislike"></i><span>Not useful</span></a>
                                            </li>
                                            <li><a href="#0"><i class="arrow_back"></i> <span>Reply</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- /row -->
                            </div>
                            <!-- /review_card -->
                            <div class="review_card">
                                <div class="row">
                                    <div class="col-md-2 user_info">
                                        <figure><img src="{{ asset('frontend/img/avatar1.jpg') }}" alt="">
                                        </figure>
                                        <h5>Marika</h5>
                                    </div>
                                    <div class="col-md-10 review_content">
                                        <div class="clearfix add_bottom_15">
                                            <span class="rating">9.0<small>/10</small> <strong>Rating
                                                    average</strong></span>
                                            <em>Published 11 Oct. 2019</em>
                                        </div>
                                        <h4>"Really great dinner!!"</h4>
                                        <p>Eos tollit ancillae ea, lorem consulatu qui ne, eu eros eirmod scaevola sea. Et
                                            nec tantas accusamus salutatus, sit commodo veritus te, erat legere fabulas has
                                            ut. Rebum laudem cum ea, ius essent fuisset ut. Viderer petentium cu his. Tollit
                                            molestie suscipiantur his et.</p>
                                        <ul>
                                            <li><a href="#0"><i class="icon_like"></i><span>Useful</span></a></li>
                                            <li><a href="#0"><i class="icon_dislike"></i><span>Not useful</span></a>
                                            </li>
                                            <li><a href="#0"><i class="arrow_back"></i> <span>Reply</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- /row -->
                                <div class="row reply">
                                    <div class="col-md-2 user_info">
                                        <figure><img src="{{ asset('frontend/img/avatar.jpg') }}" alt="">
                                        </figure>
                                    </div>
                                    <div class="col-md-10">
                                        <div class="review_content">
                                            <strong>Reply from Foogra</strong>
                                            <em>Published 3 minutes ago</em>
                                            <p><br>Hi Monika,<br><br>Eos tollit ancillae ea, lorem consulatu qui ne, eu eros
                                                eirmod scaevola sea. Et nec tantas accusamus salutatus, sit commodo veritus
                                                te, erat legere fabulas has ut. Rebum laudem cum ea, ius essent fuisset ut.
                                                Viderer petentium cu his. Tollit molestie suscipiantur his et.<br><br>Thanks
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <!-- /reply -->
                            </div>
                            <!-- /review_card -->
                        </div>
                        <!-- /reviews -->
                        <div class="text-end"><a href="leave-review.html" class="btn_1 gradient">Leave a Review</a></div>
                    </section>
                    <!-- /section -->
                </div>
            </div>
        </div>
        <!-- /container -->

        <div id="message">Item added to cart</div><!-- Add to cart message -->




        @push('specific-scripts')
            <!-- SPECIFIC SCRIPTS -->
            <script src="{{ asset('frontend/js/sticky_sidebar.min.js') }}"></script>
            <script src="{{ asset('frontend/js/sticky-kit.min.js') }}"></script>
            <script src="{{ asset('frontend/js/specific_detail.js') }}"></script>
        @endpush
    @endsection
@if(isset($modalScript) && $modalScript)

@push('specific-header')

<link href="{{ asset('frontend/css/modal_popup.css') }}" rel="stylesheet">

@endpush



<div class="popup_wrapper">
    <div class="popup_content newsletter_c">
        <span class="popup_close"><i class="icon_close"></i></span>
        <div class="row g-0">
            <div class="col-md-5 d-none d-md-flex align-items-center justify-content-center">
                <figure><img src="{{ asset('frontend/img/newsletter_img.jpg') }}" alt=""></figure>
            </div>
            <div class="col-md-7">
                <div class="content">
                    <div class="wrapper">
                        <img src="{{ asset('frontend/img/logo_sticky.svg') }}" width="162" height="35" alt="">
                        <h3>Entschuldigung, außerhalb des Liefergebiets</h3>
                        <p>Es tut uns leid, aber Ihre Adresse befindet sich außerhalb unseres Liefergebiets. Bitte überprüfen Sie Ihre Adresse oder kontaktieren Sie uns für weitere Informationen.</p>
                        <p>Falls Sie weitere Fragen haben, stehen wir Ihnen gerne zur Verfügung.</p>
                        <form action="#">
                            <div class="form-group">
                                <input type="email" class="form-control" placeholder="Enter your email address">
                            </div>
                            <button type="submit" class="btn_1 mt-2 mb-4">Subscribe</button>
                        </form>
                        <div class="row opt_order">
                            <div class="col-6">
                                <label class="container_radio">Delivery
                                    <input type="radio" value="option1" name="opt_order" checked="">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="col-6">
                                <label class="container_radio">Take away
                                    <input type="radio" value="option1" name="opt_order">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- row -->
    </div>
</div>


@push('specific-scripts')

<script>

    (function($) {
        "use strict";

        // Popup up
        setTimeout(function() {
            $('.popup_wrapper').css('opacity', '1');
        }, 500); // Entrance delay

        $('.popup_wrapper');
        $('.popup_close').click(function() { // Class for the close button
            $('.popup_wrapper').fadeOut(300); // Hide the CTA div
        });



    })(window.jQuery);

</script>






@endpush


@endif
