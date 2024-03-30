@extends('backend.layouts.default-dark')
@section('pageTitle', isset($pageTitle) ? app(\App\Services\TranslationService::class)->trans($pageTitle, app()->getLocale()) : app(\App\Services\TranslationService::class)->trans('Page title here....', app()->getLocale()))
@section('content')






        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container">
				<div class="row page-titles">
					<ol class="breadcrumb">
						<li class="breadcrumb-item active"><a href="javascript:void(0)">Table</a></li>
						<li class="breadcrumb-item"><a href="javascript:void(0)">Produktgrößen</a></li>
					</ol>
                </div>
                <!-- row -->

                <div class="row">
                                <!-- Deine Livewire-Komponente einbinden -->
                        <livewire:backend.seller.product-sizes.product-sizes-controller />
                </div>
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->










    @push('specific-css')
    @endpush

    @push('specific-scripts')



    @endpush

@endsection


