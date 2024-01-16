@extends('frontend.layouts.default')
@section('content')
    <!-- seitenabhengig css -->
    @push('specific-css')
        <link href="{{ asset('frontend/css/listing.css') }}" rel="stylesheet">
    @endpush

    <body>

        @include('frontend.includes.header-in-clearfix')





		<div class="page_header element_to_stick">
		    <div class="container">
		    	<div class="row">
		    		<div class="col-xl-8 col-lg-7 col-md-7 d-none d-md-block">
		        		<h1>145 restaurants in Convent Street 2983</h1>
		        		<a href="#0">Change address</a>
		    		</div>
		    		<div class="col-xl-4 col-lg-5 col-md-5">
		    			<div class="search_bar_list">
							<input type="text" class="form-control" placeholder="Dishes, restaurants or cuisines">
							<button type="submit"><i class="icon_search"></i></button>
						</div>
		    		</div>
		    	</div>
		    	<!-- /row -->
		    </div>
		</div>
		<!-- /page_header -->

		<div class="container margin_30_20">
			<div class="row">
				<aside class="col-lg-3" id="sidebar_fixed">
					<div class="type_delivery">
						<ul class="clearfix">
						    <li>
						        <label class="container_radio">Delivery
						            <input type="radio" name="type_d" checked="checked">
						            <span class="checkmark"></span>
						        </label>
						    </li>
						    <li>
						        <label class="container_radio">Take away
						            <input type="radio" name="type_d">
						            <span class="checkmark"></span>
						        </label>
						    </li>
						</ul>
					</div>
					<!-- /type_delivery -->

					<a href="#0" class="open_filters btn_filters"><i class="icon_adjust-vert"></i><span>Filters</span></a>

					<div class="filter_col">
						<div class="inner_bt clearfix">Filters<a href="#" class="open_filters"><i class="icon_close"></i></a></div>
						<div class="filter_type">
							<h4><a href="#filter_1" data-bs-toggle="collapse" class="opened">Sort</a></h4>
							<div class="collapse show" id="filter_1">
								<ul>
								    <li>
								        <label class="container_radio">Top Rated
								            <input type="radio" name="filter_sort" checked="">
								            <span class="checkmark"></span>
								        </label>
								    </li>
								    <li>
								        <label class="container_radio">Reccomended
								            <input type="radio" name="filter_sort">
								            <span class="checkmark"></span>
								        </label>
								    </li>
								    <li>
								        <label class="container_radio">Price: low to high
								            <input type="radio" name="filter_sort">
								            <span class="checkmark"></span>
								        </label>
								    </li>
								    <li>
								        <label class="container_radio">Up to 15% off
								            <input type="radio" name="filter_sort">
								            <span class="checkmark"></span>
								        </label>
								    </li>
								     <li>
								        <label class="container_radio">All Offers
								            <input type="radio" name="filter_sort">
								            <span class="checkmark"></span>
								        </label>
								    </li>
								    <li>
								        <label class="container_radio">Distance
								            <input type="radio" name="filter_sort">
								            <span class="checkmark"></span>
								        </label>
								    </li>
								</ul>
							</div>
						</div>
						<!-- /filter_type -->
						<div class="filter_type">
							<h4><a href="#filter_2" data-bs-toggle="collapse" class="closed">Categories</a></h4>
							<div class="collapse" id="filter_2">
								<ul>
								    <li>
								        <label class="container_check">Pizza - Italian <small>12</small>
								            <input type="checkbox">
								            <span class="checkmark"></span>
								        </label>
								    </li>
								    <li>
								        <label class="container_check">Japanese - Sushi <small>24</small>
								            <input type="checkbox">
								            <span class="checkmark"></span>
								        </label>
								    </li>
								    <li>
								        <label class="container_check">Burghers <small>23</small>
								            <input type="checkbox">
								            <span class="checkmark"></span>
								        </label>
								    </li>
								    <li>
								        <label class="container_check">Vegetarian <small>11</small>
								            <input type="checkbox">
								            <span class="checkmark"></span>
								        </label>
								    </li>
								    <li>
								        <label class="container_check">Bakery <small>18</small>
								            <input type="checkbox">
								            <span class="checkmark"></span>
								        </label>
								    </li>
								    <li>
								        <label class="container_check">Chinese <small>12</small>
								            <input type="checkbox">
								            <span class="checkmark"></span>
								        </label>
								    </li>
								    <li>
								        <label class="container_check">Mexican <small>15</small>
								            <input type="checkbox">
								            <span class="checkmark"></span>
								        </label>
								    </li>
								</ul>
							</div>
						</div>
						<!-- /filter_type -->
						<div class="filter_type">
							<h4><a href="#filter_3" data-bs-toggle="collapse" class="closed">Distance</a></h4>
							<div class="collapse" id="filter_3">
								<div class="distance">Radius around selected destination <span></span> km</div>
								<div class="add_bottom_25"><input type="range" min="10" max="50" step="5" value="20" data-orientation="horizontal"></div>
							</div>
						</div>
						<!-- /filter_type -->
						<div class="filter_type last">
							<h4><a href="#filter_4" data-bs-toggle="collapse" class="closed">Rating</a></h4>
							<div class="collapse" id="filter_4">
								<ul>
								    <li>
								        <label class="container_check">Superb 9+ <small>06</small>
								            <input type="checkbox">
								            <span class="checkmark"></span>
								        </label>
								    </li>
								    <li>
								        <label class="container_check">Very Good 8+ <small>12</small>
								            <input type="checkbox">
								            <span class="checkmark"></span>
								        </label>
								    </li>
								    <li>
								        <label class="container_check">Good 7+ <small>17</small>
								            <input type="checkbox">
								            <span class="checkmark"></span>
								        </label>
								    </li>
								    <li>
								        <label class="container_check">Pleasant 6+ <small>43</small>
								            <input type="checkbox">
								            <span class="checkmark"></span>
								        </label>
								    </li>
								</ul>
							</div>
						</div>
						<!-- /filter_type -->
						<p><a href="#0" class="btn_1 outline full-width">Filter</a></p>
					</div>
				</aside>

				<div class="col-lg-9">
					<div class="row">
						<div class="col-12">
							<h2 class="title_small">Top Categories</h2>
							<div class="owl-carousel owl-theme categories_carousel_in listing">
								<div class="item">
									<figure>
										<img src="{{ asset('frontend/img/cat_listing_placeholder.png') }}" data-src="{{ asset('frontend/img/cat_listing_1.jpg') }}" alt="" class="owl-lazy"></a>
										<a href="#0"><h3>Pizza</h3></a>
									</figure>
								</div>
								<div class="item">
									<figure>
										<img src="{{ asset('frontend/img/cat_listing_placeholder.png') }}" data-src="{{ asset('frontend/img/cat_listing_2.jpg') }}" alt="" class="owl-lazy"></a>
										<a href="#0"><h3>Sushi</h3></a>
									</figure>
								</div>
								<div class="item">
									<figure>
										<img src="{{ asset('frontend/img/cat_listing_placeholder.png') }}" data-src="{{ asset('frontend/img/cat_listing_3.jpg') }}" alt="" class="owl-lazy"></a>
										<a href="#0"><h3>Dessert</h3></a>
									</figure>
								</div>
								<div class="item">
									<figure>
										<img src="{{ asset('frontend/img/cat_listing_placeholder.png') }}" data-src="{{ asset('frontend/img/cat_listing_4.jpg') }}" alt="" class="owl-lazy"></a>
										<a href="#0"><h3>Hamburgher</h3></a>
									</figure>
								</div>
								<div class="item">
									<figure>
										<img src="{{ asset('frontend/img/cat_listing_placeholder.png') }}" data-src="{{ asset('frontend/img/cat_listing_5.jpg') }}" alt="" class="owl-lazy"></a>
										<a href="#0"><h3>Ice Cream</h3></a>
									</figure>
								</div>
								<div class="item">
									<figure>
										<img src="{{ asset('frontend/img/cat_listing_placeholder.png') }}" data-src="{{ asset('frontend/img/cat_listing_6.jpg') }}" alt="" class="owl-lazy"></a>
										<a href="#0"><h3>Kebab</h3></a>
									</figure>
								</div>
								<div class="item">
									<figure>
										<img src="{{ asset('frontend/img/cat_listing_placeholder.png') }}" data-src="{{ asset('frontend/img/cat_listing_7.jpg') }}" alt="" class="owl-lazy"></a>
										<a href="#0"><h3>Italian</h3></a>
									</figure>
								</div>
								<div class="item">
									<figure>
										<img src="{{ asset('frontend/img/cat_listing_placeholder.png') }}" data-src="{{ asset('frontend/img/cat_listing_8.jpg') }}" alt="" class="owl-lazy"></a>
										<a href="#0"><h3>Chinese</h3></a>
									</figure>
								</div>
							</div>
							<!-- /carousel -->
						</div>
					</div>
					<!-- /row -->

					<div class="promo">
						<h3>Free Delivery for your first 14 days!</h3>
						<p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip.</p>
						<i class="icon-food_icon_delivery"></i>
					</div>
					<!-- /promo -->

					<div class="row">
						<div class="col-12"><h2 class="title_small">Top Rated</h2></div>
						<div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
							<div class="strip">
							    <figure>
							    	<span class="ribbon off">15% off</span>
							        <img src="{{ asset('frontend/img/lazy-placeholder.png') }}" data-src="{{ asset('frontend/img/location_1.jpg') }}" class="img-fluid lazy" alt="">
							        <a href="{{ url('/detail-restaurant') }}" class="strip_info">
							            <small>Pizza</small>
							            <div class="item_title">
							                <h3>Da Alfredo</h3>
							                <small>27 Old Gloucester St</small>
							            </div>
							        </a>
							    </figure>
							    <ul>
							        <li><span class="take yes">Takeaway</span> <span class="deliv yes">Delivery</span></li>
							        <li>
							        	<div class="score"><strong>8.9</strong></div>
							        </li>
							    </ul>
							</div>
						</div>
						<!-- /strip grid -->
						<div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
							<div class="strip">
							    <figure>
							        <img src="{{ asset('frontend/img/lazy-placeholder.png') }}" data-src="{{ asset('frontend/img/location_2.jpg') }}" class="img-fluid lazy" alt="">
							        <a href="{{ url('/detail-restaurant') }}" class="strip_info">
							            <small>Burghers</small>
							            <div class="item_title">
							                <h3>Best Burghers</h3>
							                <small>27 Old Gloucester St</small>
							            </div>
							        </a>
							    </figure>
							    <ul>
							        <li><span class="take no">Takeaway</span> <span class="deliv yes">Delivery</span></li>
							        <li>
							        	<div class="score"><strong>9.5</strong></div>
							        </li>
							    </ul>
							</div>
						</div>
						<!-- /strip grid -->
						<div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
							<div class="strip">
							    <figure>
							    	<span class="ribbon off">15% off</span>
							        <img src="{{ asset('frontend/img/lazy-placeholder.png') }}" data-src="{{ asset('frontend/img/location_3.jpg') }}" class="img-fluid lazy" alt="">
							        <a href="{{ url('/detail-restaurant') }}" class="strip_info">
							            <small>Vegetarian</small>
							            <div class="item_title">
							                <h3>Vego Life</h3>
							                <small>27 Old Gloucester St</small>
							            </div>
							        </a>
							    </figure>
							    <ul>
							       <li><span class="take yes">Takeaway</span> <span class="deliv no">Delivery</span></li>
							        <li>
							        	<div class="score"><strong>7.5</strong></div>
							        </li>
							    </ul>
							</div>
						</div>
						<!-- /strip grid -->
						<div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
							<div class="strip">
							    <figure>
							        <img src="{{ asset('frontend/img/lazy-placeholder.png') }}" data-src="{{ asset('frontend/img/location_4.jpg') }}" class="img-fluid lazy" alt="">
							        <a href="{{ url('/detail-restaurant') }}" class="strip_info">
							            <small>Japanese</small>
							            <div class="item_title">
							                <h3>Sushi Temple</h3>
							                <small>27 Old Gloucester St</small>
							            </div>
							        </a>
							    </figure>
							    <ul>
							         <li><span class="take no">Takeaway</span> <span class="deliv no">Delivery</span></li>
							        <li>
							        	<div class="score"><strong>9.5</strong></div>
							        </li>
							    </ul>
							</div>
						</div>
						<!-- /strip grid -->
						<div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
							<div class="strip">
							    <figure>
							        <img src="{{ asset('frontend/img/lazy-placeholder.png') }}" data-src="{{ asset('frontend/img/location_5.jpg') }}" class="img-fluid lazy" alt="">
							        <a href="{{ url('/detail-restaurant') }}" class="strip_info">
							            <small>Pizza</small>
							            <div class="item_title">
							                <h3>Auto Pizza</h3>
							                <small>27 Old Gloucester St</small>
							            </div>
							        </a>
							    </figure>
							    <ul>
							         <li><span class="take yes">Takeaway</span> <span class="deliv no">Delivery</span></li>
							        <li>
							        	<div class="score"><strong>7.0</strong></div>
							        </li>
							    </ul>
							</div>
						</div>
						<!-- /strip grid -->
						<div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
							<div class="strip">
							    <figure>
							        <img src="{{ asset('frontend/img/lazy-placeholder.png') }}" data-src="{{ asset('frontend/img/location_6.jpg') }}" class="img-fluid lazy" alt="">
							        <a href="{{ url('/detail-restaurant') }}" class="strip_info">
							            <small>Burghers</small>
							            <div class="item_title">
							                <h3>Alliance</h3>
							                <small>27 Old Gloucester St</small>
							            </div>
							        </a>
							    </figure>
							    <ul>
							         <li><span class="take no">Takeaway</span> <span class="deliv yes">Delivery</span></li>
							        <li>
							        	<div class="score"><strong>8.9</strong></div>
							        </li>
							    </ul>
							</div>
						</div>
						<!-- /strip grid -->
						<div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
							<div class="strip">
							    <figure>
							        <img src="{{ asset('frontend/img/lazy-placeholder.png') }}" data-src="{{ asset('frontend/img/location_7.jpg') }}" class="img-fluid lazy" alt="">
							        <a href="{{ url('/detail-restaurant') }}" class="strip_info">
							            <small>Chinese</small>
							            <div class="item_title">
							                <h3>Alliance</h3>
							                <small>27 Old Gloucester St</small>
							            </div>
							        </a>
							    </figure>
							    <ul>
							        <li><span class="take no">Takeaway</span> <span class="deliv yes">Delivery</span></li>
							        <li>
							        	<div class="score"><strong>8.9</strong></div>
							        </li>
							    </ul>
							</div>
						</div>
						<!-- /strip grid -->
						<div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
							<div class="strip">
							    <figure>
							        <img src="{{ asset('frontend/img/lazy-placeholder.png') }}" data-src="{{ asset('frontend/img/location_8.jpg') }}" class="img-fluid lazy" alt="">
							        <a href="{{ url('/detail-restaurant') }}" class="strip_info">
							            <small>Sushi</small>
							            <div class="item_title">
							                <h3>Dragon Tower</h3>
							                <small>27 Old Gloucester St</small>
							            </div>
							        </a>
							    </figure>
							    <ul>
							        <li><span class="take yes">Takeaway</span> <span class="deliv no">Delivery</span></li>
							        <li>
							        	<div class="score"><strong>8.9</strong></div>
							        </li>
							    </ul>
							</div>
						</div>
						<!-- /strip grid -->
						<div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
							<div class="strip">
							    <figure>
							        <img src="{{ asset('frontend/img/lazy-placeholder.png') }}" data-src="{{ asset('frontend/img/location_9.jpg') }}" class="img-fluid lazy" alt="">
							        <a href="{{ url('/detail-restaurant') }}" class="strip_info">
							            <small>Mexican</small>
							            <div class="item_title">
							                <h3>El Paso Tacos</h3>
							                <small>27 Old Gloucester St</small>
							            </div>
							        </a>
							    </figure>
							    <ul>
							        <li><span class="take yes">Takeaway</span> <span class="deliv yes">Delivery</span></li>
							        <li>
							        	<div class="score"><strong>8.9</strong></div>
							        </li>
							    </ul>
							</div>
						</div>
						<!-- /strip grid -->
						<div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
							<div class="strip">
							    <figure>
							        <img src="{{ asset('frontend/img/lazy-placeholder.png') }}" data-src="{{ asset('frontend/img/location_10.jpg') }}" class="img-fluid lazy" alt="">
							        <a href="{{ url('/detail-restaurant') }}" class="strip_info">
							            <small>Bakery</small>
							            <div class="item_title">
							                <h3>Monnalisa</h3>
							                <small>27 Old Gloucester St</small>
							            </div>
							        </a>
							    </figure>
							    <ul>
							        <li><span class="take yes">Takeaway</span> <span class="deliv yes">Delivery</span></li>
							        <li>
							        	<div class="score"><strong>8.9</strong></div>
							        </li>
							    </ul>
							</div>
						</div>
						<!-- /strip grid -->
						<div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
							<div class="strip">
							    <figure>
							        <img src="{{ asset('frontend/img/lazy-placeholder.png') }}" data-src="{{ asset('frontend/img/location_11.jpg') }}" class="img-fluid lazy" alt="">
							        <a href="{{ url('/detail-restaurant') }}" class="strip_info">
							            <small>Mexican</small>
							            <div class="item_title">
							                <h3>Guachamole</h3>
							                <small>135 Newtownards Road</small>
							            </div>
							        </a>
							    </figure>
							    <ul>
							        <li><span class="take yes">Takeaway</span> <span class="deliv yes">Delivery</span></li>
							        <li>
							        	<div class="score"><strong>8.9</strong></div>
							        </li>
							    </ul>
							</div>
						</div>
						<!-- /strip grid -->
						<div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
							<div class="strip">
							    <figure>
							        <img src="{{ asset('frontend/img/lazy-placeholder.png') }}" data-src="{{ asset('frontend/img/location_12.jpg') }}" class="img-fluid lazy" alt="">
							        <a href="{{ url('/detail-restaurant') }}" class="strip_info">
							            <small>Chinese</small>
							            <div class="item_title">
							                <h3>Pechino Express</h3>
							                <small>27 Old Gloucester St</small>
							            </div>
							        </a>
							    </figure>
							    <ul>
							        <li><span class="take no">Takeaway</span> <span class="deliv yes">Delivery</span></li>
							        <li>
							        	<div class="score"><strong>8.9</strong></div>
							        </li>
							    </ul>
							</div>
						</div>
						<!-- /strip grid -->
					</div>
					<!-- /row -->
					<div class="pagination_fg">
					  <a href="#">&laquo;</a>
					  <a href="#" class="active">1</a>
					  <a href="#">2</a>
					  <a href="#">3</a>
					  <a href="#">4</a>
					  <a href="#">5</a>
					  <a href="#">&raquo;</a>
					</div>
				</div>
				<!-- /col -->
			</div>
		</div>
		<!-- /container -->















        @push('specific-scripts')


            <!-- SPECIFIC SCRIPTS -->
    <script src="{{ asset('frontend/js/sticky_sidebar.min.js') }}"></script>
    <script src="{{ asset('frontend/js/specific_listing.js') }}"></script>

        @endpush
    @endsection
