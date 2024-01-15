@extends('frontend.layouts.default')
@section('content')
    <!-- seitenabhengig css -->
    @push('specific-css')
        <link href="{{ asset('frontend/css/detail-page.css') }}" rel="stylesheet">
    @endpush

    <body data-spy="scroll" data-bs-target="#secondary_nav" data-offset="75">

        @include('frontend.includes.header-in-clearfix')


		<div class="hero_in detail_page background-image" data-background="url(img/hero_general.jpg)">
			<div class="wrapper opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.5)">

				<div class="container">
					<div class="main_info">
						<div class="row">
							<div class="col-xl-4 col-lg-5 col-md-6">
								<div class="head"><div class="score"><span>Superb<em>350 Reviews</em></span><strong>8.9</strong></div></div>
								<h1>Pizzeria da Alfredo</h1>
								ITALIAN - 27 Old Gloucester St, 4530 - <a href="https://www.google.com/maps/dir//Assistance+%E2%80%93+H%C3%B4pitaux+De+Paris,+3+Avenue+Victoria,+75004+Paris,+Francia/@48.8606548,2.3348734,14z/data=!4m15!1m6!3m5!1s0x47e66e1de36f4147:0xb6615b4092e0351f!2sAssistance+Publique+-+H%C3%B4pitaux+de+Paris+(AP-HP)+-+Si%C3%A8ge!8m2!3d48.8568376!4d2.3504305!4m7!1m0!1m5!1m1!1s0x47e67031f8c20147:0xa6a9af76b1e2d899!2m2!1d2.3504327!2d48.8568361" target="blank">Get directions</a>
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
		            <li><a href="#section-1">Starters</a></li>
		            <li><a href="#section-2">Main Courses</a></li>
		            <li><a href="#section-3">Desserts</a></li>
		            <li><a href="#section-4">Drinks</a></li>
		            <li><a href="#section-5"><i class="icon_chat_alt"></i>Reviews</a></li>
		        </ul>
		    </div>
		    <span></span>
		</nav>
		<!-- /secondary_nav -->

		<div class="bg_gray">
		    <div class="container margin_detail">
		        <div class="row">
		            <div class="col-lg-8 list_menu">
		                <section id="section-1">
		                    <h4>Starters</h4>
		                    <div class="row">
		                        <div class="col-md-6">
		                            <a class="menu_item modal_dialog" href="#modal-dialog">
		                                <figure><img src="{{ asset('frontend/img/menu-thumb-placeholder.jpg') }}" data-src="{{ asset('frontend/img/menu-thumb-1.jpg') }}" alt="thumb" class="lazy"></figure>
		                                <h3>1. Mexican Enchiladas</h3>
		                                <p>Fuisset mentitum deleniti sit ea.</p>
		                                <strong>$9.40</strong>
		                            </a>
		                        </div>
		                        <div class="col-md-6">
		                            <a class="menu_item modal_dialog" href="#modal-dialog">
		                                <figure><img src="{{ asset('frontend/img/menu-thumb-placeholder.jpg') }}" data-src="{{ asset('frontend/img/menu-thumb-2.jpg') }}" alt="thumb" class="lazy"></figure>
		                                <h3>2. Fajitas</h3>
		                                <p>Fuisset mentitum deleniti sit ea.</p>
		                                <strong>$9.40</strong>
		                            </a>
		                        </div>
		                        <div class="col-md-6">
		                            <a class="menu_item modal_dialog" href="#modal-dialog">
		                                <figure><img src="{{ asset('frontend/img/menu-thumb-placeholder.jpg') }}" data-src="{{ asset('frontend/img/menu-thumb-3.jpg') }}" alt="thumb" class="lazy"></figure>
		                                <h3>3. Royal Fajitas</h3>
		                                <p>Fuisset mentitum deleniti sit ea.</p>
		                                <strong>$9.40</strong>
		                            </a>
		                        </div>
		                        <div class="col-md-6">
		                            <a class="menu_item modal_dialog" href="#modal-dialog">
		                                <figure><img src="{{ asset('frontend/img/menu-thumb-placeholder.jpg') }}" data-src="{{ asset('frontend/img/menu-thumb-4.jpg') }}" alt="thumb" class="lazy"></figure>
		                                <h3>4. Chicken Enchilada Wrap</h3>
		                                <p>Fuisset mentitum deleniti sit ea.</p>
		                                <strong>$9.40</strong>
		                            </a>
		                        </div>
		                    </div>
		                    <!-- /row -->
		                </section>
		                <!-- /section -->
		                <section id="section-2">
		                    <h4>Main Courses</h4>
		                    <div class="row">
		                        <div class="col-md-6">
		                            <a class="menu_item modal_dialog" href="#modal-dialog">
		                                <figure><img src="{{ asset('frontend/img/menu-thumb-placeholder.jpg') }}" data-src="{{ asset('frontend/img/menu-thumb-5.jpg') }}" alt="thumb" class="lazy"></figure>
		                                <h3>5. Cheese Quesadilla</h3>
		                                <p>Fuisset mentitum deleniti sit ea.</p>
		                                <strong>$9.40</strong>
		                            </a>
		                        </div>
		                        <div class="col-md-6">
		                            <a class="menu_item modal_dialog" href="#modal-dialog">
		                                <figure><img src="{{ asset('frontend/img/menu-thumb-placeholder.jpg') }}" data-src="{{ asset('frontend/img/menu-thumb-6.jpg') }}" alt="thumb" class="lazy"></figure>
		                                <h3>6. Chorizo & Cheese</h3>
		                                <p>Fuisset mentitum deleniti sit ea.</p>
		                                <strong>$9.40</strong>
		                            </a>
		                        </div>
		                        <div class="col-md-6">
		                            <a class="menu_item modal_dialog" href="#modal-dialog">
		                                <figure><img src="{{ asset('frontend/img/menu-thumb-placeholder.jpg') }}" data-src="{{ asset('frontend/img/menu-thumb-7.jpg') }}" alt="thumb" class="lazy"></figure>
		                                <h3>7. Beef Taco</h3>
		                                <p>Fuisset mentitum deleniti sit ea.</p>
		                                <strong>$9.40</strong>
		                            </a>
		                        </div>
		                        <div class="col-md-6">
		                            <a class="menu_item modal_dialog" href="#modal-dialog">
		                                <figure><img src="{{ asset('frontend/img/menu-thumb-placeholder.jpg') }}" data-src="{{ asset('frontend/img/menu-thumb-8.jpg') }}" alt="thumb" class="lazy"></figure>
		                                <h3>8. Minced Beef Double Layer</h3>
		                                <p>Fuisset mentitum deleniti sit ea.</p>
		                                <strong>$9.40</strong>
		                            </a>
		                        </div>
		                        <div class="col-md-6">
		                            <a class="menu_item modal_dialog" href="#modal-dialog">
		                                <figure><img src="{{ asset('frontend/img/menu-thumb-placeholder.jpg') }}" data-src="{{ asset('frontend/img/menu-thumb-9.jpg') }}" alt="thumb" class="lazy"></figure>
		                                <h3>9. Piri Piri Chicken</h3>
		                                <p>Fuisset mentitum deleniti sit ea.</p>
		                                <strong>$9.40</strong>
		                            </a>
		                        </div>
		                        <div class="col-md-6">
		                            <a class="menu_item modal_dialog" href="#modal-dialog">
		                                <figure><img src="{{ asset('frontend/img/menu-thumb-placeholder.jpg') }}" data-src="{{ asset('frontend/img/menu-thumb-10.jpg') }}" alt="thumb" class="lazy"></figure>
		                                <h3>10. Burrito Al Pastor</h3>
		                                <p>Fuisset mentitum deleniti sit ea.</p>
		                                <strong>$9.40</strong>
		                            </a>
		                        </div>
		                    </div>
		                    <!-- /row -->
		                </section>
		                <!-- /section -->
		                <section id="section-3">
		                    <h4>Desserts</h4>
		                    <div class="row">
		                        <div class="col-md-6">
		                            <a class="menu_item modal_dialog" href="#modal-dialog">
		                                <figure><img src="{{ asset('frontend/img/menu-thumb-placeholder.jpg') }}" data-src="{{ asset('frontend/img/menu-thumb-5.jpg') }}" alt="thumb" class="lazy"></figure>
		                                <h3>5. Cheese Quesadilla</h3>
		                                <p>Fuisset mentitum deleniti sit ea.</p>
		                                <strong>$9.40</strong>
		                            </a>
		                        </div>
		                        <div class="col-md-6">
		                            <a class="menu_item modal_dialog" href="#modal-dialog">
		                                <figure><img src="{{ asset('frontend/img/menu-thumb-placeholder.jpg') }}" data-src="{{ asset('frontend/img/menu-thumb-6.jpg') }}" alt="thumb" class="lazy"></figure>
		                                <h3>6. Chorizo & Cheese</h3>
		                                <p>Fuisset mentitum deleniti sit ea.</p>
		                                <strong>$9.40</strong>
		                            </a>
		                        </div>
		                        <div class="col-md-6">
		                            <a class="menu_item modal_dialog" href="#modal-dialog">
		                                <figure><img src="{{ asset('frontend/img/menu-thumb-placeholder.jpg') }}" data-src="{{ asset('frontend/img/menu-thumb-7.jpg') }}" alt="thumb" class="lazy"></figure>
		                                <h3>7. Beef Taco</h3>
		                                <p>Fuisset mentitum deleniti sit ea.</p>
		                                <strong>$9.40</strong>
		                            </a>
		                        </div>
		                        <div class="col-md-6">
		                            <a class="menu_item modal_dialog" href="#modal-dialog">
		                                <figure><img src="{{ asset('frontend/img/menu-thumb-placeholder.jpg') }}" data-src="{{ asset('frontend/img/menu-thumb-8.jpg') }}" alt="thumb" class="lazy"></figure>
		                                <h3>8. Minced Beef Double Layer</h3>
		                                <p>Fuisset mentitum deleniti sit ea.</p>
		                                <strong>$9.40</strong>
		                            </a>
		                        </div>
		                        <div class="col-md-6">
		                            <a class="menu_item modal_dialog" href="#modal-dialog">
		                                <figure><img src="{{ asset('frontend/img/menu-thumb-placeholder.jpg') }}" data-src="{{ asset('frontend/img/menu-thumb-9.jpg') }}" alt="thumb" class="lazy"></figure>
		                                <h3>9. Piri Piri Chicken</h3>
		                                <p>Fuisset mentitum deleniti sit ea.</p>
		                                <strong>$9.40</strong>
		                            </a>
		                        </div>
		                        <div class="col-md-6">
		                            <a class="menu_item modal_dialog" href="#modal-dialog">
		                                <figure><img src="{{ asset('frontend/img/menu-thumb-placeholder.jpg') }}" data-src="{{ asset('frontend/img/menu-thumb-10.jpg') }}" alt="thumb" class="lazy"></figure>
		                                <h3>10. Burrito Al Pastor</h3>
		                                <p>Fuisset mentitum deleniti sit ea.</p>
		                                <strong>$9.40</strong>
		                            </a>
		                        </div>
		                    </div>
		                    <!-- /row -->
		                </section>
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
		                        <h3>Contact Us</h3>
		                    	<small>Or Call us at 0434 3432245</small>
		                        <a href="#0" class="close_panel_mobile"><i class="icon_close"></i></a>
		                    </div>
		                    <!-- /head -->
		                    <div class="main">
		                         <div id="message-detail-contact"></div>
				                    <form method="post" action="assets/detail_contact.php" id="detail_contact" autocomplete="off">
				                    	<input type="text" name="restaurant_name" id="restaurant_name" value="Pizzeria Da Aldredo" hidden="hidden">
				                    	<div class="form-group">
				                    		<input type="text" name="name_detail_contact" id="name_detail_contact" class="form-control" placeholder="Name and Last Name">
					                    </div>
					                    <div class="form-group">
					                    	<input type="email" name="email_detail_contact" id="email_detail_contact" class="form-control" placeholder="Email address">
					                    </div>
					                    <div class="form-group">
					                    	<input type="text" name="telephone_detail_contact" id="telephone_detail_contact" class="form-control" placeholder="Telephone">
					                    </div>
					                    <div class="form-group add_bottom_15">
					                    	<textarea class="form-control" name="message_detail" id="message_detail" placeholder="Your message"></textarea>
					                    </div>
					                     <div class="btn_1_mobile" style="position: relative;">
					                    	<input class="btn_1 gradient full-width" type="submit" value="Send message" id="submit-message">
						               </div>
				                    </form>
				                </div>
		                </div>
		                <!-- /box_order -->
		                <div class="btn_reserve_fixed"><a href="#0" class="btn_1 gradient full-width">Send a Message</a></div>
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
<!-- Modal item details -->
<div id="modal-dialog" class="zoom-anim-dialog mfp-hide">
    <div class="small-dialog-header">
        <h3>Cheese Quesadilla</h3>
    </div>
    <div class="content pb-1">
    	<figure><img src="{{ asset('frontend/img/menu_item_large_1.jpg') }}" alt="" class="img-fluid"></figure>
       <h6 class="mb-1">Ingredients</h6>
       <p>Carrot, tomatoes, mushrooms, onions, olives, beans, peppers, spinach.</p>
       <h6 class="mb-1">Nutritional values</h6>
       <p>Calories: 380. Fat: 18 grams. Carbs: 39 grams.</p>
    </div>
</div>
<!-- /Modal item details  -->

        @push('specific-scripts')

            <!-- SPECIFIC SCRIPTS -->
    <script src="{{ asset('frontend/js/sticky_sidebar.min.js') }}"></script>
    <script src="{{ asset('frontend/js/sticky-kit.min.js') }}"></script>
    <script src="{{ asset('frontend/js/specific_detail.js') }}"></script>

        @endpush
        @endsection
