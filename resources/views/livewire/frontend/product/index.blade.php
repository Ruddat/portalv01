<div>
    <!-- Ihr Produktbereich -->
    @if($categories->isEmpty())
    <div class="plakat-box">
    <p>Der Shop wird eingerichtet, bitte schau später noch einmal vorbei!!</p>
    </div>

    @else

    @foreach ($categories as $category)
        <section id="section-{{ $category->id }}">
            <h4>{{ $category->category_name }}</h4>
            <p>{{ $category->category_description }}</p>
            <div class="row">
                <div class="col-md-12">
                    <div class="image-wrapper" style="margin-bottom: 12px;">
                        <img src="{{ asset($category->category_image_url) }}" alt="{{ $category->category_name }}"
                            class="category-image rounded shadow" style="max-width: 100%; max-height: 168px;">
                    </div>
                </div>
            </div>
            <div class="row">

                @foreach ($productsByCategory[$category->category_name] as $product)
                    <div class="col-xs-12 col-md-12">
                        <!-- Produkt -->
                        <div class="product-content product-wrap clearfix">

                            <div class="row">
                                @if (!empty($product->product_image))
                                    <div class="col-md-3 col-sm-12 col-xs-12">
                                        <div class="product-image">
                                            <figure class="zoom-effect">
                                                <img src="{{ $product->product_image_url }}"
                                                    data-src="{{ $product->product_image_url }}"
                                                    alt="thumb - {{ $product->product_title }}" class="lazy">
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
                                        {{ $product->product_code }} {{ $product->product_title }} <i
                                            class="hot-icon"></i>&#x1f331;<i class="vegan-icon"></i><i
                                            class="halal-icon"></i>
                                    </h5>
                                </div>
                                <div class="description">
                                 {!! $product->product_description !!}

                                </div>
                                <div class="product-info smart-form">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12 price-container">


<!-- Preisboxen -->
@if ($sizesWithPrices->isNotEmpty())
    @php $hasProductPrices = $sizesWithPrices->where('parent', $product->id)->isNotEmpty(); @endphp
    @if ($hasProductPrices)
        @foreach ($sizesWithPrices as $size)
            @if ($size->parent === $product->id && $size->price > 0)  <!-- Check if price is greater than 0 -->
                <div wire:click="addToCartNew({{ $product->id }}, '{{ addslashes($product->product_title) }}', {{ $size->price }}, {{ $size->size_id }}, '{{ $size->size }}', 1)"
                    role="button"
                    class="price-box add-to-cart animated-box"
                    title="{{ $product->product_title }} in den Warenkorb legen und in {{ $restaurant->street }} - {{ $restaurant->city }} bei {{ $restaurant->title }} bestellen">

                    @if ($product->bottle)
                        <span class="price-box-title">+Pfand:
                            {{ $product->bottle->bottles_value }}</span>
                    @endif
                    <span class="price-box-title">{{ $size->size }}</span>
                    <span class="price-box-price">{{ $size->price }}&nbsp;€</span>
                </div>
            @endif
        @endforeach
    @else
        @if ($product->base_price > 0)  <!-- Check if base price is greater than 0 -->
            <div wire:click="addToCartNew({{ $product->id }}, '{{ $product->product_title }}', {{ $product->base_price }}, '{{ $size->size_id }}', '0', 1)"
                role="button" class="price-box add-to-cart animated-box"
                title="{{ $product->product_title }} in den Warenkorb legen und in {{ $restaurant->street }} - {{ $restaurant->city }} bei {{ $restaurant->title }} bestellen">

                @if ($product->bottle)
                    <span class="price-box-title">+Pfand:
                        {{ $product->bottle->bottles_value }}</span>
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

@endif







