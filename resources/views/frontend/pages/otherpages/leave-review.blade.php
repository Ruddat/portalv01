@extends('frontend.layouts.default')
@section('content')
    <!-- seitenabhengig css -->
    @push('specific-css')
        <link href="{{ asset('frontend/css/review.css') }}" rel="stylesheet">
    @endpush

    <body>

        @include('frontend.includes.header-in-clearfix')


		<div class="container margin_60_20">
		    <div class="row justify-content-center">
		        <div class="col-lg-8">
		            <div class="box_general write_review">
		                <h1 class="add_bottom_15">Write a review for "Pizzeria Da Alfredo"</h1>
		                <label class="d-block add_bottom_15">Overall rating</label>
		                <div class="row">
		                    <div class="col-md-3 add_bottom_25">
		                        <div class="add_bottom_15">Food Quality <strong class="food_quality_val"></strong></div>
		                        <input type="range" min="0" max="10" step="1" value="0" data-orientation="horizontal" id="food_quality" name="food_quality">
		                    </div>
		                    <div class="col-md-3 add_bottom_25">
		                        <div class="add_bottom_15">Service <strong class="service_val"></strong></div>
		                        <input type="range" min="0" max="10" step="1" value="0" data-orientation="horizontal" id="service" name="service">
		                    </div>
		                    <div class="col-md-3 add_bottom_25">
		                        <div class="add_bottom_15">Punctuality <strong class="location_val"></strong></div>
		                        <input type="range" min="0" max="10" step="1" value="0" data-orientation="horizontal" id="location" name="location">
		                    </div>
		                    <div class="col-md-3 add_bottom_25">
		                        <div class="add_bottom_15">Price <strong class="price_val"></strong></div>
		                        <input type="range" min="0" max="10" step="1" value="0" data-orientation="horizontal" id="price" name="price">
		                    </div>
		                </div>
		                <div class="form-group">
		                    <label>Title of your review</label>
		                    <input class="form-control" type="text" placeholder="If you could say it in one sentence, what would you say?">
		                </div>
		                <div class="form-group">
		                    <label>Your review</label>
		                    <textarea class="form-control" style="height: 180px;" placeholder="Write your review to help others learn about this online business"></textarea>
		                </div>
		                <div class="form-group">
		                    <label>Add your photo (optional)</label>
		                    <div class="fileupload"><input type="file" name="fileupload" accept="image/*"></div>
		                </div>
		                <div class="form-group">
		                    <div class="checkboxes float-start add_bottom_15 add_top_15">
		                        <label class="container_check">Eos tollit ancillae ea, lorem consulatu qui ne, eu eros eirmod scaevola sea. Et nec tantas accusamus salutatus, sit commodo veritus te, erat legere fabulas has ut. Rebum laudem cum ea, ius essent fuisset ut. Viderer petentium cu his.
		                            <input type="checkbox">
		                            <span class="checkmark"></span>
		                        </label>
		                    </div>
		                </div>
		                <a href="confirm.html" class="btn_1">Submit review</a>
		            </div>
		        </div>
		    </div>
		    <!-- /row -->
		</div>
		<!-- /container -->












        @push('specific-scripts')


        <!-- SPECIFIC SCRIPTS -->
            <!-- SPECIFIC SCRIPTS -->
    <script src="{{ asset('frontend/js/specific_review.js') }}"></script>

        @endpush
    @endsection
