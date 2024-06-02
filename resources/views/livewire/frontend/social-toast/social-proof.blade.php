<!-- resources/views/livewire/frontend/social-toast/social-proof.blade.php -->

<div id="socialproof-section-suggested-products" class="socialproof-section customer-purchased">
    <ul class="customer-who-purchased text-left">
        <li class="product-data">
            <a href="#">
                <img loading="lazy" src="{{ asset('uploads/images/default/avatar_3.jpg') }}" alt="" width="" height="">
            </a>
            <div id="order-info"></div>
            <a href="javascript:void(0)" title="Close" class="dT_close">
                <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false" role="presentation" class="icon icon-close" fill="none" viewBox="0 0 18 17">
                    <path d="M.865 15.978a.5.5 0 00.707.707l7.433-7.431 7.579 7.282a.501.501 0 00.846-.37.5.5 0 00-.153-.351L9.712 8.546l7.417-7.416a.5.5 0 10-.707-.708L8.991 7.853 1.413.573a.5.5 0 10-.693.72l7.563 7.268-7.418 7.417z" fill="currentColor"></path>
                </svg>
            </a>
        </li>
    </ul>


    @push('scripts')
    <script>
        // Verstecke den Container mit Slide-Out-Animation
        function hideContainerWithAnimation(container) {
            container.classList.remove('active');
            setTimeout(function() {
                container.style.display = 'none';
            }, 1000); // Setze Timeout entsprechend der Dauer der Slide-Out-Animation
        }

        // Zeige den Container mit Slide-In-Animation an
        function showContainerWithAnimation() {
            var container = document.querySelector('.customer-who-purchased .product-data');
            container.style.display = 'block';
            setTimeout(function() {
                container.classList.add('active');
            }, 10); // Verhindert Layout-Doppelberechnung
            setTimeout(function() {
                hideContainerWithAnimation(container);
            }, 10000); // Verstecke nach 10 Sekunden
        }

        // Aktualisiere den Inhalt des Containers mit neuen Bestellungen
        function updateContainerContent(orders) {
            var orderInfo = document.getElementById('order-info');
            orderInfo.innerHTML = '';

            orders.forEach(function(orderArray) {
                orderArray.forEach(function(order) {
                    console.log('Order:', order); // Debugging: Zeige die Bestellung im Konsolenprotokoll an
                    var p = document.createElement('p');
                    var timeAgo = formatTimeAgo(new Date(order.created_at));
                    p.textContent = `${order.name} hat gerade ${order.product} bestellt ${timeAgo}`;
                    orderInfo.appendChild(p);
                });
            });
        }

        // Formatierung der relativen Zeitangaben
        function formatTimeAgo(date) {
            const rtf = new Intl.RelativeTimeFormat('de', { numeric: 'auto' });
            const seconds = Math.floor((new Date() - date) / 1000);
            const intervals = [
                { unit: 'year', value: 60 * 60 * 24 * 365 },
                { unit: 'month', value: 60 * 60 * 24 * 30 },
                { unit: 'week', value: 60 * 60 * 24 * 7 },
                { unit: 'day', value: 60 * 60 * 24 },
                { unit: 'hour', value: 60 * 60 },
                { unit: 'minute', value: 60 },
                { unit: 'second', value: 1 }
            ];

            for (const interval of intervals) {
                const delta = Math.floor(seconds / interval.value);
                if (delta >= 1) {
                    return rtf.format(-delta, interval.unit);
                }
            }
        }

        // Fetch Orders using Livewire
        function fetchOrders() {
            Livewire.dispatch('fetchOrders'); // Emittiere ein Livewire-Event, um die Bestellungen abzurufen
        }

        // Initialisierung
        document.addEventListener('DOMContentLoaded', function() {
            fetchOrders(); // Rufe die Funktion zum Abrufen der Bestellungen beim ersten Laden der Seite auf

            setInterval(function() {
                fetchOrders(); // Rufe die Funktion zum Abrufen der Bestellungen alle 3 Sekunden auf
            }, 3000);

            Livewire.on('ordersFetched', function(orders) {
                console.log('Orders fetched:', orders); // Debugging: Zeige die abgerufenen Bestellungen im Konsolenprotokoll an
                updateContainerContent(orders);
                showContainerWithAnimation();
            });

            document.querySelectorAll('.dT_close').forEach(function(closeButton) {
                closeButton.addEventListener('click', function() {
                    var container = this.closest('.product-data');
                    hideContainerWithAnimation(container);
                });
            });
        });
    </script>
    @endpush