{{-- Product Overlay --}}
@if ($showOverlay)
    <div class="overlay">
        <div class="overlay-content">

            <div class="overlay-header">
                <div class="close-btn" wire:click="closeOverlay"><i class="feather-x-circle"></i></div>
                <div class="small-dialog-header">
                    <h3 id="product-name">{{ $productTitle }} {{ $productSize }} {{ number_format($productPrice, 2, ',', '.') }} €</h3>
                    <p>{{ $productDescription }}</p>
                </div>

                <fieldset class="extra-ingredients" @if (empty($selectedIngredients) && empty($freeIngredients)) style="display: none;" @endif>
                    <strong>Zutaten nach Wunsch (pro Artikel):</strong>
{{-- Iteriere über ausgewählte Zutaten und füge Flash-Effekt hinzu --}}
<div>
    <div class="extra-ingredients-box row">
        {{-- Ausgewählte Zutaten --}}
        @php
        // Gruppieren von Zutaten nach Namen und Berechnen von Gesamtmenge und Gesamtpreis
        $groupedIngredients = collect($selectedIngredients)->groupBy('title')->map(function ($group) {
            return [
                'title' => $group[0]['title'],
                'id' => $group[0]['id'],
                // Summe der tatsächlichen Mengen berechnen, anstatt nur die Anzahl der Elemente
                'quantity' => $group->sum('quantity'), // Statt count($group)
                'price' => $group[0]['price'] * $group->sum('quantity')
            ];
        });
    @endphp


        @foreach ($groupedIngredients as $ingredient)
            <div class="col-lg-3 col-md-3 col-sm-3 mb-2">
                <div class="ingredient-container" wire:key="{{ $ingredient['id'] }}">
                    <div class="topping-box">
                        {{ $ingredient['title'] }}
                        @if ($ingredient['quantity'] > 1)
                            ({{ $ingredient['quantity'] }}x)
                        @endif
                        <span wire:click="incrementQuantity('{{ $ingredient['id'] }}', '{{ $product->id }}')" onclick="flashElement(this.parentNode.parentNode)"><i class="feather-plus"></i></span>
                        <span wire:click="decrementQuantity('{{ $ingredient['id'] }}', '{{ $product->id }}')" onclick="flashElement(this.parentNode.parentNode)"><i class="feather-minus"></i></span>
                        <span wire:click="removeIngredient('{{ $ingredient['id'] }}', '{{ $product->id }}')" onclick="flashElement(this.parentNode.parentNode)"><i class="feather-x"></i></span>
                        @if (isset($ingredient['price']))
                            ({{ number_format($ingredient['price'], 2, ',', '.') }}€)
                        @endif
                    </div>
                </div>
            </div>
        @endforeach

        <hr>
        {{-- Kostenlose Zutaten --}}
{{-- Kostenlose Zutaten --}}
@foreach ($freeIngredients as $ingredient)
    <div class="col-lg-3 col-md-3 col-sm-3 mb-2">
        <p>{{ $ingredient['title'] }}
            {{ $ingredient['price'] > 0 ? 'Gratis' : number_format($ingredient['price'], 2, ',', '.') . '€' }}
        </p>
        <button wire:click="removeFreeIngredient({{ $ingredient['id'] }})" class="btn btn-danger btn-sm">Entfernen</button>
    </div>
@endforeach

    </div>
</div>




                </fieldset>

                @php
                // Gesamtpreis berechnen, startend mit dem Basispreis des Produkts
                $totalPrice = $productPrice;

                foreach ($selectedIngredients as $ingredient) {
                    // Wenn die Zutat einen Preis hat und nicht als kostenlos markiert ist
                    if (isset($ingredient['price']) && is_numeric($ingredient['price']) && $ingredient['price'] > 0 && (!isset($ingredient['is_free']) || !$ingredient['is_free'])) {
                        // Fügen Sie den Preis der Zutat multipliziert mit der Anzahl hinzu
                        $totalPrice += (float) $ingredient['price'];
                   //     dd($totalPrice);
                    }
                }
            @endphp

