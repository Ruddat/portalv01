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
                                        <input type="hidden" name="category_id" value="{{ Request('id') }}" >
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
                                                <label for="formFile" class="form-label">Default file input example</label>
                                                <input type="file" name="category_image" class="form-control" id="category_image_input">

                                                @error('category_image')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror

                                                <div class="avatar mb-3">
                                                    <img src="{{ $category->category_image_url }}" alt="Category Image" id="category_image_preview" width="80%" height="160">
                                                                                               </div>
                                            </div>
                                        </div>
                                          <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </form>
                                </div>
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
    <script>
        // Überprüfen Sie, ob das Eingabefeld für das Bild geändert wurde
        $(document).on('change', 'input[name="category_image"]', function () {
            // Das ausgewählte Bild lesen
            var input = this;
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    // Das Vorschaubild aktualisieren
                    $('#category_image_preview').attr('src', e.target.result);
                }

                // Das ausgewählte Bild in das Vorschaubild einfügen
                reader.readAsDataURL(input.files[0]);
            }
        });
    </script>
    @endpush

@endsection


