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
										<h4 class="fs-20 font-w800 text-black">@autotranslate('Partnerlogin', app()->getLocale())</h4>
										<span class="dlab-sign-up">@autotranslate('Login', app()->getLocale())</span>
									</div>
									<form action="{{ localized_route('seller.login_handler') }}" method="POST" autocomplete="on" id="sellerLoginForm">
                                        @csrf

                                        @include('backend.includes.errorflash')

										<div class="mb-3">
											<label class="mb-1"><strong>@autotranslate('Email or Username!', app()->getLocale())</strong></label>
											<input type="text" class="form-control" name='login_id' value="{{ old('login_id') }}" placeholder="@autotranslate('Email/Username', app()->getLocale())">
										</div>
                                        @error('login_id')
                                        <div class="d-block text-danger" style="margin-top: -15px; margin-bottom: 15px;">{{ app(\App\Services\AutoTranslationService::class)->trans($message, app()->getLocale()) }}</div>

                                        @enderror


										<div class="mb-3">
											<label class="mb-1"><strong>@autotranslate('Password', app()->getLocale())</strong></label>
											<input type="password" class="form-control" name='password' placeholder='**********'>
										</div>

                                        @error('password')
                                        <div class="d-block text-danger" style="margin-top: -15px; margin-bottom: 15px;">{{ app(\App\Services\AutoTranslationService::class)->trans($message, app()->getLocale()) }}</div>

                                        @enderror


										<div class="row d-flex justify-content-between mt-4 mb-2">
											<div class="mb-3">
											   <div class="form-check custom-checkbox ms-1">
                                                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                                                <label class="form-check-label" for="remember">@autotranslate('Remember me', app()->getLocale())</label>
												</div>
											</div>
											<div class="mb-3">
												<a href="{{ localized_route('seller.forgot-password') }}">@autotranslate('Forgot Password?', app()->getLocale())</a>
											</div>
										</div>
										<div class="text-center">
                                            <button type="submit" class="btn btn-primary btn-block shadow" id="submitBtn">@autotranslate('Einloggen!', app()->getLocale())</button>
                                            <button class="btn btn-primary btn-block shadow" type="button" id="loadingBtn" style="display: none;">
                                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                                @autotranslate('Loading...', app()->getLocale())
                                            </button>



										</div>
									</form>
									<div class="text-center my-3">
										<span class="dlab-sign-up style-1">@autotranslate('oder', app()->getLocale())</span>
									</div>
									<div class="mb-3 dlab-signup-icon">
										<button class="btn btn-outline-light"><i class="fa-brands fa-facebook me-2 facebook"></i>Facebook</button>
										<button class="btn btn-outline-light"><i class="fa-brands fa-google me-2 google"></i>Google</button>
										<button class="btn btn-outline-light mt-lg-0 mt-md-1 mt-sm-0 mt-1 linked-btn"><i class="fa-brands fa-linkedin me-2 likedin"></i>linkedin</button>
									</div>
									<div class="text-center">
										<span> @autotranslate('Noch nicht Partner?', app()->getLocale())<a href="{{ localized_route('seller.register') }}" class="text-primary"> @autotranslate('Sign in', app()->getLocale()) </a></span>
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

    <script>
        document.getElementById('sellerLoginForm').addEventListener('submit', function() {
            document.getElementById('submitBtn').style.display = 'none';
            document.getElementById('loadingBtn').style.display = 'block';
        });
    </script>

</body>
</html>
