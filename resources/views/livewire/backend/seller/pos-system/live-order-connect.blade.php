<div wire:poll.30sec='checkForNewOrders'>
    <h2>Bestellungen des heutigen Tages</h2>



    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <nav class="order-tab">
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link @if($activeTab === 'ordersIn') active @endif" wire:click="setActiveTab('ordersIn')" id="nav-order-tab" data-bs-toggle="tab" data-bs-target="#nav-order" type="button" role="tab" aria-controls="nav-order" aria-selected="{{ $activeTab === 'ordersIn' ? 'true' : 'false' }}">Order in</button>
                        <button class="nav-link @if($activeTab === 'ordersPrepared') active @endif" wire:click="setActiveTab('ordersPrepared')" id="nav-prepared-tab" data-bs-toggle="tab" data-bs-target="#nav-prepared" type="button" role="tab" aria-controls="nav-prepared" aria-selected="{{ $activeTab === 'ordersPrepared' ? 'true' : 'false' }}">Prepared</button>
                        <button class="nav-link @if($activeTab === 'ordersDelivered') active @endif" wire:click="setActiveTab('ordersDelivered')" id="nav-delivered-tab" data-bs-toggle="tab" data-bs-target="#nav-delivered" type="button" role="tab" aria-controls="nav-delivered" aria-selected="{{ $activeTab === 'ordersDelivered' ? 'true' : 'false' }}">Delivered</button>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <!-- Orders in Tab -->
                    <div class="tab-pane fade @if($activeTab === 'ordersIn') show active @endif" id="nav-order" role="tabpanel" aria-labelledby="nav-order-tab">
                        @foreach($ordersIn as $order)
                            <div class="orderin-bx d-flex align-items-center justify-content-between">
                                <div>
                                    <h4>Order #{{ $order->id }}</h4>
                                    <span>{{ $order->created_at->format('F j, Y, H:i') }}</span>
                                </div>
                                <div class="d-flex align-items-center">
                                    <h4 class="text-primary mb-0">${{ number_format($order->price_total, 2) }}</h4>
                                    <button wire:click="moveToPrepared({{ $order->id }})" class="icon-bx">
                                        <i class="fa-solid fa-angle-right"></i>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Prepared Tab -->
                    <div class="tab-pane fade @if($activeTab === 'ordersPrepared') show active @endif" id="nav-prepared" role="tabpanel" aria-labelledby="nav-prepared-tab">
                        @foreach($ordersPrepared as $order)
                            <div class="orderin-bx d-flex align-items-center justify-content-between">
                                <div>
                                    <h4>Prepared Order #{{ $order->id }}</h4>
                                    <span>{{ $order->created_at->format('F j, Y, H:i') }}</span>
                                </div>
                                <div class="d-flex align-items-center">
                                    <h4 class="text-primary mb-0">${{ number_format($order->price_total, 2) }}</h4>
                                    <button wire:click="moveToDelivered({{ $order->id }})" class="icon-bx">
                                        <i class="fa-solid fa-angle-right"></i>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Delivered Tab -->
                    <div class="tab-pane fade @if($activeTab === 'ordersDelivered') show active @endif" id="nav-delivered" role="tabpanel" aria-labelledby="nav-delivered-tab">
                        @foreach($ordersDelivered as $order)
                            <div class="orderin-bx d-flex align-items-center justify-content-between">
                                <div>
                                    <h4>Delivered Order #{{ $order->id }}</h4>
                                    <span>{{ $order->created_at->format('F j, Y, H:i') }}</span>
                                </div>
                                <div class="d-flex align-items-center">
                                    <h4 class="text-primary mb-0">${{ number_format($order->price_total, 2) }}</h4>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>





    @if($newOrder)
    @php
        $orderData = json_decode($newOrder->order_json_data);
    @endphp

<!-- Unscharfer Hintergrund -->
<div class="blur-background"></div>

