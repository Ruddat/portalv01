<div class="row">
    @forelse($galleryImages as $image)
        <div class="col-md-3">
            <img src="{{ asset('storage/'.$image->image_path) }}"
                 class="img-thumbnail select-gallery-image"
                 data-filename="{{ $image->image_path }}" alt="{{ $image->title }}">
        </div>
    @empty
        <p>No images available for this category.</p>
    @endforelse
</div>
