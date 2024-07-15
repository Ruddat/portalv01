@extends('backend.layouts.default-dark')
@section('pageTitle', isset($pageTitle) ? app(\App\Services\AutoTranslationService::class)->trans($pageTitle, app()->getLocale()) : app(\App\Services\AutoTranslationService::class)->trans('Page title here....', app()->getLocale()))

@section('content')

@push('specific-css')

<style>
    .table-responsive-sm {
    overflow-x: auto;
}
    .header-border thead th {
    border: 1px solid #e0e0e0;
    background: #f9f9f9;
    font-size: 12px;
    font-weight: 600;
    color: #333;
    padding: 10px;
    text-transform: uppercase;
    text-align: center;
}
</style>


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


                    <livewire:backend.admin.invoice-system.storno-manager-component wire:poll.10000ms="nextBanner" />


                </div>
            </div>









        </div>
        <!--**********************************
            Content body end
        ***********************************-->



        @push('specific-scripts')

    @endpush




@endsection


