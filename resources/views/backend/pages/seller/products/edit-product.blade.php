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
                                <a href="{{ route('seller.manage-products.products-list' , ['shopId' => $shopId, 'menuId' =>  $menuId, 'categoryId' => $categoryId]) }}" class="btn btn-primary btn-sm" type="button">
                                    <i class="bi bi-arrow-left"></i>
                                   Back to list
                                </a>
                            </div>
                        </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <form action="{{ route('seller.manage-products.update-product') }}" method="POST" enctype="multipart/form-data" class="mt-3">
                                        <input type="hidden" name="category_id" value="{!! $categoryId !!}">
                                        <input type="hidden" name="shop_id" value="{!! $shopId !!}">
                                        <input type="hidden" name="menu_id" value="{!! $menuId !!}">
                                        <input type="hidden" name="product_id" value="{!! $productId !!}">
                                        <input type="hidden" name="remove_image" id="removeImage" value="0">

                                        @csrf
                                        @include('backend.includes.errorflash')

                                        <div class="row">

                                            <div class="row">
                                                <div class="mb-3 col-md-2">
                                                    <div class="form-group">
                                                        <label for="product-article-no" class="form-label">Article no</label>
                                                        <input type="text" name="product_article_no" class="form-control input-default" value="{{ $product->product_code ?? old('product_code') }}" placeholder="Article-No">
                                                        @error('product_article_no')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="mb-3 col-md-10">
                                                    <div class="form-group">
                                                        <label for="product-title" class="form-label">Product title</label>
                                                        <input type="text" name="product_title" class="form-control input-default" value="{{ $product->product_title ?? old('product_title') }}" placeholder="Enter product name">
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
                                                            <!-- Überprüfen, ob ein Bild vorhanden ist -->
                                                            @if(isset($product) && $product->product_image_url)
                                                                <div id="productImagePreview" style="background-image: url({{ $product->product_image_url }});"></div>
                                                            @else
                                                                <div id="productImagePreview" style="background-image: url({{ asset('backend/images/no-img-avatar.png') }});"></div>
                                                            @endif
                                                        </div>
                                                        <div class="change-btn d-flex align-items-center flex-wrap">
                                                            <input type="file" class="form-control" id="productImageUpload" name="product_image" accept=".png, .jpg, .jpeg">
                                                            <label for="productImageUpload" class="dlab-upload">Choose File</label>
                                                            <!-- Wenn ein Bild vorhanden ist, füge einen Button zum Entfernen hinzu -->
                                                            @if(isset($product) && $product->product_image_url)
                                                                <a href="javascript:void(0)" class="btn remove-img ms-2">Remove</a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-2">
                                        <div class="mb-3">
                                            <div class="form-group">
                                            <label for="product-basic-price" class="form-label">Basic price</label>
                                            <input type="text" name="product_basic_price" class="form-control input-default"
                                            value="{{ old('product_basic_price') }}" placeholder="00.00">
                                       @error('product_basic_price')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                       @enderror
                                        </div>
                                        </div>
                                    </div>

    @foreach($sizes as $size)
        <div class="col-md-2">
            <div class="mb-3">
                <label class="form-label">{{ $size->title }} Price</label>
                @php
                    $price = $productPrices->where('size_id', $size->id)->first();
                @endphp
                <input type="text" name="prices[{{ $size->id }}]" class="form-control input-default" value="{{ $price ? $price->price : '' }}" placeholder="Enter price">
            </div>
        </div>
    @endforeach



                                        </div>

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
                                                                @foreach($ingredientNodes as $ingredientId => $ingredient)
                                                                @php
                                                                // Die entsprechenden Zutatendaten abrufen
                                                                $ingredientData = App\Models\ModProductsIngredients::where('shop_id', $shopId)
                                                                                    ->find($ingredientId);
                                                            @endphp
                                                                <tr>
                                                                    <th>
                                                                        <div class="form-check custom-checkbox checkbox-success check-lg">
                                                                            <input type="checkbox" class="form-check-input" id="customCheckBox{{ $ingredientId }}" name="ingredients[{{ $ingredientId }}][active]" value="1" {{ $ingredient['active'] ? 'checked' : '' }}>
                                                                            <label class="form-check-label" for="customCheckBox{{ $ingredientId }}"></label>
                                                                        </div>
                                                                    </th>
                                                                    <td>{{ $ingredientData->title }}</td> <!-- Anzeigen des Zutatennamens -->
                                                                    <td>
                                                                        <div class="mb-3 col-md-3">
                                                                            <input type="number" name="ingredients[{{ $ingredientId }}][free_ingredients]" id="free_ingredients" class="form-control" placeholder="{{ $ingredient['free_ingredients'] }}">
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="mb-3 col-md-3">
                                                                            <input type="number" name="ingredients[{{ $ingredientId }}][min_ingredients]" id="min_ingredients" class="form-control" placeholder="{{ $ingredient['min_ingredients'] }}">
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="mb-3 col-md-3">
                                                                            <input type="number" name="ingredients[{{ $ingredientId }}][max_ingredients]" id="max_ingredients" class="form-control" placeholder="{{ $ingredient['max_ingredients'] }}">
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
                                            <select id="bottlesSelect" class="default-select form-control wide ms-0" name="bottle_id">
                                                <option value="">Choose...</option>
                                                @foreach ($bottles as $bottle)
                                                    <option value="{{ $bottle->id }}" {{ $bottle->id == $product->bottles_id ? 'selected' : '' }}>
                                                        {{ $bottle->bottles_title }} - {{ $bottle->bottles_value }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="input-group mb-3">
                                                    <label class="input-group-text mb-0 alert-warning ">Additives</label>
                                                    <select name="additives[]" class="form-control wide ms-0" multiple style="height: 100px;">
                                                        @foreach ($additives as $additive)
                                                            @php
                                                                // Entfernen Sie die Klammern und Leerzeichen um die ID
                                                                $additiveId = trim($additive->id, "[] ");
                                                            @endphp
                                                            <option value="{{ $additive->id }}" @if(in_array($additiveId, $selectedAdditives)) selected @endif>{{ $additive->additive_title }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                </div>


                                                <div class="col-md-6">
                                                    <div class="input-group mb-3">
                                                        <label class="input-group-text mb-0 alert-warning">Allergens</label>
                                                        <select name="allergens[]" class="form-control wide ms-0" multiple style="height: 100px;">
                                                            @foreach ($allergens as $allergen)
                                                                @php
                                                                    // Entfernen Sie die Klammern und Leerzeichen um die ID
                                                                    $allergenId = trim($allergen->id, "[] ");
                                                                @endphp
                                                                <option value="{{ $allergen->id }}" @if(in_array($allergenId, $selectedAllergens)) selected @endif>{{ $allergen->allergenic_short_title }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>


                                        </div>



                                        <div class="mb-3">
                                            <label for="product-short-description" class="form-label">Short description</label>
                                            <textarea class="form-control h-auto" rows="4" name="product_short_description" id="product_short_description">{{ old('product_short_description', $product->product_anonce) }}</textarea>
                                            @error('product_short_description')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="product-description" class="form-label">Description</label>
                                            <!-- Textarea-Element für den CKEditor mit eindeutiger ID -->
                                            <textarea name="product_description" id="product_description">{{ old('product_description', $product->product_description) }}</textarea>
                                            @error('product_description')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="input-group mb-3 {{ old('product_published', $product->product_published) == 1 ? 'input-success' : '' }}">
                                            <label class="input-group-text mb-0" >Status</label>
                                            <select class="form-select" name="product_published">
                                                <option value="1" {{ old('product_published', $product->product_published) == 1 ? 'selected' : '' }}>Active</option>
                                                <option value="0" {{ old('product_published', $product->product_published) == 0 ? 'selected' : '' }}>Inactive</option>
                                            </select>
                                        </div>




                                        <button type="submit" class="btn btn-primary">Update</button>

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

<script>
    $(document).ready(function() {
        // Funktion zum Anzeigen des ausgewählten Bilds im Vorschaubereich
        function showImagePreview(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#productImagePreview').css('background-image', 'url(' + e.target.result + ')');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        // Hinzufügen des 'change' -Ereignisses zum Input-Feld
        $('#productImageUpload').on('change', function() {
            showImagePreview(this);
            console.log('Bild hochgeladen:', this.files[0].name); // Debugging-Ausgabe
        });

        // Hinzufügen des 'click' -Ereignisses zum "Remove" -Link
        $('.remove-img').on('click', function() {
            $('#productImageUpload').val(''); // Leeren des Input-Felds
            $('#productImagePreview').css('background-image', 'url({{ asset("backend/images/no-img-avatar.png") }})'); // Zurücksetzen der Vorschau auf das Standardbild
            console.log('Bild entfernt'); // Debugging-Ausgabe
        });

    });

    $('.remove-img').on('click', function() {
    $('#productImageUpload').val('');
    $('#productImagePreview').css('background-image', 'url({{ asset("backend/images/no-img-avatar.png") }})');
    $('#removeImage').val('1'); // Hier setzen wir den Wert auf 1, um anzuzeigen, dass das Bild entfernt werden soll
});

</script>




    @endpush

@endsection


