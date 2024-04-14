<div>
<!-- Ihr Produktbereich -->
@foreach($categories as $category)
    <section id="section-{{ $category->id }}">
        <h4>{{ $category->category_name }}</h4>
        <p>{{ $category->category_description }}</p>
        <div class="row">
            <div class="col-md-12">
                <div class="image-wrapper" style="margin-bottom: 12px;">
                    <img src="{{ asset($category->category_image_url) }}" alt="{{ $category->category_name }}" class="category-image rounded shadow" style="max-width: 100%; max-height: 168px;">
                </div>
            </div>
        </div>
        <div class="row">

            @foreach($productsByCategory[$category->category_name] as $product)


            <div class="col-xs-12 col-md-12">
                <!-- Produkt -->
                <div class="product-content product-wrap clearfix">

                    <div class="row">
                        @if(!empty($product->product_image))
                        <div class="col-md-3 col-sm-12 col-xs-12">
                            <div class="product-image">
                                <figure class="zoom-effect">
                                    <img src="{{ $product->product_image_url }}" data-src="{{ $product->product_image_url }}" alt="thumb - {{ $product->product_title }}" class="lazy">
                                    <span class="tag2 hot">
                                        HOT
                                    </span>
                                </figure>
                            </div>
                        </div>
                        <div class="col-md-9 col-sm-12 col-xs-12">
                    @else
                        <div class="col-md-12 col-sm-12 col-xs-12">
                    @endif

                            <div class="product-detail">
                                <h5 class="name">
                                 {{ $product->product_code }} {{ $product->product_title }} <i class="hot-icon"></i>&#x1f331;<i class="vegan-icon"></i><i class="halal-icon"></i>
                                </h5>
                            </div>
                            <div class="description">
                                <p>{!! $product->product_description !!}</p>

                            </div>
                            <div class="product-info smart-form">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12 price-container">


                                        <!-- Preisboxen -->
@if($sizesWithPrices->isNotEmpty())
    @php $hasProductPrices = $sizesWithPrices->where('parent', $product->id)->isNotEmpty(); @endphp
    @if($hasProductPrices)
        @foreach($sizesWithPrices as $size)
            @if ($size->parent === $product->id)
                <div wire:click="addToCartNew({{ $product->id }}, '{{ $product->product_title }}', {{ $size->price }}, '{{ $size->size }}', 1)" role="button" class="price-box add-to-cart animated-box" title="{{ $product->product_title }} in den Warenkorb legen und in {{ $restaurant->street }} - {{ $restaurant->city }} bei {{ $restaurant->title }} bestellen">
                    <span class="price-box-title">{{ $size->size }}</span>
                    <span class="price-box-price">{{ $size->price }}&nbsp;€</span>
                </div>
            @endif
        @endforeach
    @else
        @if($product->base_price)
        <div wire:click="addToCartNew({{ $product->id }}, '{{ $product->product_title }}', {{ $product->base_price }}, '{{ $size->size }}', 1)" role="button" class="price-box add-to-cart animated-box" title="{{ $product->product_title }} in den Warenkorb legen und in {{ $restaurant->street }} - {{ $restaurant->city }} bei {{ $restaurant->title }} bestellen">

        @if ($product->bottle)
            <span class="price-box-title">+Pfand: {{ $product->bottle->bottles_value }}</span>
        @endif
            <span class="price-box-price">{{ $product->base_price }}&nbsp;€</span>
        </div>
        @else
            <div>
                <strong>Preis nicht verfügbar</strong>
            </div>
        @endif
    @endif
@else
    <div>
        <strong>Preis nicht verfügbar</strong>
    </div>