<style type="text/css">
    .customer-who-purchased{
        pointer-events: none;
        margin: 0;
        height: 100px;
        max-width: 500px;
        min-width: 400px;
        position: fixed;
        bottom: 12px;
        width: auto;
        z-index: 3;
        transition: all 0.3s linear;
    }
    .customer-who-purchased.text-left { left: 35px; }
    .customer-who-purchased.text-right { right: 35px; }

    .customer-who-purchased .product-data {
        display: block;
        height: auto;
        margin: 25px 10px;
        opacity: 0;
        padding: 15px 25px 15px 95px;
        position: absolute;
        bottom: -35px;
        left: 0;
        visibility: hidden;
        width: auto;
        border-radius:0;
        transition: all cubic-bezier(.47,1.21,.47,1.21) .3s;
    }
    .customer-who-purchased .product-data:before {
        background-color: #fff;
        content: "";
        display: block;
        height: auto;
        margin: -15px -25px;
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        top: 0;
        width: auto;
        z-index: -1;
        border-radius: 0;
        box-shadow: 0 0 10px rgb(26 26 26 / 15%);
    }

    .customer-who-purchased .product-data.active {
        pointer-events: all;
        opacity: 1;
        bottom: 0;
        visibility: visible;
    }
    .customer-who-purchased .product-data p {
        margin-bottom: 5px;
        font-size: 16px;
        line-height: 25px;
        margin-top: 6px;
    }
    .customer-who-purchased .product-data p span {
        display: inline;
        padding: 3px;
    }

    .customer-who-purchased .product-data span.title,
    .customer-who-purchased .product-data p span.location { font-weight: 600; }

    .customer-who-purchased .product-data p span.purchased { padding-left: 0; }

    .customer-who-purchased .product-data p span.timing {
        font-size: 14px;
        font-weight: 300;
        position: absolute;
        bottom: -10px;
        right: -10px;
        color: var(--gradient-base-accent-2); }

    .customer-who-purchased .product-data > a img {
        position: absolute;
        left: 0;
        top: 50%;
        width: 75px;
        transform: translateY(-50%);
    }

    .customer-who-purchased .product-data .dT_close {
        height: 12px;
        position: absolute;
        right: -2px;
        top: 10px;
        text-align: center;
        width: 12px;
        pointer-events: all;
        border-radius: var(--DTRadius);
        transform: translate(25%, -50%);
    }

    .customer-who-purchased .product-data .dT_close svg {
        height: 0.8em;
        margin: auto;
        position: absolute;
        left: 50%;
        top: 50%;
        width: 1em;
        transform: translate(-50%,-50%);
        transition: inherit;
        color: var(--color-icon);
        transition: all 0.3s linear;
    }
    .customer-who-purchased .product-data .dT_close:hover svg {
        color: var(--gradient-base-accent-2);
    }
    @media (max-width:576px) {
        .customer-who-purchased{
            max-width: 90%;
            min-width: 90%;
            left: 0 !important;
            right: 0!important;
            margin: auto;
        }
    }
    .customer-who-purchased .product-data span.title {
        color: var(--gradient-base-accent-1);
        transition: all 0.3s linear;
    }
    .customer-who-purchased .product-data span.title:hover {
        color: var(--gradient-base-accent-2);
    }
    </style>

</div>












