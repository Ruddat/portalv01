<div>

    @if(!empty($orders))

    <div class="social-proof-container {{ $showContainer ? 'active' : '' }}" id="social-proof-container">
        <div class="popup-container" id="popupContainer">
            @foreach($orders as $order)
                <div class="popup">
                    <h2>Neue Bestellung</h2>
                    <p>Kunde: {{ $order['name'] }}</p>
                    <p>Produkt: {{ $order['product'] }}</p>
                    <p>Bestellt {{ $order['created_at'] }}</p>
                    <div class="close" onclick="closePopup(this.parentNode)">&times;</div>
                </div>
            @endforeach
            <ul class="customer-who-purchased text-left">
                <li class="product-data active">
                    <a href="#">
                        <img loading="lazy" src="{{ asset('uploads/images/default/avatar_3.jpg') }}" alt="" width="" height="">
                    </a>
                    <div id="order-info"></div>
                    <p>Kunde: {{ $order['name'] }}</p>
                    <a href="javascript:void(0)" title="Close" class="dT_close">
                        <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false" role="presentation" class="icon icon-close" fill="none" viewBox="0 0 18 17">
                            <path d="M.865 15.978a.5.5 0 00.707.707l7.433-7.431 7.579 7.282a.501.501 0 00.846-.37.5.5 0 00-.153-.351L9.712 8.546l7.417-7.416a.5.5 0 10-.707-.708L8.991 7.853 1.413.573a.5.5 0 10-.693.72l7.563 7.268-7.418 7.417z" fill="currentColor"></path>
                        </svg>
                    </a>
                </li>
            </ul>


        </div>



        <ul class="customer-who-purchased text-left">
            <li class="product-data active">
                <a href="#">
                    <img loading="lazy" src="{{ asset('uploads/images/default/avatar_3.jpg') }}" alt="" width="" height="">
                </a>
                <div id="order-info"></div>
                <p>Kunde: {{ $order['name'] }}</p>
                <a href="javascript:void(0)" title="Close" class="dT_close">
                    <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false" role="presentation" class="icon icon-close" fill="none" viewBox="0 0 18 17">
                        <path d="M.865 15.978a.5.5 0 00.707.707l7.433-7.431 7.579 7.282a.501.501 0 00.846-.37.5.5 0 00-.153-.351L9.712 8.546l7.417-7.416a.5.5 0 10-.707-.708L8.991 7.853 1.413.573a.5.5 0 10-.693.72l7.563 7.268-7.418 7.417z" fill="currentColor"></path>
                    </svg>
                </a>
            </li>
        </ul>







    </div>

    @else
    <p>Keine Bestellungen vorhanden.</p>
@endif

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
