@extends('frontend.layouts.default')
@section('content')
    <!-- seitenabhengig css -->
    @push('specific-css')
        <link href="{{ asset('frontend/css/blog.css') }}" rel="stylesheet">
    @endpush

    <body>
        @include('frontend.includes.header-in-clearfix')


        <div class="page_header blog element_to_stick">
		    <div class="container">
		    	<div class="row">
		    		<div class="col-xl-8 col-lg-7 col-md-7 d-none d-md-block">
		    			<h1>@autotranslate('Blog and Articles', app()->getLocale())</h1>
		    		</div>
		    		<div class="col-xl-4 col-lg-5 col-md-5">
		    			<div class="search_bar_list">
						    <input type="text" class="form-control" placeholder="Dishes, restaurants or cuisines">
						    <button type="submit"><i class="icon_search"></i></button>
						</div>
		    		</div>
		    	</div>
		    	<!-- /row -->

            </div>
		</div>
		<!-- /page_header -->


        <livewire:frontend.blog.blog-index/>




        @include('frontend.includes.page-snipped.broker-seller')


		<!-- /container -->


    @endsection