@endif



                                        <!-- Preisboxen -->

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Ende Produkt -->
            </div>




        @endforeach








        </div>
    </section>
  @endforeach

        <!-- Modal item order -->
        <div id="modal-dialog" class="zoom-anim-dialog mfp-hide">
            <div class="small-dialog-header">
                <h3 id="product-name">Product Name</h3>
            </div>
            <div class="content">
                <h5>Quantity</h5>
                <div class="numbers-row">
                    <input id="quantity" type="text" value="1" id="qty_1" class="qty2 form-control" name="quantity">
                </div>
                <h5>Size</h5>
                <ul class="clearfix" id="size-list">
                    <!-- Hier werden die Größen dynamisch eingefügt -->
                </ul>

                <h5 id="ingredients-list"></h5>


            </div>
            <div class="footer">
                <div class="row small-gutters">
                    <div class="col-md-12">
                        <button id="add-to-cart-btn" type="reset" class="btn_1 full-width">Add to cart</button>
                    </div>
                </div>
                <!-- /Row -->
            </div>
            </div>
            <!-- /Modal item order -->









  @script




  <script>
    Livewire.on('open-product-modal', (productData) => {
        const productId = productData[0].productId;
        const productName = productData[0].productName;
        const selectedPrice = productData[0].selectedPrice;
        const selectedSize = productData[0].selectedSize;
        const preparedIngredients = productData[0].preparedIngredients;

        // Aktualisiere den Produktnamen im Modal
        $('#product-name').text(productName);
        // Zeige die ausgewählte Größe und den Preis im Modal an
        $('#selected-size').text(selectedSize);
        $('#selected-price').text(selectedPrice);

        // Leere die Zutatenliste zuerst
        const ingredientsList = $('#ingredients-list');
        ingredientsList.empty();

        // Durchlaufe die Zutatenkategorien und füge sie der Liste hinzu
        Object.keys(preparedIngredients).forEach(category => {
            // Erstelle das h5-Element für die Kategorieüberschrift
            const categoryTitle = $('<h5>').text(category);
            ingredientsList.append(categoryTitle);

            // Erstelle die ul-Element für die Zutaten in dieser Kategorie
            const ulElement = $('<ul>').addClass('clearfix');
            ingredientsList.append(ulElement);

            // Durchlaufe die Zutaten in dieser Kategorie und füge sie der Liste hinzu
            Object.keys(preparedIngredients[category]).forEach(ingredient => {
                const prices = preparedIngredients[category][ingredient];

                // Erstelle das li-Element für jede Zutat
                const listItem = $('<li>');

                // Erstelle das label-Element für die Zutat
                const label = $('<label>').addClass('container_check').text(`${ingredient} + $${prices[0]}`);

                // Erstelle das input-Element für die Zutat
                const input = $('<input>').attr({ type: 'checkbox' });

                // Erstelle das span-Element für die Checkmark
                const checkmark = $('<span>').addClass('checkmark');

                // Füge das input und checkmark zum label hinzu
                label.append(input, checkmark);

                // Füge das label zur listItem hinzu
                listItem.append(label);

                // Füge das listItem zur ul-Element hinzu
                ulElement.append(listItem);
            });
        });

        // Öffnen Sie das Modal
        $.magnificPopup.open({
            items: {
                src: '#modal-dialog' // ID des Modals
            },
            type: 'inline',
            closeBtnInside: false,
            fixedContentPos: true,
            fixedBgPos: true,
            overflowY: 'auto',
            preloader: false,
            removalDelay: 300,
            mainClass: 'my-mfp-zoom-in'
        });
    });

// Eventlistener für den "Add to Cart" Button hinzufügen
$(document).off('click', '#add-to-cart-btn').on('click', '#add-to-cart-btn', function() {
    // Daten sammeln
    const selectedSize = $('#selected-size').text();
    const selectedPrice = $('#selected-price').text();
    const selectedIngredients = [];
    const productId = [];

    
    // Für jede ausgewählte Checkbox den Namen der Zutat extrahieren
    $('input[type=checkbox]:checked').each(function() {
        const ingredientName = $(this).parent().text().trim().split('+')[0].trim();
        selectedIngredients.push(ingredientName);
    });

    Livewire.dispatch('add-to-cart-option', {
    productId: productId,
    selectedSize: selectedSize,
    selectedPrice: selectedPrice,
    selectedIngredients: selectedIngredients
});


    // Schließen Sie das Modal
    $.magnificPopup.close();
});
</script>








 @endscript

</div>