<div class="cart-select-container d-flex flex-row flex-wrap">
    <div class="cart-button-box flex-grow-1 d-flex justify-content-between align-items-center mb-2" id="cart-button-box">
        <!-- Das select-Feld wird hier ausgeblendet -->
        <select wire:model="selectedQuantity" wire:change="updateQuantity" class="addtocart_qty left" style="visibility: hidden;">
            @for ($i = 1; $i <= 10; $i++)
                <option value="{{ $i }}">{{ $i }}</option>
            @endfor
            <option value="10+">10+</option>
        </select>

        <input type="number" class="js_addtocart_qty addtocart_qty left" value="1" min="1" maxlength="2" style="display:none">

        <button type="button" class="text-end"
            wire:click="addToCartProduct({{ $productId }}, '{{ addslashes($productTitle) }}', {{ $productPrice }}, {{ $selectedSizeId }}, '{{ $productSize }}', 1)"
            @if($disableAddToCartButton) disabled @endif>
            <span class="btn-icon-start text-primary">
                <i class="feather-shopping-bag"></i>
            </span>
            In den Warenkorb für
            <span class="regular-price" id="product-price-592">
                <span class="price">{{ number_format($totalPrice, 2, ',', '.') }} €</span>
            </span>
        </button>
    </div>
</div>

            </div>

            <div class="overlay-ingredients">
                <h1></h1>


                <div class="ingredient-box d-flex flex-column" id="collapseIngredients">
                    <button class="btn btn-square btn-light text-start" type="button" data-bs-toggle="collapse" data-bs-target="#collapse" aria-expanded="false" aria-controls="collapse">
                        Kommentar
                    </button>

                    <div class="collapse" id="collapse">
                        <div class="card card-body">
                            <div class="mb-3">
                                <textarea class="form-control" id="formControlTextarea1" style="height: 140px;" rows="3" cols="25"></textarea>
                            </div>
                        </div>
                    </div>

                    @foreach ($getIngredientData as $ingredient)
                    @php
                        $minPrice = $ingredient['free_ingredients'] ? 0 : min(array_column($ingredient['ingredients'], 'price'));
                        $quantity = $ingredient['free_ingredients'] ? $ingredient['free_ingredients'] . 'x' : '';
                        $gratis = $ingredient['free_ingredients'] > 0 ? 'Gratis ' . $quantity : 'ab ' . number_format($minPrice, 2, ',', '.') . '€';

                        // Überprüfen, ob ein Limit für die maximale Anzahl von Zutaten pro Kategorie festgelegt ist
                        $isMaxSet = $ingredient['max_ingredients'] > 0;
//dd($isMaxSet);
                        // Zählen Sie die Anzahl der ausgewählten Zutaten pro Kategorie
                        $selectedCount = $this->countSelectedIngredients($ingredient);

                        // Überprüfen, ob die maximale Anzahl erreicht wurde (nur wenn ein Limit festgelegt ist)
                        $isMaxReached = $isMaxSet && $selectedCount >= $ingredient['max_ingredients'];

                        // Überprüfen, ob die aktuelle Zutat kostenlose Zutaten hat
                        $hasFreeIngredients = $ingredient['free_ingredients'] > 0;

                        // Überprüfen, ob die aktuelle Zutat bereits ausgewählt wurde
                        $isIngredientSelected = in_array($ingredient['ingredient_id'], $openIngredients);

                        // Überprüfen, ob die Kategorie deaktiviert werden soll, wenn das maximale Limit erreicht ist
                        $isCategoryDisabled = $isMaxSet && $isMaxReached;

                        // Berechnen der Anzahl der noch erforderlichen Zutaten
                        $remainingRequiredQuantity = max(0, $ingredient['min_ingredients'] - $selectedCount);
                        $requiredQuantity = $remainingRequiredQuantity > 0 ? ' (' . $remainingRequiredQuantity . ' erforderlich)' : '';
                    @endphp

@if (!$isCategoryDisabled)
    @php
