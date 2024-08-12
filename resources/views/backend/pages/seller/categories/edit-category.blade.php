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
                <li class="breadcrumb-item"><a href="javascript:void(0)">@yield('pageTitle')</a></li>
            </ol>
        </div>
        <!-- row -->
        <div class="row">
            <div class="col-xl-12 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@yield('pageTitle')</h4>

                        <div class="pull-right">
                            <a href="{{ route('seller.manage-categories.cats-subcats-list') }}" class="btn btn-primary btn-sm" type="button">
                                <i class="bi bi-arrow-left"></i>
                                Back to list
                            </a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="basic-form">
                            <form action="{{ route('seller.manage-categories.update-category') }}" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="category_id" value="{{ Request('id') }}">
                                @csrf

                                @include('backend.includes.errorflash')

                                <div class="mb-3">
                                    <div class="form-group">
                                        <label for="category-name" class="form-label">Category name</label>
                                        <input type="text" name="category_name" class="form-control input-default"
                                               value="{{ $category->category_name }}" placeholder="Enter category name">
                                        @error('category_name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="input-group mb-3">
                                    <label class="input-group-text mb-0">Sizes</label>
                                    <select name="size_id" id="sizesSelect" class="default-select form-control wide ms-0">
                                        <option value="">Choose...</option>
                                        @foreach ($sizes as $size)
                                            <option value="{{ $size->id }}" {{ $category->sizes_category == $size->id ? 'selected' : '' }}>{{ $size->title }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <div class="form-group">
                                        <label for="category-description" class="form-label">Category description</label>
                                        <textarea class="form-control h-auto" rows="4" name="category_description" id="category_description">{{ $category->category_description }}</textarea>
                                        @error('category_description')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="form-group">
                                        <label for="formFile" class="form-label">Aktuelles Category Image</label>
                                        <div class="avatar mb-3">
                                            <img src="{{ $category->category_image_url }}" alt="Category Image" id="category_image_preview" width="80%" height="160">
                                        </div>

                                        <div class="input-group">
                                            <input type="file" name="category_image" class="form-control" id="category_image_input">
                                            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#imageGalleryModal">
                                                Select from Gallery
                                            </button>
                                        </div>

                                        @error('category_image')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                <!-- Bildvorschau -->
                <div id="imagePreviewContainer" style="display: none; margin-top: 20px;">
                    <h5>Selected New Image Preview:</h5>
                    <img id="imagePreview" src="" alt="Selected Image" style="max-width: 100%; height: auto;">
                </div>

                                <input type="hidden" id="selectedGalleryImage" name="selected_gallery_image">

                                <button type="submit" class="btn btn-primary mt-3">Save Changes</button>
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

@include('backend.pages.seller.categories.partials.image-gallery-modal')

@push('specific-css')
@endpush

@push('specific-scripts')
<script>
    // Image preview update
    $(document).on('change', 'input[name="category_image"]', function () {
        var input = this;
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#category_image_preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    });
</script>
@endpush

@endsection
