@extends('frontend.layouts.default')
@section('content')
    <!-- seitenabhengig css -->
    @push('specific-css')
        <link href="{{ asset('frontend/css/error.css') }}" rel="stylesheet">
    @endpush

    <body>

        @include('frontend.includes.headerblack')


		<div id="error_page">
			<div class="container">
				<div class="row justify-content-center text-center">
					<div class="col-xl-7 col-lg-9">
						<figure><img src="{{ asset('frontend/img/404.svg') }}" alt="" class="img-fluid" width="550" height="234"></figure>
						<p>We're sorry, but the page you were looking for doesn't exist.</p>
						<form method="post" action="{{ route('search.index') }}">
                            @csrf

                                <div class="row g-0 custom-search-input">
                                    <div class="col-lg-10">
                                        <div class="form-group">
                                            <input class="form-control no_border_r" type="text" name="query"  id="autocomplete" placeholder="{{ app(\App\Services\TranslationService::class)->trans('What are you looking for?', app()->getLocale()) }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <button class="btn_1 gradient" type="submit">Search</button>
                                    </div>
                                </div>
                                <!-- /row -->
                            </form>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /error -->


        @push('specific-scripts')

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Typeahead.js CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js-bootstrap-css/1.2.1/typeaheadjs.min.css" />

<!-- Typeahead.js JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script>


<script>
    // Initialisiere Typeahead.js für das Autocomplete-Input
    $(document).ready(function() {
        $('#autocomplete').typeahead({
            minLength: 3, // Minimale Länge für die Sucheingabe
            highlight: true,
            hint: false,
        }, {
            name: 'places',
            source: function(query, syncResults, asyncResults) {
                // OpenStreetMap Nominatim API für Autocomplete
                $.get('https://nominatim.openstreetmap.org/search', { q: query, format: 'json' }, function(data) {
                    asyncResults(data.map(function(place) {
                        return place.display_name;
                    }));
                });
            },
            limit: 10, // Anzahl der angezeigten Ergebnisse
        });
    });
</script>

        @endpush
    @endsection
