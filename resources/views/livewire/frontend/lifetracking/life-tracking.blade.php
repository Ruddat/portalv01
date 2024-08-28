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
                        <a href="{{ localized_route('restaurant.index', ['slug' => $this->shopData->shop_slug ?? $this->shopData->shop_slug]) }}" class="btn_1 medium gradient pulse_bt mt-2">@autotranslate('Zurück zum Restaurant', app()->getLocale())</a>
                    </div>
                </div>
            </div>









            <div class="container pb-5 mb-sm-4">
                <!-- Details-->
                <div class="row mb-3">
                    <div class="col-sm-4 mb-2">
                        <div class="bg-secondary p-4 text-dark text-center">
                            <span class="font-weight-semibold mr-2">Shipped via:</span>UPS Ground
                        </div>
                    </div>
                    <div class="col-sm-4 mb-2">
                        <div class="bg-secondary p-4 text-dark text-center">
                            <span class="font-weight-semibold mr-2">Status:</span>Quality check
                        </div>
                    </div>
                    <div class="col-sm-4 mb-2">
                        <div class="bg-secondary p-4 text-dark text-center">
                            @if ($order->deliver_minutes)
                                @autotranslate('Ihre geschätzte Lieferzeit zirka', app()->getLocale()) {{ $order->deliver_minutes }} @autotranslate('Minuten', app()->getLocale())
                            @else
                                @autotranslate('Die Lieferzeit wird in Kürze hier angezeigt.', app()->getLocale())
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Progress-->
                <div class="steps">
                    <div class="steps-header">
                        <div class="progress" role="progressbar" aria-label="Animated striped example" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" style="width: 75%"></div>
                        </div>
                    </div>

                    <div class="steps-body">
                        <!-- Each step represents a different status in the order process -->
                        <div class="step step-completed">
                            <span class="step-indicator">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                            </span>
                            <span class="step-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle">
                                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                </svg>
                            </span>Order confirmed
                        </div>

                        <div class="step step-completed">
                            <span class="step-indicator">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                            </span>
                            <span class="step-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings">
                                    <circle cx="12" cy="12" r="3"></circle>
                                    <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path>
                                </svg>
                            </span>Processing order
                        </div>

                        <div class="step step-active">
                            <span class="step-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-award">
                                    <circle cx="12" cy="8" r="7"></circle>
                                    <polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline>
                                </svg>
                            </span>Quality check
                        </div>

                        <div class="step">
                            <span class="step-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-truck">
                                    <rect x="1" y="3" width="15" height="13"></rect>
                                    <polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon>
                                    <circle cx="5.5" cy="18.5" r="2.5"></circle>
                                    <circle cx="18.5" cy="18.5" r="2.5"></circle>
                                </svg>
                            </span>Product dispatched
                        </div>

                        <div class="step">
                            <span class="step-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                    <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                </svg>
                            </span>Product delivered
                        </div>
                    </div>
                </div>

                <!-- Footer-->
                <div class="d-sm-flex flex-wrap justify-content-between align-items-center text-center pt-4">
                    <div class="custom-control custom-checkbox mt-2 mr-3">
                        <input class="custom-control-input" type="checkbox" id="notify-me" checked="">
                        <label class="custom-control-label" for="notify-me">Notify me when order is delivered</label>
                    </div>
                    <a class="btn_1 gradient small" href="#order-details" data-toggle="modal">View Order Details</a>
                </div>
            </div>








    </div>
    <livewire:frontend.social-toast.social-proof/>

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




.steps {
    border: 1px solid #e7e7e7
}

.steps-header {
    padding: .375rem;
    border-bottom: 1px solid #e7e7e7
}

.steps-header .progress {
    height: .65rem
}

.steps-body {
    display: table;
    table-layout: fixed;
    width: 100%
}

.step {
    display: table-cell;
    position: relative;
    padding: 1rem .75rem;
    -webkit-transition: all 0.25s ease-in-out;
    transition: all 0.25s ease-in-out;
    border-right: 1px dashed #dfdfdf;
    color: rgba(0, 0, 0, 0.65);
    font-weight: 600;
    text-align: center;
    text-decoration: none
}

.step:last-child {
    border-right: 0
}

.step-indicator {
    display: block;
    position: absolute;
    top: .75rem;
    left: .75rem;
    width: 1.5rem;
    height: 1.5rem;
    border: 1px solid #e7e7e7;
    border-radius: 50%;
    background-color: #fff;
    font-size: .875rem;
    line-height: 1.375rem
}

.has-indicator {
    padding-right: 1.5rem;
    padding-left: 2.375rem
}

.has-indicator .step-indicator {
    top: 50%;
    margin-top: -.75rem
}

.step-icon {
    display: block;
    width: 1.5rem;
    height: 1.5rem;
    margin: 0 auto;
    margin-bottom: .75rem;
    -webkit-transition: all 0.25s ease-in-out;
    transition: all 0.25s ease-in-out;
    color: #888
}

.step:hover {
    color: rgba(0, 0, 0, 0.9);
    text-decoration: none
}

.step:hover .step-indicator {
    -webkit-transition: all 0.25s ease-in-out;
    transition: all 0.25s ease-in-out;
    border-color: transparent;
    background-color: #f4f4f4
}

.step:hover .step-icon {
    color: rgba(0, 0, 0, 0.9)
}

.step-active,
.step-active:hover {
    color: rgba(0, 0, 0, 0.9);
    pointer-events: none;
    cursor: default
}

.step-active .step-indicator,
.step-active:hover .step-indicator {
    border-color: transparent;
    background-color: #5c77fc;
    color: #fff
}

.step-active .step-icon,
.step-active:hover .step-icon {
    color: #5c77fc
}

.step-completed .step-indicator,
.step-completed:hover .step-indicator {
    border-color: transparent;
    background-color: rgba(51, 203, 129, 0.12);
    color: #33cb81;
    line-height: 1.25rem
}

.step-completed .step-indicator .feather,
.step-completed:hover .step-indicator .feather {
    width: .875rem;
    height: .875rem
}

@media (max-width: 575.98px) {
    .steps-header {
        display: none
    }
    .steps-body,
    .step {
        display: block
    }
    .step {
        border-right: 0;
        border-bottom: 1px dashed #e7e7e7
    }
    .step:last-child {
        border-bottom: 0
    }
    .has-indicator {
        padding: 1rem .75rem
    }
    .has-indicator .step-indicator {
        display: inline-block;
        position: static;
        margin: 0;
        margin-right: 0.75rem
    }
}

.bg-secondary {
    background-color: #f7f7f7 !important;
}



</style>


@endpush
