@extends('frontend.layouts.default')
@section('content')
    <!-- seitenabhengig css -->
    @push('specific-css')
        <link href="{{ asset('frontend/css/submit.css') }}" rel="stylesheet">
    @endpush

    <body>

        @include('frontend.includes.header-in-clearfix')


		<div class="hero_single inner_pages background-image" data-background="url({{ asset('frontend/img/home_section_2.jpg)') }}">
			<div class="opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.6)">
				<div class="container">
					<div class="row justify-content-center">
						<div class="col-lg-10">
							<h1>Attract New Customers</h1>
							<p>More bookings from diners around the corner</p>
							<a href="#submit" class="btn_1 gradient btn_scroll">Submit Now</a>
						</div>
					</div>
					<!-- /row -->
				</div>
			</div>
			<div class="wave hero"></div>
		</div>
		<!-- /hero_single -->

			<div class="container margin_30_20">
			<div class="main_title center">
				<span><em></em></span>
				<h2>Why Submit to FooYes</h2>
				<p>Cum doctus civibus efficiantur in imperdiet deterruisset.</p>
			</div>

			<div class="row justify-content-center align-items-center add_bottom_15">
					<div class="col-lg-6">
						<div class="box_about">
							<h3>Boost your Bookings</h3>
							<p class="lead">Est falli invenire interpretaris id, magna libris sensibus mel id.</p>
							<p>Per eu nostrud feugiat. Et quo molestiae persecuti neglegentur. At zril definitionem mei, vel ei choro volumus. An tota nulla soluta has, ei nec essent audiam, te nisl dignissim vel. Ex velit audire perfecto pro, ei mei doming vivendo legendos. Cu sit magna zril, an odio delectus constituto vis. Vis ludus omnesque ne, est veri quaeque ad.</p>
							<img src="{{ asset('frontend/img/arrow_about.png') }}" alt="" class="arrow_1">
						</div>
					</div>
					<div class="col-lg-6 text-center d-none d-lg-block">
							<img src="{{ asset('frontend/img/about_1.svg') }}" alt="" class="img-fluid" width="250" height="250">
					</div>
				</div>
				<!-- /row -->
				<div class="row justify-content-center align-items-center add_bottom_15">
					<div class="col-lg-6 text-center d-none d-lg-block">
							<img src="{{ asset('frontend/img/about_2.svg') }}" alt="" class="img-fluid" width="250" height="250">
					</div>
					<div class="col-lg-6">
						<div class="box_about">
							<h3>Manage Easly</h3>
							<p class="lead">Est falli invenire interpretaris id, magna libris sensibus mel id.</p>
							<p>Per eu nostrud feugiat. Et quo molestiae persecuti neglegentur. At zril definitionem mei, vel ei choro volumus. An tota nulla soluta has, ei nec essent audiam, te nisl dignissim vel. Ex velit audire perfecto pro, ei mei doming vivendo legendos. Cu sit magna zril, an odio delectus constituto vis. Vis ludus omnesque ne, est veri quaeque ad.</p>
							<img src="{{ asset('frontend/img/arrow_about.png') }}" alt="" class="arrow_2">
						</div>
					</div>
				</div>
				<!-- /row -->
				<div class="row justify-content-center align-items-center">
					<div class="col-lg-6">
						<div class="box_about">
							<h3>Reach New Customers</h3>
							<p class="lead">Est falli invenire interpretaris id, magna libris sensibus mel id.</p>
							<p>Per eu nostrud feugiat. Et quo molestiae persecuti neglegentur. At zril definitionem mei, vel ei choro volumus. An tota nulla soluta has, ei nec essent audiam, te nisl dignissim vel. Ex velit audire perfecto pro, ei mei doming vivendo legendos. Cu sit magna zril, an odio delectus constituto vis. Vis ludus omnesque ne, est veri quaeque ad.</p>
						</div>

					</div>
					<div class="col-lg-6 text-center d-none d-lg-block">
							<img src="{{ asset('frontend/img/about_3.svg') }}" alt="" class="img-fluid" width="250" height="250">
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->

	<div class="bg_gray">
		<div class="container margin_60_40">
			<div class="main_title center">
				<span><em></em></span>
				<h2>Our Pricing Plans</h2>
				<p>Cum doctus civibus efficiantur in imperdiet deterruisset.</p>
			</div>
				 <div class="row plans">
                <div class="plan col-md-4">
                	<div class="plan-title">
	                    <h3>1 Month</h3>
	                    <p>Free of charge one standard listing</p>
                	</div>
                    <p class="plan-price">Free</p>
                    <ul class="plan-features">
                        <li><strong>Check and go</strong> included</li>
                        <li><strong>1 month</strong> valid</li>
                        <li><strong>Unsubscribe</strong> anytime</li>
                    </ul>
                    <a href="#submit" class="btn_1 gray btn_scroll">Submit</a>
                </div> <!-- End col-md-4 -->

                <div class="plan plan-tall col-md-4">
                	<div class="plan-title">
	                    <h3>6 Months</h3>
	                    <p>One time fee for one listing, highlighted in search results</p>
                	</div>
                    <p class="plan-price">$199</p>
                    <ul class="plan-features">
                    	<li><strong>Premium</strong> support</li>
                        <li><strong>Check and go</strong> included</li>
                         <li><strong>APP</strong> included</li>
                        <li><strong>6 months</strong> valid</li>
                        <li><strong>Unsubscribe</strong> anytime</li>
                    </ul>
                    <a href="#submit" class="btn_1 gradient btn_scroll">Submit</a>
                </div><!-- End col-md-4 -->

                <div class="plan col-md-4">
                   <div class="plan-title">
	                    <h3>12 Months</h3>
	                    <p>Monthly subscription for unlimited listings</p>
                	</div>
                    <p class="plan-price">$299</p>
                    <ul class="plan-features">
                    	<li><strong>Premium</strong> support</li>
                        <li><strong>Check and go</strong> included</li>
                        <li><strong>12 months</strong> valid</li>
                        <li><strong>Unsubscribe</strong> anytime</li>
                    </ul>
                    <a href="#submit" class="btn_1 gray btn_scroll">Submit</a>
                </div><!-- End col-md-4 -->
            </div><!-- End row plans-->
		</div>
		<!-- /container -->
	</div>

			<div class="container margin_60_20" id="submit">
				<div class="row justify-content-center">
					<div class="col-lg-5">
						<div class="text-center add_bottom_15">
							<h4>Please fill the form below</h4>
							<p>Id persius indoctum sed, audiam verear his in, te eum quot comprehensam. Sed impetus vocibus repudiare et.</p>
						</div>
						<div id="message-register"></div>
							<form method="post" action="assets/register.php" id="register">
								<h6>Personal data</h6>
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<input type="text" class="form-control" placeholder="Name and Last Name" name="name_register" id="name_register">
										</div>
									</div>
								</div>
								<!-- /row -->
								<div class="row add_bottom_15">
									<div class="col-lg-12">
										<div class="form-group">
											<input type="email" class="form-control" placeholder="Email Address" name="email_register" id="email_register">
										</div>
									</div>
								</div>
								<!-- /row -->
								<h6>Restaurant data</h6>
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<input type="text" class="form-control" placeholder="Restaurant Name" name="restaurantname_register" id="restaurantname_register">
										</div>
									</div>
								</div>
								<!-- /row -->
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<input type="text" class="form-control" placeholder="Address" name="address_register" id="address_register">
										</div>
									</div>
								</div>
								<!-- /row -->
								<div class="row add_bottom_15">
									<div class="col-md-6">
										<div class="form-group">
											<input type="text" class="form-control" placeholder="City" name="city_register" id="city_register">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<div class="custom_select submit">
											<select name="country_register" id="country_register" class="form-control wide">
												<option value="">Country</option>
												<option value="Europe">Europe</option>
												<option value="Asia">Asia</option>
												<option value="Unated States">Unated States</option>
												<option value="Oceania">Oceania</option>
											</select>
										</div>
										</div>
									</div>
								</div>
								<!-- /row -->
								<h6>I am not a robot</h6>
								<div class="row add_bottom_25">
									<div class="col-lg-12">
										<div class="form-group">
											<input type="text" id="verify_register" class="form-control" placeholder="Human verify: 3 + 1 =?">
										</div>
									</div>
								</div>
								<!-- /row -->
								<div class="form-group text-center"><input type="submit" class="btn_1 gradient" value="Submit" id="submit-register"></div>
							</form>
					</div>
				</div>
			</div>
			<!-- /container -->











        @push('specific-scripts')



        @endpush
    @endsection
