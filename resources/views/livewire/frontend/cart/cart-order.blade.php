<div>
    {{-- The Master doesn't talk, he acts. --}}

	<main class="bg_gray">

		<div class="container margin_60_20">
		    <div class="row justify-content-center">
		        <div class="col-xl-6 col-lg-8">
		        	<div class="box_order_form">
					    <div class="head">
					        <div class="title">
					            <h3>Personal Details</h3>
					        </div>
					    </div>
					    <!-- /head -->
					    <div class="main">
					        <div class="form-group">
					            <label>First and Last Name</label>
					            <input class="form-control" placeholder="First and Last Name">
					        </div>
					        <div class="row">
					            <div class="col-md-6">
					                <div class="form-group">
					                    <label>Email Address</label>
					                    <input class="form-control" placeholder="Email Address">
					                </div>
					            </div>
					            <div class="col-md-6">
					                <div class="form-group">
					                    <label>Phone</label>
					                    <input class="form-control" placeholder="Phone">
					                </div>
					            </div>
					        </div>
					        <div class="form-group">
					            <label>Full Address</label>
					            <input class="form-control" placeholder="Full Address">
					        </div>
					        <div class="row">
					            <div class="col-md-6">
					                <div class="form-group">
					                    <label>City</label>
					                    <input class="form-control" placeholder="City">
					                </div>
					            </div>
					            <div class="col-md-3">
					                <div class="form-group">
					                    <label>Postal Code</label>
					                    <input class="form-control" placeholder="0123">
					                </div>
					            </div>
					        </div>
					    </div>
					</div>
					<!-- /box_order_form -->
		            <div class="box_order_form">
					    <div class="head">
					        <div class="title">
					            <h3>Payment Method</h3>
					        </div>
					    </div>
					    <!-- /head -->
					    <div class="main">
					        <div class="payment_select">
					            <label class="container_radio">Credit Card
					                <input type="radio" value="" checked name="payment_method">
					                <span class="checkmark"></span>
					            </label>
					            <i class="icon_creditcard"></i>
					        </div>
					        <div class="form-group">
					            <label>Name on card</label>
					            <input type="text" class="form-control" id="name_card_order" name="name_card_order" placeholder="First and last name">
					        </div>
					        <div class="form-group">
					            <label>Card number</label>
					            <input type="text" id="card_number" name="card_number" class="form-control" placeholder="Card number">
					        </div>
					        <div class="row">
					            <div class="col-md-6">
					                <label>Expiration date</label>
					                <div class="row">
					                    <div class="col-md-6 col-6">
					                        <div class="form-group">
					                            <input type="text" id="expire_month" name="expire_month" class="form-control" placeholder="mm">
					                        </div>
					                    </div>
					                    <div class="col-md-6 col-6">
					                        <div class="form-group">
					                            <input type="text" id="expire_year" name="expire_year" class="form-control" placeholder="yyyy">
					                        </div>
					                    </div>
					                </div>
					            </div>
					            <div class="col-md-6 col-sm-12">
					                <div class="form-group">
					                    <label>Security code</label>
					                    <div class="row">
					                        <div class="col-md-4 col-6">
					                            <div class="form-group">
					                                <input type="text" id="ccv" name="ccv" class="form-control" placeholder="CCV">
					                            </div>
					                        </div>
					                        <div class="col-md-8 col-6">
					                            <img src="img/icon_ccv.gif" width="50" height="29" alt="ccv"><small>Last 3 digits</small>
					                        </div>
					                    </div>
					                </div>
					            </div>
					        </div>
					        <!--End row -->
					        <div class="payment_select" id="paypal">
					            <label class="container_radio">Pay with Paypal
					                <input type="radio" value="" name="payment_method">
					                <span class="checkmark"></span>
					            </label>
					        </div>
					        <div class="payment_select">
					            <label class="container_radio">Pay with Cash
					                <input type="radio" value="" name="payment_method">
					                <span class="checkmark"></span>
					            </label>
					            <i class="icon_wallet"></i>
					        </div>
					    </div>
					</div>
					<!-- /box_order_form -->
		        </div>
		        <!-- /col -->
		        <div class="col-xl-4 col-lg-4" id="sidebar_fixed">
		            <div class="box_order">
		                <div class="head">
		                    <h3>Order Summary</h3>
		                    <div>Pizzeria da Alfredo</div>
		                </div>
		                <!-- /head -->
		                <div class="main">
		                	<ul>
		                		<li>Date<span>Today 23/11/2019</span></li>
		                		<li>Hour<span>08.30pm</span></li>
		                		<li>Type<span>Delivery</span></li>
		                	</ul>
		                	<hr>
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
		                    <a href="confirm.html" class="btn_1 gradient full-width mb_5">Order Now</a>
		                    <div class="text-center"><small>Or Call Us at <strong>0432 48432854</strong></small></div>
		                </div>
		            </div>
		            <!-- /box_booking -->
		        </div>

		    </div>
		    <!-- /row -->
		</div>
		<!-- /container -->

	</main>
	<!-- /main -->



</div>
