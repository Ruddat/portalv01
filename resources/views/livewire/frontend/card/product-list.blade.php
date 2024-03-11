<div>
    {{-- Nothing in the world is as soft and yielding as water. --}}

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
                        <a href="#modal-dialog" class="menu_item modal_dialog" data-product="{{ json_encode($product) }}">
                            <figure class="zoom-effect">
                                <img src="{{ $product->product_image_url }}" data-src="{{ $product->product_image_url }}" alt="thumb - {{ $product->product_title }}" class="lazy">
                            </figure>
                            <h3>{{ $product->product_code }} {{ $product->product_title }}</h3>
                            @if ($product->bottle)
                                <p>Pfand: {{ $product->bottle->bottles_value }}</p>
                            @endif
                            <p>{!! $product->product_description !!}</p>
                            @if ($product->minPrice)
                            <strong>ab €{{ $product->minPrice }}</strong>
                        @elseif ($product->basePrice)
                            <strong>€{{ $product->basePrice }}</strong>
                        @else
                            <strong>Preis nicht verfügbar</strong>
                        @endif

                        </a>
                        <button wire:click="addToCart({{ $product->id }}, '{{ $product->product_title }}', {{ $product->minPrice }}, 1)">In den Warenkorb</button>

                    bla bla @lang('messages.welcome')
                    </div>
                </div>
            @endforeach
        </div>
    </section>
  @endforeach
</div>
