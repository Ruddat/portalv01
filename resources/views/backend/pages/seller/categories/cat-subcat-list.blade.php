@extends('backend.layouts.default-dark')
@section('pageTitle', isset($pageTitle) ? app(\App\Services\TranslationService::class)->trans($pageTitle,
    app()->getLocale()) : app(\App\Services\TranslationService::class)->trans('Page title here....', app()->getLocale()))
@section('content')


@livewire('backend.seller.categories.categories-subcategories-list')


    @push('specific-css')
    @endpush

    @push('specific-scripts')
    @endpush

@endsection
