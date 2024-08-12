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
