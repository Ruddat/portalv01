<div class="container">
    <!-- Renner-Penner Liste mit Buttons -->
    <div class="mb-4">
        <h1 class="mb-3">Renner-Penner Liste</h1>
        <div class="btn-group" role="group" aria-label="Time Period">
            <button wire:click="setTimePeriod('day')" class="btn btn-outline-primary">Tag</button>
            <button wire:click="setTimePeriod('week')" class="btn btn-outline-primary">Woche</button>
            <button wire:click="setTimePeriod('month')" class="btn btn-outline-primary">Monat</button>
            <button wire:click="setTimePeriod('year')" class="btn btn-outline-primary">Jahr</button>
        </div>
    </div>

    <!-- Top 5 Produkte -->
    <div class="col-xl-12 mb-4">
        <div class="d-flex align-items-center justify-content-between mb-2">
            <h2 class="mb-0">Top 10 Produkte</h2>
            <a href="favorite-menu.html" class="text-primary">Alle ansehen <i class="fa-solid fa-angle-right ms-2"></i></a>
        </div>
        <div class="swiper mySwiper-3">
            <div class="swiper-wrapper">
                @foreach($topProducts as $product)
                <div class="swiper-slide">
                    <div class="card dishe-bx">
                        <div class="card-header border-0 pb-0 pt-0 pe-3">
                            @if($product->discount)
                                <span class="badge badge-lg badge-danger side-badge">{{ $product->discount }}% Rabatt</span>
                            @endif
                            <span class="badge badge-lg badge-warning side-badge">Exclusive</span>

                            <i class="fa-solid fa-heart ms-auto c-heart c-pointer"></i>
                        </div>
                        <div class="card-body p-0 text-center">
                            <img src="{{ $product->product->product_image_url }}" alt="{{ $product->product->product_title }}" class="img-fluid">
                        </div>
                        <div class="card-footer border-0 px-3">
                            <a href="javascript:void(0);"><h4 class="mb-1">{{ $product->product->product_title }}</h4></a>
                            <h3 class="font-w700 mb-0 text-primary">{{ $product->size }} -- ${{ $product->price }}</h3>
                            <div class="d-flex align-items-center justify-content-between mt-2">
                                <div class="rating">
                                    <span class="badge bg-danger rounded-pill">{{ $product->total_quantity }} verkauft</span>

                                </div>
                                <div class="plus c-pointer">
                                    <a href="javascript:void(0);" class="btn btn-primary">Hinzufügen</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>

    <!-- Flop 10 Produkte -->
    <div class="col-xl-12">
        <div class="d-flex align-items-center justify-content-between mb-2">
            <h2 class="mb-0">Flop 10 Produkte</h2>
            <a href="favorite-menu.html" class="text-primary">Alle ansehen <i class="fa-solid fa-angle-right ms-2"></i></a>

        </div>
        <ul class="list-group">
            @foreach($flopProducts as $product)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{ $product->product->product_title }}
                    <span class="badge bg-danger rounded-pill">{{ $product->total_quantity }} verkauft</span>
                </li>
            @endforeach
        </ul>
    </div>
</div>
