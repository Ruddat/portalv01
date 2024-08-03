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
										<a href="index.html"><img src="{{ asset('backend/images/logo-full.png') }}" alt=""></a>
									</div>
                                    <h4 class="text-center mb-4">Complete Registration - Final Step</h4>

                                    <form action="{{ route('client.register_last_step_handler',['token'=>request()->token]) }}" method="POST">
                                        @csrf
                                        @include('backend.includes.errorflash')


                                        <div class="mb-3">
                                            <label class="mb-1"><strong>Username</strong> <sub> *optional, fuer Kommentare oder Bewertungen etz. </sub></label>
                                            <input type="text" class="form-control" name="username" value="{{ old('username', $username) }}" id="username" placeholder="Username">
                                            @error('username')
                                            <span class="text-danger hidden">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="text-center">
                                            <strong>Trage hier deine Lieferadresse ein!</strong>
                                        </div>
                                        <div class="row">
                                        <div class="mb-3 col-md-8">
                                            <label class="mb-1"><strong>Strasse</strong></label>
                                            <input type="text" class="form-control" name="shipping_street" value="{{ old('shipping_street') }}" id="shipping_street" placeholder="Strassenname">
                                            @error('shipping_street')
                                            <span class="text-danger hidden">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3 col-md-4">
                                            <label class="mb-1"><strong>Hausnummer</strong></label>
                                            <input type="text" class="form-control" name="shipping_house_no" value="{{ old('shipping_house_no') }}" id="shipping_house_no" placeholder="Nummer">
                                            @error('shipping_house_no')
                                            <span class="text-danger hidden">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="mb-3 col-md-4">
                                            <label class="mb-1"><strong>Postleitzahl</strong></label>
                                            <input type="text" class="form-control" name="postal_code" value="{{ old('postal_code') }}" id="postal_code" placeholder="Postleitzahl">
                                            @error('postal_code')
                                            <span class="text-danger hidden">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3 col-md-8">
                                            <label class="mb-1"><strong>Ort</strong></label>
                                            <input type="text" class="form-control" name="city" value="{{ old('city') }}" id="city" placeholder="Ort">
                                            @error('city')
                                            <span class="text-danger hidden">{{ $message }}</span>
                                            @enderror
                                        </div>


                                        </div>



                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary btn-block">SUBMIT</button>
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
