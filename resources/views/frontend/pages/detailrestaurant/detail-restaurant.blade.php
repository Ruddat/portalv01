@extends('frontend.layouts.default')
@section('content')
    <!-- seitenabhengig css -->
    @push('specific-css')
        <link href="{{ asset('frontend/css/detail-page.css') }}" rel="stylesheet">
    @endpush

    <body data-spy="scroll" data-bs-target="#secondary_nav" data-offset="75">

        @include('frontend.includes.header-in-clearfix')






		<div class="hero_in detail_page background-image" data-background="url({{ asset('frontend/img/hero_general_2.jpg') }})">
			<div class="wrapper opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.5)">

				<div class="container">
					<div class="main_info">
						<div class="row">
							<div class="col-xl-4 col-lg-5 col-md-6">
                                <div class="head">
                                    <img src="{{ $restaurant->logo_url }}" alt="Restaurant Logo" style="max-width: 100px; border-radius: 10px;">

                                <div class="score"><span>Superb<em>350 Reviews</em></span><strong>8.9</strong></div>
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
<!-- Ihr Produktbereich -->
@foreach($categories as $category)
    <section id="section-{{ $category->id }}">
        <h4>{{ $category->category_name }}</h4>
        <p>{{ $category->category_description }}</p>
        <div class="row">
            <div class="col-md-12">
                <div class="image-wrapper" style="margin-bottom: 12px;">
                    <img src="{{ asset($category->category_image_url) }}" alt="{{ $category->category_name }}" class="category-image rounded shadow" style="max-width: 100%; max-height: 168px;">
                </div>
            </div>
        </div>
        <div class="row">

            @foreach($productsByCategory[$category->category_name] as $product)
                <div class="col-md-6">
                    <div class="product-card">
                        <a href="#modal-dialog" class="menu_item modal_dialog" data-product="{{ json_encode($product) }}">
                            <figure class="zoom-effect">
                                <img src="{{ $product->product_image_url }}" data-src="{{ $product->product_image_url }}" alt="thumb - {{ $product->product_title }}" class="lazy">
                            </figure>
                            <h3>{{ $product->product_code }} {{ $product->product_title }}</h3>
                            @if ($product->bottle)
                                <p>Pfand: {{ $product->bottle->bottles_value }}</p>
                            @endif
                            <p>{!! $product->product_description !!}</p>
                            <strong>${{ $product->minPrice }}</strong>
                        </a>
                    </div>
                </div>
            @endforeach









        </div>
    </section>
  @endforeach


		                <!-- /section -->
		                <section id="section-4">
		                    <h4>Drinks</h4>
		                    <div class="row">
		                        <div class="col-md-6">
		                            <a class="menu_item modal_dialog" href="#modal-dialog">
		                                <figure><img src="{{ asset('frontend/img/menu-thumb-placeholder.jpg') }}" data-src="{{ asset('frontend/img/menu-thumb-5.jpg') }}" alt="thumb" class="lazy"></figure>
		                                <h3>11. Coca Cola</h3>
		                                <p>Fuisset mentitum deleniti sit ea.</p>
		                                <strong>$2.40</strong>
		                            </a>
		                        </div>
		                        <div class="col-md-6">
		                            <a class="menu_item modal_dialog" href="#modal-dialog">
		                                <figure><img src="{{ asset('frontend/img/menu-thumb-placeholder.jpg') }}" data-src="{{ asset('frontend/img/menu-thumb-6.jpg') }}" alt="thumb" class="lazy"></figure>
		                                <h3>12. Corona Beer</h3>
		                                <p>Fuisset mentitum deleniti sit ea.</p>
		                                <strong>$9.40</strong>
		                            </a>
		                        </div>
		                        <div class="col-md-6">
		                            <a class="menu_item modal_dialog" href="#modal-dialog">
		                                <figure><img src="{{ asset('frontend/img/menu-thumb-placeholder.jpg') }}" data-src="{{ asset('frontend/img/menu-thumb-7.jpg') }}" alt="thumb" class="lazy"></figure>
		                                <h3>13. Red Wine</h3>
		                                <p>Fuisset mentitum deleniti sit ea.</p>
		                                <strong>$19.40</strong>
		                            </a>
		                        </div>
		                        <div class="col-md-6">
		                            <a class="menu_item modal_dialog" href="#modal-dialog">
		                                <figure><img src="{{ asset('frontend/img/menu-thumb-placeholder.jpg') }}" data-src="{{ asset('frontend/img/menu-thumb-8.jpg') }}" alt="thumb" class="lazy"></figure>
		                                <h3>14. White Wine</h3>
		                                <p>Fuisset mentitum deleniti sit ea.</p>
		                                <strong>$19.40</strong>
		                            </a>
		                        </div>
		                        <div class="col-md-6">
		                            <a class="menu_item modal_dialog" href="#modal-dialog">
		                                <figure><img src="{{ asset('frontend/img/menu-thumb-placeholder.jpg') }}" data-src="{{ asset('frontend/img/menu-thumb-9.jpg') }}" alt="thumb" class="lazy"></figure>
		                                <h3>15. Mineral Water</h3>
		                                <p>Fuisset mentitum deleniti sit ea.</p>
		                                <strong>$1.40</strong>
		                            </a>
		                        </div>
		                        <div class="col-md-6">
		                            <a class="menu_item modal_dialog" href="#modal-dialog">
		                                <figure><img src="{{ asset('frontend/img/menu-thumb-placeholder.jpg') }}" data-src="{{ asset('frontend/img/menu-thumb-10.jpg') }}" alt="thumb" class="lazy"></figure>
		                                <h3>16. Red Bull</h3>
		                                <p>Fuisset mentitum deleniti sit ea.</p>
		                                <strong>$3.40</strong>
		                            </a>
		                        </div>
		                    </div>
		                    <!-- /row -->
		                </section>
		                <!-- /section -->
		            </div>
		            <!-- /col -->
		            <div class="col-lg-4" id="sidebar_fixed">
		                <div class="box_order mobile_fixed">
		                    <div class="head">
		                        <h3>Order Summary</h3>
		                        <a href="#0" class="close_panel_mobile"><i class="icon_close"></i></a>
		                    </div>
		                    <!-- /head -->
		                    <div class="main">
		                        <ul class="clearfix">
		                            <li><a href="#0">1x Enchiladas</a><span>$11</span></li>
		                            <li><a href="#0">2x Burrito</a><span>$14</span></li>
		                            <li><a href="#0">1x Chicken</a><span>$18</span></li>
		                            <li><a href="#0">2x Corona Beer</a><span>$9</span></li>
		                            <li><a href="#0">2x Cheese Cake</a><span>$11</span></li>
		                        </ul>
		                        <ul class="clearfix">
		                            <li>Subtotal<span>$56</span></li>
		                            <li>Delivery fee<span>$10</span></li>
		                            <li class="total">Total<span>$66</span></li>
		                        </ul>
		                        <div class="row opt_order">
		                            <div class="col-6">
		                                <label class="container_radio">Delivery
		                                    <input type="radio" value="option1" name="opt_order" checked>
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
		                            <a href="order.html" class="btn_1 gradient full-width mb_5">Order Now</a>
		                            <div class="text-center"><small>No money charged on this steps</small></div>
		                        </div>
		                    </div>
		                </div>
		                <!-- /box_order -->
		                <div class="btn_reserve_fixed"><a href="#0" class="btn_1 gradient full-width">View Basket</a></div>
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
					<section id="section-20">
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
					                                <div class="progress-bar" role="progressbar" style="width: 90%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
					                            </div>
					                        </div>
					                        <div class="col-xl-2 col-lg-3 col-3"><strong>9.0</strong></div>
					                    </div>
					                    <!-- /row -->
					                    <h6>Service</h6>
					                    <div class="row">
					                        <div class="col-xl-10 col-lg-9 col-9">
					                            <div class="progress">
					                                <div class="progress-bar" role="progressbar" style="width: 95%" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
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
					                                <div class="progress-bar" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
					                            </div>
					                        </div>
					                        <div class="col-xl-2 col-lg-3 col-3"><strong>6.0</strong></div>
					                    </div>
					                    <!-- /row -->
					                    <h6>Price</h6>
					                    <div class="row">
					                        <div class="col-xl-10 col-lg-9 col-9">
					                            <div class="progress">
					                                <div class="progress-bar" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
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
					                    <figure><img src="{{ asset('frontend/img/avatar4.jpg') }}" alt=""></figure>
					                    <h5>Lukas</h5>
					                </div>
					                <div class="col-md-10 review_content">
					                    <div class="clearfix add_bottom_15">
					                        <span class="rating">8.5<small>/10</small> <strong>Rating average</strong></span>
					                        <em>Published 54 minutes ago</em>
					                    </div>
					                    <h4>"Great Location!!"</h4>
					                    <p>Eos tollit ancillae ea, lorem consulatu qui ne, eu eros eirmod scaevola sea. Et nec tantas accusamus salutatus, sit commodo veritus te, erat legere fabulas has ut. Rebum laudem cum ea, ius essent fuisset ut. Viderer petentium cu his. Tollit molestie suscipiantur his et.</p>
					                    <ul>
					                        <li><a href="#0"><i class="icon_like"></i><span>Useful</span></a></li>
					                        <li><a href="#0"><i class="icon_dislike"></i><span>Not useful</span></a></li>
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
					                    <figure><img src="{{ asset('frontend/img/avatar1.jpg') }}" alt=""></figure>
					                    <h5>Marika</h5>
					                </div>
					                <div class="col-md-10 review_content">
					                    <div class="clearfix add_bottom_15">
					                        <span class="rating">9.0<small>/10</small> <strong>Rating average</strong></span>
					                        <em>Published 11 Oct. 2019</em>
					                    </div>
					                    <h4>"Really great dinner!!"</h4>
					                    <p>Eos tollit ancillae ea, lorem consulatu qui ne, eu eros eirmod scaevola sea. Et nec tantas accusamus salutatus, sit commodo veritus te, erat legere fabulas has ut. Rebum laudem cum ea, ius essent fuisset ut. Viderer petentium cu his. Tollit molestie suscipiantur his et.</p>
					                    <ul>
					                        <li><a href="#0"><i class="icon_like"></i><span>Useful</span></a></li>
					                        <li><a href="#0"><i class="icon_dislike"></i><span>Not useful</span></a></li>
					                        <li><a href="#0"><i class="arrow_back"></i> <span>Reply</span></a></li>
					                    </ul>
					                </div>
					            </div>
					            <!-- /row -->
					            <div class="row reply">
					                <div class="col-md-2 user_info">
					                    <figure><img src="{{ asset('frontend/img/avatar.jpg') }}" alt=""></figure>
					                </div>
					                <div class="col-md-10">
					                    <div class="review_content">
					                        <strong>Reply from Foogra</strong>
					                        <em>Published 3 minutes ago</em>
					                        <p><br>Hi Monika,<br><br>Eos tollit ancillae ea, lorem consulatu qui ne, eu eros eirmod scaevola sea. Et nec tantas accusamus salutatus, sit commodo veritus te, erat legere fabulas has ut. Rebum laudem cum ea, ius essent fuisset ut. Viderer petentium cu his. Tollit molestie suscipiantur his et.<br><br>Thanks</p>
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

