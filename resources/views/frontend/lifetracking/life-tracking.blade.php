@extends('frontend.layouts.default')

@section('content')
    <!-- seitenabhängiges CSS -->
    @push('specific-css')
        <link href="{{ asset('frontend/css/order-sign_up.css') }}" rel="stylesheet">
        <link href="{{ asset('frontend/css/detail-page.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />




        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />
    @endpush

    @include('frontend.includes.headerblack')

    <main class="bg_grey">

        <livewire:frontend.lifetracking.life-tracking :orderHash="$orderHash" />


        </div>


        </div>

    </main>

    <style>
        .container {
            width: 100%;
            max-width: 1200px;
            margin: 20px auto;
        }

        h1 {
            text-align: center;
        }

        .info {
            text-align: center;
            margin-bottom: 20px;
        }

        .progress-container {
            width: 100%;
            margin-bottom: 20px;
        }

        .progress-bar {
            display: flex;
            justify-content: space-between;
            position: relative;
            overflow: hidden;
        }

        .step {
            flex: 1;
            text-align: center;
            padding: 10px;
            background-color: #f0f0f0;
            border-radius: 5px;
            position: relative;
            margin: 0 5px;
            transition: background-color 0.3s;
        }

        .step:before {
            content: '';
            position: absolute;
            width: 100%;
            height: 2px;
            background-color: #007BFF;
            top: 50%;
            left: -50%;
            z-index: -1;
        }

        .step:first-child:before {
            display: none;
        }

        .step.active {
            background-color: #007BFF;
            color: #fff;
        }

        .main-content {
            display: flex;
            flex-direction: column;
        }

        .map,
        .address {
            flex: 1;
            margin: 10px;
        }

        .map {
            height: auto;
            background-color: #e0e0e0;
        }

        @media (min-width: 768px) {
            .main-content {
                flex-direction: row;
            }

            .map,
            .address {

                box-sizing: border-box;
            }
        }

        @media (max-width: 767px) {

            .map,
            .address {
                width: 100%;
                box-sizing: border-box;
            }
        }

        .review-link {
            text-align: center;
            margin-top: 20px;
        }

        .review-link a {
            text-decoration: none;
            color: #007BFF;
            font-weight: bold;
        }




        /* Resetting */



        #main-content {
            padding: 30px;
            border-radius: 15px;
        }

        #main-content .h5,
        #main-content .text-uppercase {
            font-weight: 600;
            margin-bottom: 0;
        }

        #main-content .h5+div {
            font-size: 0.9rem;
        }

        #main-content .box {
            padding: 10px;
            border-radius: 6px;
            width: 170px;
            height: 90px;
        }

        #main-content .box img {
            width: 40px;
            height: 40px;
            object-fit: contain;
        }

        #main-content .box .tag {
            font-size: 0.9rem;
            color: #000;
            font-weight: 500;
        }

        #main-content .box .number {
            font-size: 1.5rem;
            font-weight: 600;
        }

        .order {
            padding: 10px 30px;
            min-height: 150px;
        }

        .order .order-summary {
            height: 100%;
        }

        .order .blue-label {
            background-color: #aeaeeb;
            color: #0046dd;
            font-size: 0.9rem;
            padding: 0px 3px;
        }

        .order .green-label {
            background-color: #a8e9d0;
            color: #008357;
            font-size: 0.9rem;
            padding: 0px 3px;
        }

        .order .fs-8 {
            font-size: 0.85rem;
        }

        .order .rating img {
            width: 20px;
            height: 20px;
            object-fit: contain;
        }

        .order .rating .fas,
        .order .rating .far {
            font-size: 0.9rem;
        }

        .order .rating .fas {
            color: #daa520;
        }

        .order .status {
            font-weight: 600;
        }

        .order .btn.btn-primary {
            background-color: #fff;
            color: #4e2296;
            border: 1px solid #4e2296;
        }

        .order .btn.btn-primary:hover {
            background-color: #4e2296;
            color: #fff;
        }

        .order .progressbar-track {
            margin-top: 20px;
            margin-bottom: 20px;
            position: relative;
        }

        .order .progressbar-track .progressbar {
            list-style: none;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-left: 0rem;
        }

        .order .progressbar-track .progressbar li {
            font-size: 1.5rem;
            border: 1px solid #333;
            padding: 5px 10px;
            border-radius: 50%;
            background-color: #dddddd;
            z-index: 100;
            position: relative;
        }

        .order .progressbar-track .progressbar li.green {
            border: 1px solid #007965;
            background-color: #d5e6e2;
        }

        .order .progressbar-track .progressbar li::after {
            position: absolute;
            font-size: 0.9rem;
            top: 50px;
            left: 0px;
        }

        #tracker {
            position: absolute;
            border-top: 1px solid #bbb;
            width: 100%;
            top: 25px;
        }

        #step-1::after {
            content: '@autotranslate('Placed', app()->getLocale())';
        }

        #step-2::after {
            content: 'Accepted';
            left: -10px;
        }

        #step-3::after {
            content: 'Packed';
        }

        #step-4::after {
            content: 'Shipped';
        }

        #step-5::after {
            content: 'Delivered';
            left: -10px;
        }



        /* Backgrounds */
        .bg-purple {
            background-color: #55009b;
        }

        .bg-light {
            background-color: #f0ecec !important;
        }

        .green {
            color: #007965 !important;
        }

        /* Media Queries */
        @media(max-width: 1199.5px) {
            nav ul li {
                padding: 0 10px;
            }
        }

        @media(max-width: 500px) {
            .order .progressbar-track .progressbar li {
                font-size: 1rem;
            }

            .order .progressbar-track .progressbar li::after {
                font-size: 0.8rem;
                top: 35px;
            }

            #tracker {
                top: 20px;
            }
        }

        @media(max-width: 440px) {
            #main-content {
                padding: 20px;
            }

            .order {
                padding: 20px;
            }

            #step-4::after {
                left: -5px;
            }
        }

        @media(max-width: 395px) {
            .order .progressbar-track .progressbar li {
                font-size: 0.8rem;
            }

            .order .progressbar-track .progressbar li::after {
                font-size: 0.7rem;
                top: 35px;
            }

            #tracker {
                top: 15px;
            }

            .order .btn.btn-primary {
                font-size: 0.85rem;
            }
        }

        @media(max-width: 355px) {
            #main-content {
                padding: 15px;
            }

            .order {
                padding: 10px;
            }
        }
    </style>


@endsection
