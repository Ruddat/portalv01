<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    @extends('backend.includes.head')

</head>

<body class="vh-100">
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
									<div class="text-center mb-3">
										<a href="index.html"><img src="/images/site/{{ get_settings()->site_logo }}" alt=""></a>

									</div>
                                    <h4 class="text-center mb-4">@autotranslate('Forgot Password', app()->getLocale())</h4>

									<form action="{{ route('broker.send-password-reset-link') }}" method="POST">
                                        @csrf

                                        @include('backend.includes.errorflash')

                                        <div class="mb-3">
                                            <label><strong>@autotranslate('Email', app()->getLocale())</strong></label>
                                            <input type="text" class="form-control" placeholder="Email" name="email"
                                            value="{{ old('email') }}">
                                        </div>
                                        @error('email')
                                        <div class="d-block text-danger" style="margin-top: -15px; margin-bottom: 15px;">{{ $message }}</div>
                                        @enderror
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary btn-block">@autotranslate('SUBMIT', app()->getLocale())</button>
                                        </div>
                                    </form>

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
	<script src="{{ asset('backend/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
	<script src="{{ asset('backend/vendor/swiper/js/swiper-bundle.min.js') }}"></script>

    <script src="{{ asset('backend/js/dlabnav-init.js') }}"></script>
    <script src="{{ asset('backend/js/custom.js') }}"></script>

</body>
</html>
