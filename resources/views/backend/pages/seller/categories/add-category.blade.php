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
						<li class="breadcrumb-item active"><a href="javascript:void(0)">Form</a></li>
						<li class="breadcrumb-item"><a href="javascript:void(0)">Element</a></li>
					</ol>
                </div>
                <!-- row -->
                <div class="row">
                    <div class="col-xl-12 col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Categories</h4>

                            <div class="pull-right">
                                <a href="{{ route('seller.manage-categories.cats-subcats-list') }}" class="btn btn-primary btn-sm" type="button">
                                    <i class="bi bi-arrow-left"></i>
                                   Back to list
                                </a>
                            </div>
                        </div>

                            <div class="card-body">
                                <div class="basic-form">
                                    <form action="{{ route('seller.manage-categories.store-category') }}" method="POST" enctype="multipart/form-data" class="mt-3">
                                        @csrf
                                        @include('backend.includes.errorflash')

                                        <div class="mb-3">
                                            <div class="form-group">
                                            <label for="category-name" class="form-label">Category name</label>
                                            <input type="text" name="category_name" class="form-control input-default"
                                            value="{{ old('category_name') }}" placeholder="Enter category name">
                                       @error('category_name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                       @enderror
                                        </div>
                                        </div>
                                        <div class="mb-3">
                                            <div class="form-group">
                                            <label for="formFile" class="form-label">Default file input example</label>
                                            <input type="file" name="category_image" class="form-control">
                                            @error('category_image')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        </div>

                                          <button type="submit" class="btn btn-primary">Create</button>
                                    </form>
                                </div>
                            </div>
                        </div>
					</div>

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


