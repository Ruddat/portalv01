@extends('frontend.layouts.default')
@section('content')
    <!-- seitenabhengig css -->
    @push('specific-css')
        <link href="{{ asset('frontend/css/contacts.css') }}" rel="stylesheet">
    @endpush

    <body id="register_bg">

        @include('frontend.includes.header-clearfix-element-to-stick')

		<div class="hero_single inner_pages background-image" data-background="url({{ asset('frontend/img/home_section_2.jpg') }})">
			<div class="opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.6)">
				<div class="container">
					<div class="row justify-content-center">
						<div class="col-xl-9 col-lg-10 col-md-8">
							<h1>{{ config('app.name') }}</h1>
							<p>@autotranslate('A successful restaurant experience', app()->getLocale())</p>
						</div>
					</div>
					<!-- /row -->
				</div>
			</div>
			<div class="wave gray hero"></div>
		</div>
		<!-- /hero_single -->

		<div class="bg_gray">

		    <div class="impressum_container margin_60_40">
                <p><span class="bold">Ingo Ruddat</span><br>
                Email: <a href="mailto:ingo.ruddat@gmail.com">ingo.ruddat@gmail.com</a></p>

                <p>@autotranslate('Diese Seite befindet sich derzeit noch in der Entwicklung. Bitte beachten Sie, dass nicht alle Funktionen verfügbar sind und die Seite noch nicht bereit ist, um im Produktionsbetrieb verwendet zu werden.', app()->getLocale())</p>

                <p>Link zur Streitschlichtung: <a href="https://ec.europa.eu/consumers/odr" target="_blank">https://ec.europa.eu/consumers/odr</a></p>

                <p>Bilderquellen: Geti Images, Stockphoto und OpenSource</p>

                <div class="license">
                    <p>License: Creative Commons 3 - CC BY-SA 3.0</p>
                    <p>Attribution: Alpha Stock Images - <a href="http://alphastockimages.com/" target="_blank">http://alphastockimages.com/</a></p>
                    <p>Original Author: Nick Youngson - <a href="http://www.nyphotographic.com/" target="_blank">http://www.nyphotographic.com/</a></p>
                    <p>Original Image: <a href="https://www.thebluediamondgallery.com/tablet-dictionary/b/broker.html" target="_blank">https://www.thebluediamondgallery.com/tablet-dictionary/b/broker.html</a></p>
                </div>
            </div>



		    <!-- /container -->
		</div>
		<!-- /bg_gray -->




        <style>
            .impressum_container {
                max-width: 800px;
                margin: 0 auto;
                padding: 20px;
            }
            h1 {
                text-align: center;
            }
            p {
                margin: 10px 0;
            }
            .bold {
                font-weight: bold;
            }
            .license {
                font-size: 0.9em;
                color: #555;
            }
        </style>

        @push('specific-scripts')


        @endpush
    @endsection
