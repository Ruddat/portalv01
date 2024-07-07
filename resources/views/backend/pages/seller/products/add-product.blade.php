@extends('backend.layouts.default-dark')
@section('pageTitle', isset($pageTitle) ? app(\App\Services\TranslationService::class)->trans($pageTitle, app()->getLocale()) : app(\App\Services\TranslationService::class)->trans('Page title here....', app()->getLocale()))
@section('content')

        {{--**********************************
            Content body start
        ***********************************--}}
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
                                <a href="{{ route('seller.manage-products.products-list' , ['shopId' => $shopId, 'menuId' =>  $menuId, 'categoryId' => $categoryId]) }}" class="btn btn-primary btn-sm" type="button">
                                    <i class="bi bi-arrow-left"></i>
                                   Back to list
                                </a>
                            </div>
                        </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <form action="{{ route('seller.manage-products.store-product') }}" method="POST" enctype="multipart/form-data" class="mt-3">
                                        <input type="hidden" name="category_id" value="{!! $categoryId !!}">
                                        <input type="hidden" name="shop_id" value="{!! $shopId !!}">
                                        @csrf
                                        @include('backend.includes.errorflash')

                                        <div class="row">

                                            <div class="mb-3 col-md-2">
                                                <div class="form-group">
                                                    <label for="product-article-no" class="form-label">Article no</label>
                                                    <input type="text" name="product_article_no" class="form-control input-default"
                                                    value="{{ old('product_article_no') }}" placeholder="Article-No">
                                                    @error('product_article_no')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="mb-3 col-md-10">
                                                <div class="form-group">
                                                    <label for="product-title" class="form-label">Product title</label>
                                                    <input type="text" name="product_title" class="form-control input-default"
                                                    value="{{ old('product_title') }}" placeholder="Enter product name">
                                                    @error('product_title')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>


                                        <div class="setting-img d-flex align-items-center mb-4">
                                            <div class="avatar-upload d-flex align-items-center">
                                                <div class="change position-relative d-flex">
                                                    <div class="avatar-preview">
                                                        <div id="productImagePreview" style="background-image: url({{ asset('backend/images/no-img-avatar.png') }});">
                                                        </div>
                                                    </div>
                                                    <a href="javascript:;" onclick="event.preventDefault(); document.getElementById('productImageUpload').click();">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                                    <input type="file" class="d-none" style="opacity: 0" id="productImageUpload" name="productImageUpload" accept=".png, .jpg, .jpeg">


                                                    <div class="change-btn d-flex align-items-center flex-wrap">
                                                        <!-- Ändere den Namen des Eingabefelds, um es klarer zu machen -->
                                                        <input type="file" class="form-control" id="newProductImageUpload" name="new_product_image" accept=".png, .jpg, .jpeg">
                                                        <label for="productImageUpload" class="dlab-upload">Choose File</label>
                                                        <a href="javascript:void(0)" class="btn remove-img ms-2">Remove</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                       <div class="mb-3 col-md-2">
                                        <div class="form-group">
                                            <label for="product-basic-price" class="form-label">Basic price</label>
                                            <input type="text" name="base_price" class="form-control input-default" value="{{ old('base_price' , '0.00') }}" placeholder="00.00">
                                            <input type="hidden" name="product_hidden_field" value="base_price">
                                            @error('base_price')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                <hr>


                                @if($currentProductSizes->isNotEmpty())
                                <div class="row">
                                    <div class="mb-3 col-md-2">
                                    <label class="form-label"><strong>Main Size Prices</strong></label>
                                    </div>
                                    @foreach($currentProductSizes as $size)
                                        @if($size->parent == 0)
                                            <div  class="mb-3 col-md-12">
                                                <label class="form-label">Category: {{ $size->title }}:</label>
                                                <div class="row">
                                                @foreach($size->children as $price)
                                                    <div class="mb-3 col-md-2">

                                                        <!-- Hier den Text für die Größe einfügen -->
                                                        <label class="form-label">{{ $price->title }}</label>
                                                        <input type="text" name="product_price_{{ $price->id }}" class="form-control input-default" value="{{ old('product_price_'.$price->id, '0.00') }}" placeholder="00.00">
                                                        <input type="hidden" name="product_hidden_field" value="product_price_{{ $price->id }}">
                                                        @error('product_price_'.$price->id)
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                @endforeach
                                                </div>
                                            </div>
                                        @endif


                                    @endforeach
                                </div>
                            @endif
                            <hr>

                                        <div class="col-lg-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4 class="card-title">Responsive Table</h4>
                                                </div>
                                                <div class="card-body">
                                                    <div class="table-responsive">
                                                        <table class="table header-border table-responsive-sm">
                                                            <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>Name</th>
                                                                    <th>Kostenlose Zutaten</th>
                                                                    <th>Pflichtzutat</th>
                                                                    <th>Max. Zutaten</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach($ingredientCategories as $category)
                                                                <tr>
                                                                    <th>
                                                                        <div class="form-check custom-checkbox checkbox-success check-lg">
                                                                            <input type="checkbox" class="form-check-input" id="customCheckBox{{ $category->id }}" name="ingredients[{{ $category->id }}][active]" value="1" @if($category->active) checked @endif>
                                                                            <label class="form-check-label" for="customCheckBox{{ $category->id }}"></label>
                                                                        </div>
                                                                    </th>
                                                                    <td>{{ $category->title }}</td>
                                                                    <td>
                                                                        <div class="mb-3 col-md-3">
                                                                            <input type="number" name="ingredients[{{ $category->id }}][free_ingredients]" id="free_ingredients" class="form-control" placeholder="">
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="mb-3 col-md-3">
                                                                            <input type="number" name="ingredients[{{ $category->id }}][min_ingredients]" id="min_ingredients" class="form-control" placeholder="">
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="mb-3 col-md-3">
                                                                            <input type="number" name="ingredients[{{ $category->id }}][max_ingredients]" id="max_ingredients" class="form-control" placeholder="">
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                @endforeach

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="input-group mb-3">
                                            <label class="input-group-text mb-0">Bottles</label>
                                            <select id="bottlesSelect" class="default-select form-control wide ms-0">
                                                <option selected value="">Choose...</option>
                                                @foreach ($bottles as $bottle)
                                                    <option value="{{ $bottle->id }}">{{ $bottle->bottles_title }} - {{ $bottle->bottles_value }}</option>
                                                @endforeach
                                            </select>
                                            <input type="hidden" name="bottle_id" id="bottleIdInput">
                                        </div>


                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="input-group mb-3">
                                                    <label class="input-group-text mb-0 alert-warning ">Additives</label>
                                                    <select name="additives[]" class="form-control wide ms-0" multiple style="height: 100px;">
                                                        @foreach ($additives as $additive)
                                                            <option value="{{ $additive->id }}">{{ $additive->additive_title }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                </div>


                                        <div class="col-md-6">
                                        <div class="input-group mb-3 ">
                                            <label class="input-group-text mb-0 alert-warning ">Allergens</label>
                                            <select name="allergens[]" class="form-control wide ms-0" multiple style="height: 100px;">
                                                @foreach ($allergens as $allergen)
                                                    <option value="{{ $allergen->id }}">{{ $allergen->allergenic_short_title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="product-short-description" class="form-label">Short description</label>
                                            <textarea class="form-control h-auto" rows="4" name="product_short_description" id="product_short_description">{{ old('product_short_description') }}</textarea>
                                            @error('product_short_description')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>


                                        <div class="mb-3">
                                            <label for="product-description" class="form-label">Description</label>
                                            <!-- Textarea-Element für den CKEditor mit eindeutiger ID -->
                                            <textarea name="product_description" id="product_description">{{ old('product_description') }}</textarea>
                                            @error('product_description')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                           @enderror
                                        </div>

                                        <div class="input-group mb-3 input-success">
                                            <label class="input-group-text mb-0">Status</label>
                                            <select class="default-select form-control wide ms-0" name="product_published">
                                                <option value="1" selected>Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
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
        {{--**********************************
            Content body end
        ***********************************--}}














    @push('specific-css')
    @kropifyStyles
    @endpush

    @push('specific-scripts')


    <script>
        // Überprüfe, ob jQuery geladen wurde
        if (typeof jQuery != 'undefined') {
            // Warte, bis das Dokument vollständig geladen ist
            $(document).ready(function() {
                // Hole das CSRF-Token aus dem Meta-Tag
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                // Initialisiere Kropify
                $('input[type="file"][id="productImageUpload"]').Kropify({
                    preview: '#productImagePreview', // Stelle sicher, dass du das richtige Vorschau-Element angibst
                    viewMode: 1,
                    aspectRatio: 1,
                    cancelButtonText: 'Cancel',
                    resetButtonText: 'Reset',
                    cropButtonText: 'Crop & update',
                    maxSize: 10485760,
                    showLoader: true,
                    processURL: '{{ route("seller.manage-products.process-product-image") }}', // Setze die Prozess-URL auf die neue Route
                    processUpload: true, // Erlaube automatisches Hochladen nach dem Zuschneiden
                    headers: {
                    'X-CSRF-TOKEN': csrfToken // Füge das CSRF-Token dem Header hinzu
                },
                    success: function(data) {
                        if(data.status == 1) {
                            toastr.success(data.msg);
                        } else {
                            toastr.error(data.msg);
                        }
                        // Diese Funktion wird ausgeführt, wenn das Bild erfolgreich zugeschnitten und verarbeitet wurde
                        console.log('Bild verarbeitet:', data);
                        // Verwende die verarbeiteten Bilddaten nach Bedarf
                    },
                    errors: function(error, text) {
                        // Diese Funktion wird ausgeführt, wenn ein Fehler auftritt
                        console.error('Fehler:', text);
                    }
                });
            });
        } else {
            // Gib eine Fehlermeldung aus, wenn jQuery nicht gefunden wird
            console.error('jQuery ist nicht geladen.');
        }
    </script>



    <!-- CKEditor CDN Link -->

	<script src="{{ asset('backend/vendor/ckeditor/ckeditor.js')}}"></script>

    <!-- JavaScript, um den CKEditor zu initialisieren und den Inhalt anzuzeigen -->
<script>
    ClassicEditor
        .create(document.querySelector('#product_description'))
        .then(editor => {
            // Editor wurde erfolgreich initialisiert
        })
        .catch(error => {
            console.error(error);
        });

        $(document).ready(function() {
    // Event-Handler für Änderungen im Dropdown-Menü
    $('#bottlesSelect').on('change', function() {
        // Abrufen des ausgewählten Werts
        var selectedBottle = $(this).val();

        // Ausgabe des ausgewählten Werts in der Konsole
        console.log(selectedBottle);
    });
});

</script>




<script>
    $(document).ready(function() {
        // Event-Handler für Änderungen im Dropdown-Menü
        $('#bottlesSelect').on('change', function() {
            // Abrufen des ausgewählten Werts
            var selectedBottleId = $(this).val();

            // Einfügen des ausgewählten Werts in das versteckte Eingabefeld
            $('#bottleIdInput').val(selectedBottleId);
        });
    });
</script>


    @endpush

@endsection


