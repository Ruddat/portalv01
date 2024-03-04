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
                                               <div class=" change position-relative d-flex">
                                                   <div class="avatar-preview">
                                                       <div id="productImagePreview" style="background-image: url({{ asset('backend/images/no-img-avatar.png') }});">
                                                       </div>
                                                   </div>
                                                   <div class="change-btn d-flex align-items-center flex-wrap">
                                                       <input type="file" class="form-control" id="productImageUpload" name="product_image" accept=".png, .jpg, .jpeg">
                                                       <label for="productImageUpload" class="dlab-upload">Choose File</label>
                                                       <a href="javascript:void(0)" class="btn remove-img ms-2">Remove</a>
                                                    </div>
                                               </div>

                                           </div>

                                       </div>


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
                                            <select class="default-select form-control wide ms-0">
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

        // Debugging-Ausgabe des ausgewählten Flaschenwerts
        var selectedBottle = $('#bottlesSelect').val();
        console.log('Ausgewählte Flasche:', selectedBottle);
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


