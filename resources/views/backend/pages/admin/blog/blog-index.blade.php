@extends('backend.layouts.default-dark')
@section('pageTitle', isset($pageTitle) ? app(\App\Services\AutoTranslationService::class)->trans($pageTitle, app()->getLocale()) : app(\App\Services\AutoTranslationService::class)->trans('Page title here....', app()->getLocale()))

@section('content')

@push('specific-css')

<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

@endpush



		<!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <!-- row -->
            <div class="container">
				<div class="row page-titles">
					<ol class="breadcrumb">
						<li class="breadcrumb-item active"><a href="javascript:void(0)">Table</a></li>
						<li class="breadcrumb-item"><a href="javascript:void(0)">@yield('pageTitle')</a></li>
					</ol>
                </div>
                <!-- row -->

                <div class="row">


                    <livewire:backend.admin.blog.blog-component />


                </div>


            </div>









        </div>
        <!--**********************************
            Content body end
        ***********************************-->



        @push('specific-scripts')
        <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>


@endpush




@endsection


