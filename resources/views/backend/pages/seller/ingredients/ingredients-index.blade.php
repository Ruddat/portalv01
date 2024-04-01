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
						<li class="breadcrumb-item"><a href="javascript:void(0)">@yield('pageTitle')</a></li>
					</ol>
                </div>
                <!-- row -->

                <div class="row">





                    <livewire:backend.seller.add-ingredients.add-ingredients-component />

                    <livewire:backend.seller.add-ingredients.ingredients-table-component />






                </div>
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->



        <style>
.delete-button {
    border: none;
    background: none;
    padding: 0;
    cursor: pointer;
    outline: none;
    transition: transform 0.3s ease; /* Fügt eine animierte Übergangseigenschaft hinzu */
}

.delete-button:hover {
    transform: scale(3.1); /* Vergrößert den Button beim Überfahren mit dem Mauszeiger */
}

</style>



@push('specific-scripts')

@endpush


@push('specific-css')

<style>
    /* CSS-Stil für das Dropdown-Menü */
    #mySelect {
        height: 150px; /* Höhe nach Bedarf ändern */
    }

    .flex-container {
    display: flex;
    justify-content: flex-start;
    flex-wrap: nowrap;
    flex-direction: row;
    align-items: center;
    }

</style>

@endpush

@endsection
