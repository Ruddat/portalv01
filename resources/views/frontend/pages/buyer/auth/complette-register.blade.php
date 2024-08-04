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
                                    <h4 class="text-center mb-4">@autotranslate('Complete Registration - Final Step', app()->getLocale())</h4>

                                    <form action="{{ route('client.register_last_step_handler',['token'=>request()->token]) }}" method="POST">
                                        @csrf
                                        @include('backend.includes.errorflash')
                                        @if ($errors->has('fail'))
                                        <div class="alert alert-warning solid alert-dismissible fade show">
                                            <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="me-2"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
                                            <strong>
                                                {{ app(\App\Services\AutoTranslationService::class)->trans($errors->first('fail'), app()->getLocale()) }}
                                            </strong>
                                        </div>
                                    @endif

                                        <div class="mb-3">
                                            <label class="mb-1"><strong>@autotranslate('Username', app()->getLocale())</strong> @autotranslate('*optional, fuer Kommentare oder Bewertungen etz.', app()->getLocale())</label>
                                            <input type="text" class="form-control" name="username" value="{{ old('username', $username) }}" id="username" placeholder="@autotranslate('Username', app()->getLocale())Username">
                                            @error('username')
                                            <span class="text-danger hidden">{{ app(\App\Services\AutoTranslationService::class)->trans($message, app()->getLocale()) }}</span>
                                            @enderror
                                        </div>
                                        <div class="text-center">
                                            <strong>@autotranslate('Trage hier deine Lieferadresse ein!', app()->getLocale())</strong>
                                        </div>
                                        <div class="row">
                                        <div class="mb-3 col-md-8">
                                            <label class="mb-1"><strong>@autotranslate('Strasse', app()->getLocale())</strong></label>
                                            <input type="text" class="form-control" name="shipping_street" value="{{ old('shipping_street') }}" id="shipping_street" placeholder="@autotranslate('Strassenname', app()->getLocale())">
                                            @error('shipping_street')
                                            <span class="text-danger hidden">{{ app(\App\Services\AutoTranslationService::class)->trans($message, app()->getLocale()) }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3 col-md-4">
                                            <label class="mb-1"><strong>@autotranslate('Hausnummer', app()->getLocale())</strong></label>
                                            <input type="text" class="form-control" name="shipping_house_no" value="{{ old('shipping_house_no') }}" id="shipping_house_no" placeholder="@autotranslate('Nummer', app()->getLocale())">
                                            @error('shipping_house_no')
                                            <span class="text-danger hidden">{{ app(\App\Services\AutoTranslationService::class)->trans($message, app()->getLocale()) }}</span>
                                            @enderror
                                        </div>

                                        <div class="mb-3 col-md-4">
                                            <label class="mb-1"><strong>@autotranslate('Postleitzahl', app()->getLocale())</strong></label>
                                            <input type="text" class="form-control" name="postal_code" value="{{ old('postal_code') }}" id="postal_code" placeholder="@autotranslate('Postleitzahl', app()->getLocale())">
                                            @error('postal_code')
                                            <span class="text-danger hidden">{{ app(\App\Services\AutoTranslationService::class)->trans($message, app()->getLocale()) }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3 col-md-8">
                                            <label class="mb-1"><strong>@autotranslate('Ort', app()->getLocale())</strong></label>
                                            <input type="text" class="form-control" name="city" value="{{ old('city') }}" id="city" placeholder="@autotranslate('Ort', app()->getLocale())">
                                            @error('city')
                                            <span class="text-danger hidden">{{ app(\App\Services\AutoTranslationService::class)->trans($message, app()->getLocale()) }}</span>
                                            @enderror
                                        </div>


                                        </div>



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
