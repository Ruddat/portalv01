@extends('frontend.layouts.default')
@section('content')
    <!-- seitenabhengig css -->
    @push('specific-css')
        <link href="{{ asset('frontend/css/home.css') }}" rel="stylesheet">
    @endpush

    <body>

        @include('frontend.includes.headerblack')


























@endsection