// Anzahl der bereits ausgewählten Zutaten in der aktuellen Gruppe
$selectedCount = $this->countSelectedIngredients($ingredient);
$remainingFree = max(0, $ingredient['free_ingredients'] - $selectedCount);

$gratis = '';
if ($remainingFree > 0) {
    $gratis = 'Gratis ' . ($remainingFree > 1 ? $remainingFree . 'x' : ''); // Hier kannst du die Anzeige anpassen
} else {
    $minPrice = min(array_column($ingredient['ingredients'], 'price'));
    $gratis = 'Ab ' . number_format($minPrice, 2, ',', '.') . ' €';
}
    @endphp
    <button class="btn btn-square btn-light text-start @if($isOpen) open @endif" type="button" wire:click="toggleIngredient('{{ $ingredient['ingredient_id'] }}')" data-bs-toggle="collapse" data-bs-target="#collapse{{ $ingredient['ingredient_id'] }}" aria-expanded="true" aria-controls="collapse{{ $ingredient['ingredient_id'] }}">
        {{ $ingredient['heading'] }} - {{ $gratis }}
        <span style="color: {{ $this->disableAddToCartButton && $ingredient['min_ingredients'] > 0 ? 'red' : '' }}">{{ $requiredQuantity }}</span>
    </button>

    <div class="collapse @if($isIngredientSelected) show @endif" aria-labelledby="ingredient-heading{{ $ingredient['ingredient_id'] }}" id="collapse{{ $ingredient['ingredient_id'] }}">
        <div class="card card-body row">
            @forelse ($ingredient['ingredients'] as $subIngredient)
                <div class="col-lg-4 col-md-4 col-sm-6 mb-2">
                    <div class="collapse-body-text" wire:click="selectIngredient('{{ $subIngredient['id'] }}', '{{ $productId }}', '{{ $ingredient['node_id'] }}' )">
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('backend/images/avatar/1.jpg') }}" class="rounded-lg me-2" width="24" alt="">
                            <span class="w-space-no">
                                {{ $subIngredient['title'] }} -
                                @php
                                $selectedCount = $this->countSelectedIngredients($ingredient);
                                $isFree = $selectedCount < $ingredient['free_ingredients'];
                            @endphp

                            @if ($isFree)
                                Gratis
                            @else
                                {{ number_format($subIngredient['price'], 2, ',', '.') }} €
                            @endif
                            </span>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col">
                    Keine Optionen verfügbar
                </div>
            @endforelse
        </div>
    </div>
@endif



                @endforeach







                </div>
            </div>


            <!-- Zum Schließen des Overlays -->
            <button wire:click="closeOverlay">Overlay schließen</button>

            <div class="product-infos">
                <hr>
                @autotranslate('*The indicated price is based on the reference price according to § 11 PAngV (reference price = lowest total price of the last 30 days before the start of the price reduction).', app()->getLocale())

                <h5>@autotranslate('Additives:', app()->getLocale())</h5>
                <!-- Schleife für Allergene -->
                @foreach ($allergens as $allergen)
                    <strong>{{ $allergen->id }} - </strong>
                    {{ $allergen->allergenic_short_title }}
                @endforeach

                <h5>@autotranslate('Allergens:', app()->getLocale())</h5>
                <!-- Schleife für Zusatzstoffe -->
                @foreach ($additives as $additive)
                    <strong>{{ $additive->additive_nr }} -</strong>
                    {{ $additive->additive_title }}
                @endforeach

            </div>

            <!-- Weitere Inhalte können hier eingefügt werden -->

        </div>
    </div>
@endif









<!-- JavaScript-Funktion für den Flash-Effekt -->
<script>
    function flashElement(element) {
        element.classList.add('flash');
        setTimeout(function() {
            element.classList.remove('flash');
        }, 500); // Zeit in Millisekunden, kann nach Bedarf angepasst werden
    }
</script>


    @push('specific-scripts')
    @endpush

</div>
