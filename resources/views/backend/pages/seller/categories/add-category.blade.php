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





                                        <div class="input-group mb-3">
                                            <label class="input-group-text mb-0">Sizes</label>
                                            <select  name="size_id" id="sizesSelect" class="default-select form-control wide ms-0">
                                                <option selected value="">Choose...</option>
                                                @foreach ($sizes as $size)
                                                    <option value="{{ $size->id }}">{{ $size->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>





                                        <div class="mb-3">
                                            <div class="form-group">
                                            <label for="category-description" class="form-label">Category description</label>
                                            <textarea class="form-control h-auto" rows="4" name="category_description" id="category_description">{{ old('category_description') }}</textarea>

                                       @error('category_description')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                       @enderror
                                        </div>
                                        </div>



                                        <div class="mb-3">
                                            <div class="form-group">
                                                <label for="formFile" class="form-label">Category Image</label>
                                                <div class="input-group">
                                                    <input type="file" name="category_image" class="form-control">
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
                    <h5>Selected Image Preview:</h5>
                    <img id="imagePreview" src="" alt="Selected Image" style="max-width: 100%; height: auto;">
                </div>

<input type="hidden" name="selected_gallery_image" id="selectedGalleryImage">


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

<!-- Modal für die Galerie -->
<div class="modal fade" id="imageGalleryModal" tabindex="-1" aria-labelledby="imageGalleryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageGalleryModalLabel">Select an Image from the Gallery</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <select name="category_id" id="categorySelect" class="form-control">
                    <option value="">Select Category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>

                <select name="subcategory_id" id="subcategorySelect" class="form-control" style="display: none;">
                    <option value="">Select Subcategory</option>
                    @foreach ($subcategories as $subcategory)
                        <option value="{{ $subcategory->id }}" data-category-id="{{ $subcategory->category_id }}">{{ $subcategory->name }}</option>
                    @endforeach
                </select>

                <div class="row" id="galleryImagesContainer">
                    <!-- Bilder werden hier geladen -->
                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="useSelectedImage">Use Selected Image</button>
            </div>
        </div>
    </div>
</div>

<!-- Script für das AJAX-Handling -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const categorySelect = document.getElementById('categorySelect');
        const subcategorySelect = document.getElementById('subcategorySelect');
        const galleryImagesContainer = document.getElementById('galleryImagesContainer');
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // Event-Listener für die Kategorieauswahl
        categorySelect.addEventListener('change', function () {
            updateSubcategories();
            fetchImages();
        });

        // Event-Listener für die Unterkategorieauswahl
        subcategorySelect.addEventListener('change', function () {
            fetchImages();
        });

        function updateSubcategories() {
            const selectedCategoryId = categorySelect.value;
            const subcategoryOptions = Array.from(subcategorySelect.options);

            // Zeigt das Unterkategorien-Feld nur an, wenn es Unterkategorien gibt
            const hasSubcategories = subcategoryOptions.some(option => option.dataset.categoryId == selectedCategoryId);

            subcategorySelect.style.display = hasSubcategories ? 'block' : 'none';

            // Filtert Unterkategorien basierend auf der ausgewählten Kategorie
            subcategoryOptions.forEach(option => {
                option.style.display = option.dataset.categoryId == selectedCategoryId || !selectedCategoryId ? 'block' : 'none';
            });

            subcategorySelect.value = ''; // Zurücksetzen der Auswahl
        }

        function fetchImages() {
            const categoryId = categorySelect.value;
            const subcategoryId = subcategorySelect.value || 0;

            console.log('Category ID:', categoryId);
            console.log('Subcategory ID:', subcategoryId);

            if (categoryId) {
                fetch(`/seller/manage-categories/get-gallery-images/${categoryId}/${subcategoryId}`, {
                    method: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Content-Type': 'application/json',
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok ' + response.statusText);
                    }
                    return response.json();
                })
                .then(images => {
                    console.log('Fetched Images:', images);
                    galleryImagesContainer.innerHTML = images.map(image => `
                        <div class="col-md-3">
                            <img src="${window.location.origin}/storage/${image.image_path}"
                                 class="img-thumbnail select-gallery-image"
                                 data-filename="${image.image_path}" alt="${image.title}">
                        </div>
                    `).join('');
                    bindGalleryListeners();
                })
                .catch(error => {
                    console.error('Error fetching images:', error);
                });
            }
        }

        function bindGalleryListeners() {
            let selectedImage = '';
            const galleryImages = document.querySelectorAll('.select-gallery-image');
            const useSelectedImageButton = document.getElementById('useSelectedImage');
            const imagePreviewContainer = document.getElementById('imagePreviewContainer');
            const imagePreview = document.getElementById('imagePreview');

            galleryImages.forEach(image => {
                image.addEventListener('click', function () {
                    selectedImage = this.getAttribute('data-filename');
                    galleryImages.forEach(img => img.classList.remove('selected'));
                    this.classList.add('selected');

                    imagePreview.src = this.src;
                    imagePreviewContainer.style.display = 'block';
                });
            });

            useSelectedImageButton.addEventListener('click', function () {
                if (selectedImage !== '') {
                    document.getElementById('selectedGalleryImage').value = selectedImage;
                    const categoryImageInput = document.querySelector('.form-control[name="category_image"]');
                    if (categoryImageInput) {
                        categoryImageInput.value = '';
                    }
                    $('#imageGalleryModal').modal('hide');
                } else {
                    alert('Please select an image first.');
                }
            });
        }
    });
</script>




<style>
    .select-gallery-image.selected {
    border: 3px solid blue; /* Sichtbare Markierung */
}
</style>


    @push('specific-css')
    @endpush

    @push('specific-scripts')

    @endpush

@endsection


