@extends('frontend.layouts.default')
@section('content')
    <!-- seitenabhengig css -->
    @push('specific-css')
        <link href="{{ asset('frontend/css/order-sign_up.css') }}" rel="stylesheet">
        <link href="{{ asset('frontend/css/detail-page.css') }}" rel="stylesheet">

    @endpush

    <body>

        @include('frontend.includes.headerblack')




        <main class="bg_gray">


            <livewire:frontend.cart.cart-order-details :restaurantId="$restaurantId" :shopData="$shopData" />


        </main>
        <!-- /main -->






        @push('specific-scripts')
        @endpush

        @endsection
