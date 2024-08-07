@extends('frontend.layouts.default')
@section('content')
    <!-- seitenabhengig css -->
    @push('specific-css')
        <link href="{{ asset('frontend/css/blog.css') }}" rel="stylesheet">
    @endpush

    <body>
        @include('frontend.includes.header-in-clearfix')


        <livewire:frontend.buyer.dashboard-index/>


        @include('frontend.includes.page-snipped.broker-seller')


		<!-- /container -->


    @endsection