<!-- Ihr vorhandenes Modal für Produktoptionen -->
<div id="modal-dialog" class="zoom-anim-dialog mfp-hide">
    <!-- Ihr Modal-Inhalt hier -->
    <div class="small-dialog-header">
        <h3 id="productTitle">Pizza Veggi Smith (Junior Ø20cm)</h3>
    </div>
    <div class="content">
        <h5>Quantity</h5>
        <div class="numbers-row">
            <input type="text" value="1" id="qty" class="qty2 form-control" name="quantity">
        </div>
        <h5>Size</h5>
        <ul class="clearfix" id="sizeOptions">
            <li>
                <label class="container_radio">Medium<span>+ $3.30</span>
                    <input type="radio" value="3.30" name="sizeOption">
                    <span class="checkmark"></span>
                </label>
            </li>
            <li>
                <label class="container_radio">Large<span>+ $5.30</span>
                    <input type="radio" value="5.30" name="sizeOption">
                    <span class="checkmark"></span>
                </label>
            </li>
            <li>
                <label class="container_radio">Extra Large<span>+ $8.30</span>
                    <input type="radio" value="8.30" name="sizeOption">
                    <span class="checkmark"></span>
                </label>
            </li>
        </ul>


        <h5>Wählen Sie weitere Zutaten für Ihr Wunschgericht.</h5>
        <ul class="clearfix" id="ingredientOptions">
            <li>
                <label class="container_check">Zwiebeln rot<span>+ $0.70</span>
                    <input type="checkbox" value="4.30" name="ingredientOption">
                    <span class="checkmark"></span>
                </label>
            </li>
            <li>
                <label class="container_check">Extra Peppers<span>+ $2.50</span>
                    <input type="checkbox" value="2.50" name="ingredientOption">
                    <span class="checkmark"></span>
                </label>
            </li>
            <li>
                <label class="container_check">Extra Ham<span>+ $4.30</span>
                    <input type="checkbox" value="4.30" name="ingredientOption">
                    <span class="checkmark"></span>
                </label>
            </li>
        </ul>
    </div>
    <div class="footer">
        <div class="row small-gutters">
            <div class="col-md-4">
                <button type="reset" class="btn_1 outline full-width mb-mobile">Cancel</button>
            </div>
            <div class="col-md-8">
                <button type="button" class="btn_1 full-width" onclick="addToCart()">Add to cart</button>
            </div>
        </div>
    </div>
