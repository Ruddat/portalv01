<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    @extends('backend.includes.head')

</head>
<body class="body">


    <div class="container mt-0">
		<div class="row align-items-center justify-contain-center">
			<div class="col-xl-12 mt-5">
				<div class="card border-0">
					<div class="card-body login-bx">
						<div class="row  mt-5">
							<div class="col-xl-8 col-md-6 sign text-center">
								<div>
									<img src="{{ asset('backend/images/login-img/pic-5.jpg') }}" class="food-img" alt="">
								</div>
							</div>
							<div class="col-xl-4 col-md-6 pe-0">
								<div class="sign-in-your">
									<div class="text-center mb-3">
										<img src="/images/site/{{ get_settings()->site_logo }}" class="mb-3" alt="">
										<h4 class="fs-20 font-w800 text-black">Create an Account</h4>
										<span class="dlab-sign-up">Sign Up</span>
									</div>
									<form action="{{ route('seller.login_handler') }}" method="POST">
                                        @csrf

                                        @include('backend.includes.errorflash')

										<div class="mb-3">
											<label class="mb-1"><strong>Email Address</strong></label>
											<input type="text" class="form-control" name='login_id' value="{{ old('login_id') }}" placeholder="Email/Username">
										</div>
                                        @error('login_id')
                                        <div class="d-block text-danger" style="margin-top: -15px; margin-bottom: 15px;">{{ $message }}</div>

                                        @enderror


										<div class="mb-3">
											<label class="mb-1"><strong>Password</strong></label>
											<input type="password" class="form-control" name='password' placeholder='**********'>
										</div>

                                        @error('password')
                                        <div class="d-block text-danger" style="margin-top: -15px; margin-bottom: 15px;">{{ $message }}</div>

                                        @enderror


										<div class="row d-flex justify-content-between mt-4 mb-2">
											<div class="mb-3">
											   <div class="form-check custom-checkbox ms-1">
													<input type="checkbox" class="form-check-input" id="basic_checkbox_1">
													<label class="form-check-label" for="basic_checkbox_1">Remember my preference</label>
												</div>
											</div>
											<div class="mb-3">
												<a href="{{ route('seller.forgot-password') }}">Forgot Password?</a>
											</div>
										</div>
										<div class="text-center">
											<button type="submit" class="btn btn-primary btn-block shadow">Sign Me In</button>
										</div>
									</form>
									<div class="text-center my-3">
										<span class="dlab-sign-up style-1">continue With</span>
									</div>
									<div class="mb-3 dlab-signup-icon">
										<button class="btn btn-outline-light"><i class="fa-brands fa-facebook me-2 facebook"></i>Facebook</button>
										<button class="btn btn-outline-light"><i class="fa-brands fa-google me-2 google"></i>Google</button>
										<button class="btn btn-outline-light mt-lg-0 mt-md-1 mt-sm-0 mt-1 linked-btn"><i class="fa-brands fa-linkedin me-2 likedin"></i>linkedin</button>
									</div>
									<div class="text-center">
										<span>Already Have An Account?<a href="javascript:void(0);" class="text-primary"> Sign in</a></span>
									</div>

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="{{ asset('backend/vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('backend/vendor/swiper/js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('backend/js/dlabnav-init.js') }}"></script>



</body>
</html>
