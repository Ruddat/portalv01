@extends('backend.layouts.default-dark')
@section('pageTitle', isset($pageTitle) ? app(\App\Services\TranslationService::class)->trans($pageTitle, app()->getLocale()) : app(\App\Services\TranslationService::class)->trans('Page title here....', app()->getLocale()))
@section('content')







<div class="content-body">
            <div class="container">
				<div class="row page-titles">
					<ol class="breadcrumb">
						<li class="breadcrumb-item active"><a href="javascript:void(0)">Table</a></li>
						<li class="breadcrumb-item"><a href="javascript:void(0)">Bootstrap</a></li>
					</ol>
                </div>
                <!-- row -->

                <div class="row">






                    <livewire:backend.seller.worktimes-and-hollidays.holly-days-table-component />

                    <livewire:backend.seller.worktimes-and-hollidays.worktimes-table-component />






                </div>
            </div>
        </div>








    @push('specific-css')
    @endpush

    @push('specific-scripts')
    @endpush

@endsection


