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
                                    <p>{!! $product->product_description !!}</p>

                                </div>
                                <div class="product-info smart-form">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12 price-container">


                                            <!-- Preisboxen -->
                                            @if ($sizesWithPrices->isNotEmpty())
                                                @php $hasProductPrices = $sizesWithPrices->where('parent', $product->id)->isNotEmpty(); @endphp
                                                @if ($hasProductPrices)
                                                    @foreach ($sizesWithPrices as $size)
                                                        @if ($size->parent === $product->id)
                                                            <div wire:click="addToCartNew({{ $product->id }}, '{{ $product->product_title }}', {{ $size->price }}, {{ $size->size_id }}, '{{ $size->size }}', 1)"
                                                                role="button"
                                                                class="price-box add-to-cart animated-box"
                                                                title="{{ $product->product_title }} in den Warenkorb legen und in {{ $restaurant->street }} - {{ $restaurant->city }} bei {{ $restaurant->title }} bestellen">

                                                                @if ($product->bottle)
                                                                <span class="price-box-title">+Pfand:
                                                                    {{ $product->bottle->bottles_value }}</span>
                                                            @endif
                                                                <span
                                                                    class="price-box-title">{{ $size->size }}</span>
                                                                <span
                                                                    class="price-box-price">{{ $size->price }}&nbsp;€</span>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                @else
                                                    @if ($product->base_price)
                                                        <div wire:click="addToCartNew({{ $product->id }}, '{{ $product->product_title }}', {{ $product->base_price }}, {{ $size->size_id }}, '{{ $size->size }}', 1)"
                                                            role="button" class="price-box add-to-cart animated-box"
                                                            title="{{ $product->product_title }} in den Warenkorb legen und in {{ $restaurant->street }} - {{ $restaurant->city }} bei {{ $restaurant->title }} bestellen">

                                                            @if ($product->bottle)
                                                                <span class="price-box-title">+Pfand:
                                                                    {{ $product->bottle->bottles_value }}</span>
                                                            @endif
                                                            <span
                                                                class="price-box-price">{{ $product->base_price }}&nbsp;€</span>
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
                    'id' => $group[0]['id'], // ID hinzugefügt
                    'quantity' => count($group),
                    'price' => $group[0]['price'] * count($group)
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
        @foreach ($freeIngredients as $ingredient)
            <div class="col-lg-3 col-md-3 col-sm-3 mb-2">
                <p>{{ $ingredient['title'] }}
                    {{ $ingredient['price'] > 0 ? 'Gratis' : number_format($ingredient['price'], 2, ',', '.') . '€' }}</p>
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

<div class="cart-select-container d-flex flex-row">
    <div class="cart-button-box flex-grow-1 d-flex justify-content-between align-items-center" id="cart-button-box">
        <select wire:model="selectedQuantity" wire:change="updateQuantity" class="addtocart_qty left">
            @for ($i = 1; $i <= 10; $i++)
                <option value="{{ $i }}">{{ $i }}</option>
            @endfor
            <option value="10+">10+</option>
        </select>
        <input type="number" class="js_addtocart_qty addtocart_qty left" value="1" min="1" maxlength="2" style="display:none">

        <button type="button"
        class="btn btn-warning text-end"
        wire:click="addToCartProduct({{ $product->id }}, '{{ $productTitle }}', {{ $totalPrice }}, {{ $size->size_id }}, '{{ $productSize }}', 1)"
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
    <div class="placeholder"></div>
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
                                                    @if ($ingredient['free_ingredients'])
                                                        Gratis
                                                    @else
                                                        {{ $subIngredient['price'] == 0 ? 'Gratis' : number_format($subIngredient['price'], 2, ',', '€') }}
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
                    *Der angegebene Preis basiert auf dem Referenzpreis gemäß § 11 PAngV (Referenzpreis = niedrigster
                    Gesamtpreis der letzten 30 Tage vor Beginn der Preisermäßigung).
                <h5>Zusatzstoffe:</h5>
                <!-- Schleife für Allergene -->
                @foreach ($allergens as $allergen)
                    <strong>{{ $allergen->id }} - </strong>
                    {{ $allergen->allergenic_short_title }}
                @endforeach

                <h5>Allergene:</h5>
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






<style>


.overlay {
    /* Stile für das Overlay */
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5); /* Hintergrundfarbe mit Transparenz */
    z-index: 99999; /* Stellen Sie sicher, dass das Overlay über allem anderen liegt */
    display: flex;
    justify-content: center;
    align-items: center;
    backdrop-filter: blur(10px); /* Unschärfeeffekt für den Hintergrund */
    background-color: rgba(0,0,0,.5); /* Hintergrundfarbe mit Transparenz */
    overflow-y: auto;
 }

.overlay-content {
    /* Stile für den Overlay-Inhalt */
    position: relative;
    height: 100%;
    margin: 20px auto;
    overflow-y: auto;
    background-color: white;
    padding: 20px;
    width: 768px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    /* Schatten für den Inhalt */
    z-index: 1;
   /* background-color: rgba(251, 188, 47, 0.8); */
}

