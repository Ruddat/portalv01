@extends('frontend.layouts.default')
@section('content')
    <!-- seitenabhengig css -->
    @push('specific-css')
        <link href="{{ asset('frontend/css/order-sign_up.css') }}" rel="stylesheet">
    @endpush

    <body>

        @include('frontend.includes.header-in-clearfix')



        <main class="bg_gray">

            <div class="container margin_60_40">
                <div class="row justify-content-center">
                    <div class="col-lg-4">
                        <div class="box_order_form">
                            <div class="head text-center">
                                <h3>{{ $seller['restaurant_name'] }}</h3>
                                <p>{{ app(\App\Services\TranslationService::class)->trans('Vielen Dank für Ihre Registrierung bei unserem Service.', app()->getLocale()) }}</p>
                            </div>
                            <!-- /head -->
                            <div class="main">
                                <div id="confirm">
                                    <div class="icon icon--order-success svg add_bottom_15">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="72" height="72">
                                            <g fill="none" stroke="#8EC343" stroke-width="2">
                                                <circle cx="36" cy="36" r="35" style="stroke-dasharray:240px, 240px; stroke-dashoffset: 480px;"></circle>
                                                <path d="M17.417,37.778l9.93,9.909l25.444-25.393" style="stroke-dasharray:50px, 50px; stroke-dashoffset: 0px;"></path>
                                            </g>
                                        </svg>
                                    </div>
                                    <h3>{{ app(\App\Services\TranslationService::class)->trans('E-Mail wurde gesendet!', app()->getLocale()) }}</h3>
                                    <p>{{ app(\App\Services\TranslationService::class)->trans('Bitte schauen Sie in Ihrem Postfach nach.', app()->getLocale()) }}</p>
                                </div>
                            </div>
                        </div>
                        <!-- /box_booking -->
                    </div>
                    <!-- /col -->
                </div>
                <!-- /row -->
            </div>
            <!-- /container -->

        </main>
        <!-- /main -->










        @push('specific-scripts')

        <script>
            // Falls Validierungsfehler vorliegen, scrolle zum Formular
            @if ($errors->any())
                document.getElementById('registration_form').scrollIntoView({ behavior: 'smooth', block: 'start' });
            @endif
        </script>



        @endpush
    @endsection
