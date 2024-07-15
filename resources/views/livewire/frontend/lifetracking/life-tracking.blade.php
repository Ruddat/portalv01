<div class="container margin_60_40" wire:poll='fetchTrackingStatus'>


    <div class="container mt-4">
        <div class="row">


            <div class="col-lg-12 my-lg-0 my-1">
                <div id="main-content" class="bg-white border">
                    <h1>@autotranslate('Bestellübersicht', app()->getLocale())</h1>
                    <div class="info">
                        @if ($order->deliver_minutes)
                            <h5>@autotranslate('Ihre Geschätzte Lieferzeit zirka', app()->getLocale()) {{ $order->deliver_minutes }} @autotranslate('Minuten', app()->getLocale())</h5>
                        @endif
                    </div>

                    <div class="d-flex flex-column">
                        <div class="h5">@autotranslate('Hello', app()->getLocale()) {{ $order->surname }},</div>
                        <p>@autotranslate('wir liefern an', app()->getLocale()) <strong>{{ $order->shipping_street }} {{ $order->shipping_house_no }},
                            {{ $order->shipping_zip }} {{ $order->shipping_city }}</strong></p>
                    </div>
                    <div class="order my-3 bg-light">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="d-flex flex-column justify-content-between order-summary">
                                    <div class="d-flex align-items-center">
                                        <div class="text-uppercase">@autotranslate('Bestellnummer #', app()->getLocale()){{ $order->order_nr }}</div>
                                        <div class="blue-label ms-auto text-uppercase">@autotranslate($order->payment_type, app()->getLocale())</div>

                                    </div>
                                    <div class="fs-8">@autotranslate('Products', app()->getLocale()) #03</div>
                                    <div class="fs-8">
                                        {{ \Carbon\Carbon::parse($order->order_date)->translatedFormat('l, d F Y \u\m H:i') }}
                                    </div>

                                    <div class="rating d-flex align-items-center pt-1">
                                        <img src="https://www.freepnglogos.com/uploads/like-png/like-png-hand-thumb-sign-vector-graphic-pixabay-39.png" alt="">
                                        <span class="px-2">@autotranslate('Rating:', app()->getLocale())</span>

                                        @php
                                        $fullStars = floor($starrating);
                                        $halfStar = $starrating - $fullStars >= 0.5 ? true : false;
                                    @endphp

                                    @for ($i = 0; $i < $fullStars; $i++)
                                        <span class="fas fa-star"></span>
                                    @endfor

                                    @if ($halfStar)
                                        <span class="fas fa-star-half-alt"></span>
                                    @endif

                                    @for ($i = 0; $i < 5 - $fullStars - ($halfStar ? 1 : 0); $i++)
                                        <span class="far fa-star"></span>
                                    @endfor
                                    </div>
                                </div>



                            </div>
                            <div class="col-lg-8">
                                <div class="d-sm-flex align-items-sm-start justify-content-sm-between">
                                    <div class="status">@autotranslate('Status :', app()->getLocale()) @autotranslate($statusDescription, app()->getLocale())</div>
                                    @if ($votingStatus)
                                        <p>
                                            <span class="btn btn-success" style="pointer-events: none; color: white; background-color: green; border: none;">
                                                @autotranslate('Vielen Dank fuer Ihre Bewertung', app()->getLocale())
                                            </span>
                                        </p>
                                    @else
                                        <p>
                                            <a href="{{ route('votings-restaurant', ['orderHash' => $orderHash]) }}" class="btn_1 medium gradient pulse_bt mt-2">
                                                @autotranslate('Schreiben Sie eine Bewertung', app()->getLocale())
                                            </a>
                                        </p>
                                    @endif
                                </div>
                                <div class="progressbar-track">
                                    <ul class="progressbar">
                                        <li id="step-1" class="text-muted green">
                                            <span class="fas fa-store"></span>
                                        </li>
                                        <li id="step-2" class="text-muted green">
                                            <span class="fas fa-check"></span>
                                        </li>
                                        <li id="step-3" class="text-muted green">
                                            <span class="fas fa-delicious"></span>
                                        </li>
                                        <li id="step-4" class="text-muted">
                                            <span class="fas fa-truck-moving"></span>
                                        </li>
                                        <li id="step-5" class="text-muted">
                                            <span class="fas fa-box-open"></span>
                                        </li>
                                    </ul>
                                    <div id="tracker"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Order 2 -->
                    <div class="order my-2 bg-light">
                        <div class="row">
                            <div class="my-2 col-md-6 col-lg-6">
                                <div id="map" style="height: 500px;" wire:ignore></div>
                            </div>
                            <div class="my-3 col-md-6 col-lg-6 order-overview">
                                <h3>@autotranslate('Ihre Bestellung', app()->getLocale())</h3>
                                <ul class="order-list">
                                    <li>
                                        <div class="table-container">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>@autotranslate('Article Name', app()->getLocale())</th>
                                                        <th>@autotranslate('Price', app()->getLocale())</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $totalPrice = 0; // Initialisieren der Gesamtsumme
                                                    @endphp
                                                    @foreach($orderItems as $item)
                                                        <tr class="items">
                                                            <td>{{ $item->ArticleNo }}</td>
                                                            <td>{{ $item->ArticleName }} ({{ $item->ArticleSize }})</td>
                                                            <td>
                                                                @if(isset($item->Price))
                                                                    {{ number_format($item->Price, 2, '.', '') }}
                                                                    @php
                                                                        $totalPrice += $item->Price; // Preis jedes Artikels zur Gesamtsumme addieren
                                                                    @endphp
                                                                @else
                                                                    @autotranslate('Gratis', app()->getLocale())
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        @if (!empty($item->SubArticleList) && isset($item->SubArticleList->SubArticle))
                                                            @php
                                                                $subArticles = is_array($item->SubArticleList->SubArticle)
                                                                               ? $item->SubArticleList->SubArticle
                                                                               : [$item->SubArticleList->SubArticle];
                                                            @endphp
                                                            @foreach ($subArticles as $subArticle)
                                                                <tr class="subitems">
                                                                    <td></td>
                                                                    <td>-- {{ $subArticle->ArticleName }}</td>
                                                                    <td>
                                                                        @if(isset($subArticle->Price) && is_numeric($subArticle->Price))
                                                                            {{ number_format($subArticle->Price, 2, '.', '') }}
                                                                        @else
                                                                            @autotranslate('Gratis', app()->getLocale())
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        @endif
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            <p class="total-price">@autotranslate('Total Price:', app()->getLocale()) {{ number_format($totalPrice, 2, '.', '') }}</p>
                                        </div>

                                    </li>
                                </ul>
                            </div>






                        </div>

                    </div>
                    <div class="d-flex flex-column justify-content-between order-summary">
                        <a href="{{ route('restaurant.index', ['slug' => $this->shopData->shop_slug ?? $this->shopData->shop_slug]) }}" class="btn_1 medium gradient pulse_bt mt-2">@autotranslate('Zurück zum Restaurant', app()->getLocale())</a>
                    </div>
                </div>
            </div>
            <livewire:frontend.social-toast.social-proof/>

        </div>
    </div>