</div>






@push('specific-header')
<style>
    .rounded {
    border-radius: 8px; /* Anpassen der Rundung nach Bedarf */
}

.shadow {
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Anpassen des Schattens nach Bedarf */
}

.row {
    --bs-gutter-x: 1.5rem;
    --bs-gutter-y: 0;
    display: flex;
    flex-wrap: wrap;
    margin-top: calc(-1* var(--bs-gutter-y));
    margin-right: calc(-.5* var(--bs-gutter-x));
    margin-left: calc(-.5* var(--bs-gutter-x));
    justify-content: space-evenly;
}
.zoom-effect {
    overflow: hidden; /* Verstecke den über den Rahmen hinausragenden Inhalt */
    border-radius: 10px; /* Füge abgerundete Ecken hinzu */
}

.zoom-effect img {
    transition: transform 0.3s ease; /* Füge eine Transitions-Eigenschaft hinzu, um den Übergang weich zu gestalten */
}

.zoom-effect:hover img {
    transform: scale(1.2); /* Vergrößere das Bild um 20% */
}
</style>
@endpush

        @push('specific-scripts')


            <!-- SPECIFIC SCRIPTS -->
    <script src="{{ asset('frontend/js/sticky_sidebar.min.js') }}"></script>
    <script src="{{ asset('frontend/js/sticky-kit.min.js') }}"></script>
    <script src="{{ asset('frontend/js/specific_detail.js') }}"></script>


    <script>
        $(document).ready(function() {
            $('.menu_item').click(function() {
                var product = {
                    id: 1,
                    name: "Product 1",
                    product_title: "Product 1 Title",
                    price: 10
                };
                $('#productTitle').text(product.product_title);
                // Setzen der Größenoptionen
                var sizeOptions = $('#sizeOptions');
                sizeOptions.find('input').each(function() {
                    $(this).change(function() {
                        product.price = 10 + parseFloat($(this).val());
                    });
                });
                // Setzen der Zutatenoptionen
                var ingredientOptions = $('#ingredientOptions');
                ingredientOptions.find('input').each(function() {
                    $(this).change(function() {
                        if ($(this).is(":checked")) {
                            product.price += parseFloat($(this).val());
                        } else {
                            product.price -= parseFloat($(this).val());
                        }
                    });
                });
                // Setzen des Produktpreises
                $('#qty').val(1); // Zurücksetzen der Menge
                $('#modal-dialog').data('product', product);
            });

            // Funktion zum Hinzufügen zum Warenkorb
            function addToCart() {
                var product = $('#modal-dialog').data('product');
                var quantity = $('#qty').val();
                var totalPrice = product.price * quantity;
                alert('Product ' + product.id + ' with quantity ' + quantity + ' added to cart. Total price: $' + totalPrice.toFixed(2));
                $.magnificPopup.close();
            }
        });
    </script>


        @endpush


        @endsection