<!-- Overlay-Container -->
<div class="overlay-container {{ $newOrder ? 'active' : '' }}">
    <div class="order-overlay">
        <div class="order-header">
            <h4 class="font-w500">Order #{{ $orderData->OrderList->Order->OrderID }}</h4>
            <span>{{ \Carbon\Carbon::parse($orderData->OrderList->CreateDateTime)->format('d M, Y, H:i') }}</span>
        </div>
        <div class="order-body">
            <div class="mb-4">
                <h2 class="font-w500">{{ $orderData->OrderList->Order->Customer->DeliveryAddress->FirstName }} {{ $orderData->OrderList->Order->Customer->DeliveryAddress->LastName }}</h2>
                <p class="address-line">{{ $orderData->OrderList->Order->Customer->DeliveryAddress->Street }} {{ $orderData->OrderList->Order->Customer->DeliveryAddress->HouseNo }},</p>
                <p class="address-line"> {{ $orderData->OrderList->Order->Customer->DeliveryAddress->Zip }} {{ $orderData->OrderList->Order->Customer->DeliveryAddress->City }}</p>
                <p>Tel.: {{ $orderData->OrderList->Order->Customer->DeliveryAddress->PhoneNo }}</p>
                <span>User since {{ \Carbon\Carbon::parse($orderData->OrderList->Order->ServerData->CreateDateTime)->year }}</span>
            </div>

            <div class="order-details">
                <h4>Bestelldetails</h4>
                @foreach($orderData->OrderList->Order->ArticleList->Article as $article)
                    <div class="d-flex justify-content-between border-bottom flex-wrap mb-4">
                        <div>
                            <h4 class="font-w500 text-nowrap mb-0">x{{ $article->Count }} - {{ $article->ArticleName }} ({{ $article->ArticleSize }})</h4>
                            @if(!empty($article->SubArticleList))
                                @if(isset($article->SubArticleList->SubArticle))
                                    @if(is_array($article->SubArticleList->SubArticle))
                                        @foreach($article->SubArticleList->SubArticle as $subArticle)
                                            <p class="mb-0">+ {{ $subArticle->ArticleName }} (x{{ $subArticle->Count }}) - €{{ $subArticle->Price }}</p>
                                        @endforeach
                                    @else
                                        <p class="mb-0">+ {{ $article->SubArticleList->SubArticle->ArticleName }} (x{{ $article->SubArticleList->SubArticle->Count }}) - €{{ $article->SubArticleList->SubArticle->Price }}</p>
                                    @endif
                                @endif
                            @endif
                        </div>
                        <div>
                            <h4 class="text-primary mb-0">€{{ $article->Price }}</h4>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="order-summary d-flex justify-content-between align-items-center">
                <h4 class="font-w500 mb-0">Gesamtbetrag</h4>
                <h4 class="cate-title text-primary mb-0">€55.4</h4>
            </div>
        </div>

        <div class="order-footer">
            <p>Lieferzeit wählen:</p>
            <div class="delivery-options">
                <button class="btn btn-outline-danger" wire:click="setDeliveryTime(30)">30min</button>
                <button class="btn btn-outline-danger" wire:click="setDeliveryTime(45)">45min</button>
                <button class="btn btn-outline-danger" wire:click="setDeliveryTime(60)">60min</button>
                <button class="btn btn-outline-danger" wire:click="setDeliveryTime(75)">75min</button>
                <button class="btn btn-outline-danger" wire:click="setDeliveryTime(90)">90min</button>
            </div>
        </div>

        <div class="order-controls">
            <button class="btn btn-outline-success" wire:click="confirmOrder">Bestellung Bestätigen</button>
            <button class="btn btn-outline-secondary" wire:click="skipOrder">Überspringen</button>
            <button class="btn btn-outline-primary" wire:click="printOrder">Drucken</button>

        </div>
    </div>
</div>
@endif




<style>
/* Hintergrund und Overlay */
.overlay-container {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 1000;
    visibility: hidden; /* Overlay standardmäßig unsichtbar */
    opacity: 0;
    transition: visibility 0s, opacity 0.3s ease-in-out;
}

/* Wenn das Overlay aktiv ist */
.overlay-container.active {
    visibility: visible;
    opacity: 1;
}

/* Unscharfer Hintergrund */
.blur-background {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5); /* Halbtransparenter dunkler Hintergrund */
    backdrop-filter: blur(8px); /* Unschärfe-Effekt */
    z-index: 999;
    pointer-events: none;
}

/* Overlay-Stil */
.order-overlay {
    background-color: #fff;
    width: 90%; /* Kann angepasst werden */
    max-width: 600px; /* Maximale Breite des Overlays */
    max-height: 80%; /* Maximale Höhe des Overlays */
    overflow-y: auto; /* Scrollbar hinzufügen, wenn Inhalt größer als max-height */
    border-radius: 8px;
    padding: 20px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    position: relative; /* Stellen Sie sicher, dass das Overlay im richtigen Stack-Context ist */
}

/* Abstände */
.order-header, .order-body, .order-footer, .order-controls {
    margin-bottom: 20px;
}

.delivery-options button {
    margin-right: 10px;
    margin-bottom: 10px;
}

.order-controls button {
    margin-right: 10px;
}

.address-line {
    margin-bottom: 5px; /* Etwas mehr Abstand für bessere Lesbarkeit */
    font-weight: 600;
}

/* Klasse zum Verhindern von Hintergrundscrollen */
body.overlay-active {
    overflow: hidden;
}
</style>

</div>


<script>
    // Füge oder entferne die Klasse overlay-active basierend auf der Livewire-Bedingung
    document.body.classList.toggle('overlay-active', @json($newOrder) !== null);
</script>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            document.addEventListener('click', () => {
                Livewire.on('playAudio', () => {
                    new Audio("{{ url('/extra-assets/sounds/llv-132676.mp3') }}").play();
                });
            }, { once: true });
        });

        document.addEventListener("DOMContentLoaded", () => {
        let wakeLock = null;

        const requestWakeLock = async () => {
            try {
                wakeLock = await navigator.wakeLock.request('screen');
                console.log('Screen Wake Lock is active');
            } catch (err) {
                console.error(`${err.name}, ${err.message}`);
            }
        };

        requestWakeLock();

        // Optional: Refresh the wake lock periodically
        setInterval(() => {
            if (wakeLock !== null) {
                requestWakeLock();
            }
        }, 60000); // Refresh every minute
    });

    </script>


</div>
