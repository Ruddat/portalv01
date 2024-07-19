<div>
    @if ($showContainer && count($orders) > 0)
    <ul id="customerWhoPurchased" class="customer-who-purchased">
        @foreach ($orders as $index => $order)
        <li class="product-data fade-out" id="order-{{ $index }}">
            <a href="#">
                <img loading="lazy" src="{{ asset('uploads/images/default/avatar_3.jpg') }}" alt="" width="50" height="50">
            </a>
            <div id="order-info"></div>
            <p>Kunde: {{ $order['name'] }}</p>
            <p>Produkt: {{ $order['product'] }}</p>
            <p>Bestellt {{ $order['created_at'] }}</p>
            <button class="dT_close" wire:click="closeOrder({{ $index }})">
                <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false" role="presentation" class="icon icon-close" fill="none" viewBox="0 0 18 17">
                    <path d="M.865 15.978a.5.5 0 00.707.707l7.433-7.431 7.579 7.282a.501.501 0 00.846-.37.5.5 0 00-.153-.351L9.712 8.546l7.417-7.416a.5.5 0 10-.707-.708L8.991 7.853 1.413.573a.5.5 0 10-.693.72l7.563 7.268-7.418 7.417z" fill="currentColor"></path>
                </svg>
            </button>
        </li>
        @endforeach
    </ul>
    @endif


    <style>
        .customer-who-purchased {
            pointer-events: none;
            position: fixed;
            bottom: 20px; /* Anpassen der Position nach Bedarf */
            right: 20px; /* Positionierung am rechten Rand */
            list-style-type: none;
            padding: 0;
            margin: 0;
            z-index: 1000; /* Anpassen der Z-Index-Werte nach Bedarf */
        }

        .product-data {
            background-color: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 10px;
            opacity: 0;
            overflow: hidden;
            padding: 15px;
            transition: opacity 0.3s ease-in-out;
            max-width: 300px; /* Maximale Breite des Elements */
            width: 100%; /* Vollständige Breite des Containers */
            position: relative; /* Position relativ für absolute Positionierung des Schließen-Buttons */
        }

        .product-data.active {
            opacity: 1;
        }

        .product-data p {
            margin: 5px 0;
        }

        .product-data img {
            float: left;
            margin-right: 10px;
            width: 50px; /* Anpassen der Größe des Bildes nach Bedarf */
            height: 50px; /* Anpassen der Größe des Bildes nach Bedarf */
            border-radius: 50%;
        }

        .dT_close {
            background: none;
            border: none;
            cursor: pointer;
            outline: none;
            padding: 0;
            position: absolute;
            top: 5px; /* Anpassen der Position des Schließen-Buttons nach Bedarf */
            right: 5px; /* Anpassen der Position des Schließen-Buttons nach Bedarf */
        }

        .dT_close svg {
            width: 16px; /* Anpassen der Größe des Schließen-Symbols nach Bedarf */
            height: 16px; /* Anpassen der Größe des Schließen-Symbols nach Bedarf */
        }
    </style>

</div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const orders = document.querySelectorAll('.product-data');
            orders.forEach((order, index) => {
                setTimeout(() => {
                    order.classList.add('active');
                }, index * 1000);

                setTimeout(() => {
                    order.classList.remove('active');
                }, (index + 1) * 3000);
            });
        });

        function closeOrder(index) {
            const orderElement = document.getElementById(`order-${index}`);
            if (orderElement) {
                orderElement.classList.remove('active');
                setTimeout(() => {
                    orderElement.remove();
                }, 300); // Anpassen der Wartezeit zur Synchronisierung mit der CSS-Transition
            }
        }

        document.addEventListener('livewire:init', () => {
       Livewire.on('showNewOrder', (event) => {
        addNewOrder(order);
    });
    });

        function addNewOrder(order) {
            const ordersContainer = document.getElementById('customerWhoPurchased');
            const newIndex = ordersContainer.children.length;

            const newOrderHtml = `
                <li class="product-data fade-out" id="order-${newIndex}">
                    <a href="#">
                        <img loading="lazy" src="${order.img}" alt="" width="50" height="50">
                    </a>
                    <div id="order-info"></div>
                    <p>Kunde: ${order.name}</p>
                    <p>Produkt: ${order.product}</p>
                    <p>Bestellt ${order.created_at}</p>
                    <button class="dT_close" onclick="closeOrder(${newIndex})">
                        <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false" role="presentation" class="icon icon-close" fill="none" viewBox="0 0 18 17">
                            <path d="M.865 15.978a.5.5 0 00.707.707l7.433-7.431 7.579 7.282a.501.501 0 00.846-.37.5.5 0 00-.153-.351L9.712 8.546l7.417-7.416a.5.5 0 10-.707-.708L8.991 7.853 1.413.573a.5.5 0 10-.693.72l7.563 7.268-7.418 7.417z" fill="currentColor"></path>
                        </svg>
                    </button>
                </li>
            `;

            ordersContainer.insertAdjacentHTML('beforeend', newOrderHtml);
            const newOrderElement = ordersContainer.lastElementChild;

            setTimeout(() => {
                newOrderElement.classList.remove('fade-out');
                newOrderElement.classList.add('active');
            }, 100);

            setTimeout(() => {
                newOrderElement.classList.remove('active');
                setTimeout(() => {
                    newOrderElement.remove();
                }, 300); // Anpassen der Wartezeit zur Synchronisierung mit der CSS-Transition
            }, 3000);
        }
    </script>

