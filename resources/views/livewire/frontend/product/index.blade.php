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
            <div class="col-md-6">
                <div class="product-card">
                    <a href="#" wire:click.prevent="addToCart('{{ $product->id }}', '{{ addslashes($product->product_title) }}', '{{ $minPrices[$product->id] }}', 1)" class="menu_item" data-product-title="{{ $product->product_title }}">
                        <figure class="zoom-effect">
                            <img src="{{ $product->product_image_url }}" data-src="{{ $product->product_image_url }}" alt="thumb - {{ $product->product_title }}" class="lazy">
                        </figure>
                        <h3>{{ $product->product_code }} {{ $product->product_title }}</h3>
                        @if ($product->bottle)
                            <p>Pfand: {{ $product->bottle->bottles_value }}</p>
                        @endif
                        <p>{!! $product->product_description !!}</p>
                        @if (isset($minPrices[$product->id]))
                            <strong>ab €{{ $minPrices[$product->id] }}</strong>
                        @else
                            <strong>Preis nicht verfügbar</strong>
                        @endif

                    </a>

                </div>
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

                <h5>Choose your crust</h5>
                <ul class="clearfix">
                    <li>
                        <label class="container_radio">Thin crust<span>+ $3.30</span>
                            <input type="radio" value="option1" name="options_2">
                            <span class="checkmark"></span>
                        </label>
                    </li>
                    <li>
                        <label class="container_radio">Thick crust<span>+ $5.30</span>
                            <input type="radio" value="option2" name="options_2">
                            <span class="checkmark"></span>
                        </label>
                    </li>
                    <li>
                        <label class="container_radio">Cheese crust<span>+ $8.30</span>
                            <input type="radio" value="option3" name="options_2">
                            <span class="checkmark"></span>
                        </label>
                    </li>

                <h5>Extra Ingredients</h5>
                <ul class="clearfix">
                    <li>
                        <label class="container_check">Extra Tomato<span>+ $4.30</span>
                            <input type="checkbox">
                            <span class="checkmark"></span>
                        </label>
                    </li>
                    <li>
                        <label class="container_check">Extra Peppers<span>+ $2.50</span>
                            <input type="checkbox">
                            <span class="checkmark"></span>
                        </label>
                    </li>
                    <li>
                        <label class="container_check">Extra Ham<span>+ $4.30</span>
                            <input type="checkbox">
                            <span class="checkmark"></span>
                        </label>
                    </li>
                </ul>
            </div>
            <div class="footer">
                <div class="row small-gutters">
                    <div class="col-md-4">
                        <button id="cancel-btn" type="reset" class="btn_1 outline full-width mb-mobile">Cancel</button>
                    </div>
                    <div class="col-md-8">
                        <button id="add-to-cart-btn" type="reset" class="btn_1 full-width">Add to cart</button>
                    </div>
                </div>
                <!-- /Row -->
            </div>
            </div>
            <!-- /Modal item order -->

  @script
<script type="text/javascript">

Livewire.on('show-options-modal', (productDataArray) => {
    // Zugriff auf das innere Objekt innerhalb des Arrays
    const productData = productDataArray[0].productData;

    // Produktinformationen
    const productId = productData.productId;
    const productName = productData.productName;
    const productQuantity = 1;

    // Aktualisieren Sie den Produktnamen im Modal
    $('#product-name').text(productName);

    // Anzeigen der Größen im Modal
    const sizeList = $('#size-list');
    sizeList.empty(); // Leeren Sie die Größenliste zuerst

    productData.sizes.forEach((size, index) => {
        const sizeItem = $('<li>');

        const label = $('<label>').addClass('container_radio').text(size.title);
        const span = $('<span>').text(`+ $${getPriceForSize(productData.prices, size.id)}`);
        const input = $('<input>').attr({ type: 'radio', value: index, name: 'size_options' });

        // Markieren Sie die erste Größe als ausgewählt
        if (index === 0) {
            input.attr('checked', true);
        }

        const checkmark = $('<span>').addClass('checkmark');

        label.append(span, input, checkmark);
        sizeItem.append(label);
        sizeList.append(sizeItem);
    });

    // Öffnen Sie das Modal
    $.magnificPopup.open({
        items: {
            src: '#modal-dialog' // ID des Modals
        },
        type: 'inline',
        closeBtnInside: true,
        fixedContentPos: true,
        fixedBgPos: true,
        overflowY: 'auto',
        preloader: false,
        removalDelay: 300,
        mainClass: 'my-mfp-zoom-in'
    });

// Eventlistener für den "Add to cart" Button hinzufügen
$('#add-to-cart-btn').on('click', function() {
    // Abrufen der ausgewählten Größe
    const selectedSizeIndex = $('input[name="size_options"]:checked').val();
    const selectedSize = productData.sizes[selectedSizeIndex];

    // Abrufen der ausgewählten Menge
    const selectedQuantity = $('#quantity').val();

    // Abrufen des Preises für die ausgewählte Größe
    const selectedPrice = getPriceForSize(productData.prices, selectedSize.id);

    // Livewire-Event auslösen und Daten als Array übergeben
    Livewire.dispatch('add-to-cart', [productId, productName, selectedPrice, selectedSize, selectedQuantity]);

    // Schließen Sie das Modal
    $.magnificPopup.close();
});

    // Eventlistener für den "Cancel" Button hinzufügen
    $('#cancel-btn').on('click', function() {
        // Schließen Sie das Modal
        Livewire.dispatch('closeModal');
    });
});


// Funktion, um den Preis für eine bestimmte Größe zu erhalten
function getPriceForSize(prices, sizeId) {
    // Durchlaufen Sie die Preise und finden Sie den Preis für die angegebene Größe
    for (let i = 0; i < prices.length; i++) {
        if (prices[i].size_id === sizeId) {
            return prices[i].price;
        }
    }
    // Rückgabe eines Standardwerts, falls der Preis nicht gefunden wird
    return 'N/A';
}



</script>
 @endscript

</div>
