<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bestellbestätigung</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .header {
            background-color: #FF0000;
            /* Rot für den Kopf */
            color: #FFFFFF;
            padding: 10px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }

        .content {
            background-color: #FFFFFF;
            /* Weißer Hintergrund für den Inhalt */
            padding: 20px;
            border-radius: 0 0 5px 5px;
        }

        .order-details {
            margin-bottom: 20px;
        }

        .order-details p {
            margin: 5px 0;
        }

        .order-items {
            background-color: #F0F0F0;
            /* Leicht grauer Kasten für die Bestellungsliste */
            padding: 10px;
            border-radius: 5px;
        }

        .order-items p {
            margin: 5px 0;
            font-size: auto !important;
        }

        .footer {
            color: #666666;
            font-size: 12px;
            margin-top: 20px;
        }

        /* Responsive Styles */
        @media only screen and (max-width: 568px) {
            .container {
                width: 100% !important;
            }

            .header,
            .content,
            .footer {
                padding: 10px !important;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <img src="pfad/zum/logo.png" alt="Logo vom {{ $order['shop_name'] }}" style="max-width: 100px;">
            <h1>Hallo Herr {{ $customer['name'] }},</h1>
            <p>Wir haben Ihre Bestellung erhalten.</p>
            <p>Ihr Tracking-Link lautet: <a href="{{ $trackingUrl }}"
                    style="display: inline-block; padding: 10px 20px; background-color: #007bff; color: #ffffff; text-decoration: none; border-radius: 5px;">Tracking
                    anzeigen</a></p>

        </div>
        <div class="content">
            <div class="order-details">
                <div style="display: flex; justify-content: space-between;">
                    <div>
                        <h2>Lieferadresse</h2>
                        <p>{{ $customer['name'] }}</p>
                        <p>{{ $customer['address'] }}</p>
                        <p>{{ $customer['zip'] }} {{ $customer['city'] }}</p>
                    </div>
                    <div>
                        <h2>Restaurant</h2>
                        <p>{{ $order['shop_name'] }}</p>
                        <!-- Hier die Adresse des Restaurants einfügen -->
                    </div>
                </div>
                <p><strong>Bestellnummer:</strong> {{ $order['order_number'] }}</p>
                <p><strong>Bestellzeit:</strong> {{ $order['created_at']->format('d.m.Y H:i') }}</p>
            </div>


            <div class="order-items">
                <h2>@autotranslate('Gekaufte Artikel', app()->getLocale())</h2>
                @php
                    $totalMainItemsPrice = 0; // Gesamtpreis der Hauptartikel
                    $totalSubItemsPrice = 0; // Gesamtpreis der Subartikel
                    $totalPrice = 0; // Initialisierung der Gesamtsumme
                @endphp
                @foreach ($orderItems['items'] as $item)
                    <p>
                        - {{ $item->ArticleNo }} <strong>{{ $item->ArticleName }} {{ $item->ArticleSize }} ({{ $item->Count }}x) -
                            @if(isset($item->Price))
                            {{ number_format($item->Price, 2, '.', '') }} {{ $order['currency'] }}
                            @php
                                $totalPrice += $item->Price; // Preis jedes Artikels zur Gesamtsumme addieren
                            @endphp
                        @else
                            @autotranslate('Gratis', app()->getLocale())
                        @endif
                    </strong>
                    </p>

                    @php
                        $totalMainItemsPrice += $item->Price * $item->Count; // Gesamtpreis des aktuellen Hauptartikels
                    @endphp

                    @if (!empty($item->SubArticleList) && isset($item->SubArticleList->SubArticle))
                        @php
                            $subArticles = is_array($item->SubArticleList->SubArticle)
                                           ? $item->SubArticleList->SubArticle
                                           : [$item->SubArticleList->SubArticle];
                        @endphp

                        <ul>
                            @foreach ($subArticles as $subArticle)
                                <li>{{ $subArticle->ArticleName }} -

                                    @if(isset($subArticle->Price) && is_numeric($subArticle->Price))
                                    {{ number_format($subArticle->Price, 2, '.', '') }} {{ $order['currency'] }}
                                    @php
                                        $totalPrice += $subArticle->Price; // Preis jedes Subartikels zur Gesamtsumme addieren
                                    @endphp
                                @else
                                    @autotranslate('Gratis', app()->getLocale())
                                @endif
                                </li>
                            @endforeach
                        </ul>
                    @endif
                @endforeach
            </div>


            <p><strong>@autotranslate('Gesamtpreis:', app()->getLocale())</strong> {{ number_format($totalMainItemsPrice, 2, ',', '.') }} {{ $order['currency'] }}</p>
            <p><strong>@autotranslate('Zahlungsart:', app()->getLocale())</strong> {{ $order['payment_type'] }}</p>
            <p>@autotranslate('Vielen Dank für Ihre Bestellung bei', app()->getLocale()) {{ $order['shop_name'] }}.</p>
        </div>
        <div class="footer">
            @autotranslate('Bei Fragen oder Anmerkungen kontaktieren Sie uns bitte unter', app()->getLocale()) support@example.com.
        </div>
    </div>
</body>

</html>