.overlay-header {
    /* Stile für den Header des Overlays */
    position: relative;
    top: 0;
    background-color: #ffffff;
    /* Hintergrundfarbe des Headers */
    padding: 10px 20px;
    /* Abstand des Headers */
    border-bottom: 1px solid #cccccc;
    /* Eine untere Trennlinie für den Header */
    box-shadow: 0 5px 5px rgba(0, 0, 0, 0.1);
    /* Schatten, um den oberen Rand zu verdecken */
    z-index: 2;
}

.close-btn {
    position: absolute;
    top: -2%;
    right: -2%;
    cursor: pointer;
    font-size: 36px;
    color: #ff0000;
    /* border: 1px solid #ff0000; */
    background-color: #ffffff;
    border-radius: 50%;
    /* width: 36px; */
    /* height: 36px; */
    display: flex;
    justify-content: center;
    align-items: center;
}

        .close-btn:hover {
            color: #ff6666;
            /* Hellere rote Farbe im Hover-Zustand */
            border-color: #ff6666;
            /* Hellere rote Farbe für den Rand im Hover-Zustand */
        }

.small-dialog-header {
    /* Stile für den kleinen Dialog-Header */
}

.extra-ingredients {
    /* Stile für zusätzliche Zutaten */

}

.extra-ingredients-box {
    /* Stile für das Behälterfeld der zusätzlichen Zutaten */
    max-height: 200px;
}

.ingredient-container {
    border: 1px solid #ccc; /* Rahmen um die Zutat */
    padding: 10px; /* Innenabstand */
    border-radius: 5px; /* Runde Ecken */
}

.cart-select-container {
    /* Stile für den Container zur Auswahl des Warenkorbs */
}

.cart-button-box {
    /* Stile für den Button-Container des Warenkorbs */

}

.card.card-body.row {
                        flex-wrap: wrap;
                        flex-direction: row;
                        cursor: pointer;
                        /* color: chocolate; */
                    }

.placeholder {
    /* Platzhalterstil */
}

.overlay-ingredients {
    /* Stile für die Zutaten im Overlay */
    position: relative;
    height: auto;
    margin: 20px auto;

}

.ingredient-box {
    /* Stile für den Behälter der Zutaten */
}

.topping-box {
    line-height: normal;
    text-wrap: pretty;
}

.topping-box span {
    cursor: pointer;
}



.collapse-body-text {
    transition: transform 0.3s, font-size 0.3s; /* Übergangseffekte für das Icon und den Text */
}

.collapse-body-text:hover img {
    animation: bounce 0.5s infinite; /* Hüpfende Animation für das Icon */
}

@keyframes bounce {
    0%, 100% {
        transform: translateY(0); /* Anfangs- und Endposition */
    }
    50% {
        transform: translateY(-10px); /* Höhe des Sprungs */
    }
}

.collapse-body-text:hover span {
    font-size: 1.1em; /* Text vergrößern beim Überfahren */
}

.product-infos {
    /* Stile für Produktinformationen */
    color: darkgrey;

}


.product-infos h5 {
    /* Stile für Produktinformationen */
    color: darkgrey;
    line-height: normal;

}

i.feather-shopping-bag {
    font-size: larger;
    color: whitesmoke;
    text-shadow: 1px 1px black;
    transition: transform 0.3s ease; /* Fügt eine Animationsübergangszeit hinzu */
}

i.feather-shopping-bag:hover {
    transform: scale(1.2); /* Ändert die Größe des Icons beim Überfahren mit der Maus */
}


.extra-ingredients-box.row {
    background-color: whitesmoke;
    margin-bottom: 10px;
    border-radius: 2px;
    box-shadow: 1px;
    margin-top: 8px;
}

.flash {
    animation: flashAnimation 0.5s ease;
}

@keyframes flashAnimation {
    0% {
        opacity: 1;
    }
    50% {
        opacity: 0;
    }
    100% {
        opacity: 1;
    }
}


button.btn.btn-warning.text-end {
    content: '';
    display: block;
    width: 90%;
    background-color: #e60004;
    border: none;
    box-shadow: 0 1px 3px 0 rgba(0,0,0,.3);
    color: #fff;
    cursor: pointer;
    display: inline-block;
    /* font-family: montheavy; */
    font-size: 1rem;
    font-weight: 700;
    padding: 10px 12px;
    position: relative;
    text-align: center;
    text-transform: uppercase;
    text-decoration: none;
    transition: .3s;
}

.plakat-box {
    background-color: #f9f9f9; /* Hintergrundfarbe */
    border: 2px solid #ccc; /* Rahmen */
    padding: 20px; /* Innenabstand */
    border-radius: 10px; /* Abrundung der Ecken */
}


@media screen and (max-width: 600px) {
    .overlay-content {
        width: 80%;
        /* Andere Stile für kleine Bildschirme */
    }
}

</style>


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