</div>
@push('specific-scripts')
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<script>
    var map = L.map('map').setView([{{ $trackshop['lat'] }}, {{ $trackshop['lng'] }}], 15);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    // Standard Icon für den Kunden
    L.marker([{{ $trackshop['lat'] }}, {{ $trackshop['lng'] }}]).addTo(map)
        .bindPopup('Ihre Bestellung ist hier.')
        .openPopup();

    // Eigenes Icon für den Store
    var storeIcon = L.icon({
        iconUrl: '{{ asset('frontend/img/store-icon.png') }}', // Pfad zu deinem Icon-Bild
        iconSize: [38, 38], // Größe des Icons
        iconAnchor: [22, 38], // Punkt des Icons, der auf die Position zeigt
        popupAnchor: [-3, -38] // Punkt, von dem aus das Popup ausgeht
    });

    L.marker([{{ $trackshop['lat'] }}, {{ $trackshop['lng'] }}], {
            icon: storeIcon
        }).addTo(map)
        .bindPopup('{{ $order->shop_name }}')
        .openPopup();
</script>


<style>
    .order-overview {
    background: url('../../frontend/img/graues-marmorhintergrundkonzept.jpg') no-repeat center center;
    background-size: cover;
    color: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.order-overview h3 {
    font-family: 'Chalkduster', 'Comic Sans MS', cursive;
    text-align: center;
    margin-bottom: 20px;
    color: white;
}

.order-list {
    list-style: none;
    padding: 0;
}

.order-item {
    font-family: 'Chalkboard', 'Comic Sans MS', cursive;
    margin-bottom: 10px;
}

.sub-article-list {
    list-style: none;
    padding-left: 20px;
}

.sub-article-item {
    font-family: 'Chalkboard', 'Comic Sans MS', cursive;
    margin-bottom: 5px;
}



.table-container {
    display: flex;
    flex-direction: column;
    overflow-x: auto;
}

.table {
    width: 100%;
    border-collapse: collapse;
}

.table th, .table td {
    padding: 8px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

.table th {
    background-color: #f6f1d3;
}

.table td {
    background-color: #fff;
}

.subitems td {
    padding-left: 16px;
    background-color: #f9f9f9;
}

.total-price {
    margin-top: 16px;
    font-weight: bold;
}


</style>


@endpush
