<div>

    <!-- Bilder-Galerie -->

<!-- Overlay für das Bild-Upload Formular -->
@if ($showUploadOverlay)
    <div class="overlay">
        <div class="overlay-content">
            <span class="close-btn" wire:click="closeUploadOverlay">&times;</span>

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Bild-Upload</h4>
                </div>
                <div class="card-body">
                    <!-- Kategorie-Anlage -->
                    <div class="input-group mb-3">
                        <input type="text" wire:model="newCategoryName" class="form-control" placeholder="Neue Kategorie">
                        <button wire:click="createCategory" class="btn btn-primary" type="button">Kategorie erstellen</button>
                    </div>
                    <hr />

                    <!-- Subkategorie-Anlage -->
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <select wire:model="selectedCategory" class="form-select form-select-lg mb-3" aria-label="Large select example">
                                <option value="">Wähle eine Kategorie</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="input-group mb-3 col-md-6">
                            <input type="text" class="form-control" wire:model="newSubcategoryName" placeholder="Neue Subkategorie Name">
                            <button class="btn btn-outline-secondary" wire:click="createSubcategory" type="button">Subkategorie erstellen</button>
                        </div>
                    </div>

                    <!-- Kategorie-Auswahl -->
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Kategorie</label>
                            <select wire:model="selectedCategory" class="form-select form-select-lg mb-3">
                                <option value="">Wähle eine Kategorie</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Subkategorie</label>
                            <select wire:model="selectedSubcategory" class="form-select form-select-lg mb-3">
                                <option value="">Wähle eine Subkategorie</option>
                                @foreach($subcategories as $subcategory)
                                    <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Bild-Upload -->
                    <div class="mb-3">
                        <label for="formFileMultiple" class="form-label">Bilder auswählen</label>
                        <input class="form-control" type="file" wire:model="newImages" multiple>
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-primary" wire:click="uploadImages">Bilder hochladen</button>
                    </div>

                    <!-- Feedback-Nachricht -->
                    @if ($uploadMessage)
                        <div class="alert @if($uploadSuccess) alert-success @else alert-danger @endif">
                            {{ $uploadMessage }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endif



<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Recent Payments Queue</h4>
            </div>
            <div class="card-body">

    <!-- Bilder-Galerie -->

    <div class="container">
        <div class="row">
            <!-- begin col-9 -->
            <div class="col-md-9">
        <ul class="gallery-list">
        @foreach($images as $image)
        <li>
            <div class="image-container">
                <div class="image right-clickable" data-id="{{ $loop->index }}">
                    <img src="{{ $image['thumbnail'] }}" alt="Image" class="img-thumbnail">
                </div>
                <div class="btn-list">
                    <a href="#" wire:click.prevent="showImage('{{ $image['category_image'] }}', '{{ $image['title'] }}')" class="btn btn-white btn-xs"><i class="fa fa-search-plus"></i></a>
                    <a href="#" class="btn btn-white btn-xs"><i class="fa fa-cog"></i></a>
                </div>
                <div class="info">
                    <h5>{{ $image['title'] ?? 'No Title' }}</h5>
                    <small class="text-muted">{{ \Carbon\Carbon::parse($image['uploaded_at'])->format('d/m/Y') }}</small>
                </div>
            </div>
        </li>
        @endforeach
        </ul>
    </div>
                    <!-- end col-9 -->
                    <!-- begin col-3 -->
                    <div class="col-md-3">
                        <!-- begin panel -->
                        <div class="panel p-20">
                            <h5 class="m-t-0">Search Images</h5>
                            <form class="form-input-flat">
                                <div class="input-group m-b-15">
                                    <input type="text" class="form-control" placeholder="Enter keywords...">
                                    <div class="input-group-btn">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </form>

                            <div class="mb-3"></div>
                            <h5 class="m-t-0">Filter By Category</h5>
                            <form class="form-input-flat">
                                <div class="form-group m-b-15">
                                    <select class="form-control" wire:model="selectedCategory">
                                        <option value="">All Categories</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </form>
                            <div class="mb-3"></div>
                            <h5 class="m-t-0">Tags</h5>
                            <ul class="tag-list m-b-10">
                                <!-- Alle Anzeigen Tag -->
                                <li><a href="#" wire:click.prevent="resetFilter">Alle anzeigen</a></li>

                                <!-- Filter Tags -->
                                @foreach($categories as $category)
                                    <li><a href="#" wire:click.prevent="filterByCategory({{ $category->id }})">{{ $category->name }}</a></li>
                                @endforeach
                            </ul>
                            <div class="text-center">
                                <a href="#" class="btn btn-rounded btn-primary btn-sm" wire:click="$toggle('showUploadOverlay')"><i class="fa fa-plus"></i> Upload New Images</a>
                            </div>
                        </div>
                        <!-- end panel -->
                    </div>
        </div>

    </div>


            </div>
        </div>
    </div>
</div>



<!-- Overlay -->
@if ($showOverlay)
    <div class="overlay">
        <div class="overlay-content">
            <span class="close-btn btn btn-white btn-xs" wire:click="closeOverlay">&times;</span>
            <img src="{{ $overlayImageUrl }}" alt="Preview Image" class="img-fluid">
            <div class="overlay-image-title">
                {{ $overlayImageTitle ?? 'No Title' }}

            </div>
        </div>
    </div>
@endif

    <style>

        /* Styles für das Overlay */
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 5000;
        }

        .overlay-content {
            position: relative;
            max-width: 80%;
            max-height: 80%;
            background: white;
        }

        .close-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 30px;
            cursor: pointer;
            color: inherit;
            z-index: 6000;
        }

        .overlay-image-title {
            text-align: center;
            padding: 10px;
            font-size: 20px;
            font-weight: bold;
        }


    </style>

<script>

</script>



</div>
