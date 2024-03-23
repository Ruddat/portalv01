@extends('frontend.layouts.default')
@section('content')
    <!-- seitenabhengig css -->
    @push('specific-css')
        <link href="{{ asset('frontend/css/review.css') }}" rel="stylesheet">

    @endpush

    <body>

        @include('frontend.includes.header-in-clearfix')




        <main class="bg_gray">


            <livewire:frontend.votings.votings-restaurant :orderHash="$orderHash" />


        </main>
        <!-- /main -->



        @push('specific-scripts')

        @endpush
        <script src="{{ asset('frontend/js/specific_review.js') }}"></script>

        @endsection
