<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>

    <link rel="stylesheet" href="{{ asset('pdf.css') }}" type="text/css">

</head>
<body>
    <table class="w-full">
        <tr>
            <td class="w-half">
                <img src="{{ asset('backend/images/logo-full.png') }}" alt="laravel daily" width="200" />
            </td>
            <td class="w-half">
                <h2>Invoice ID: {{ $newOrderNumber }}</h2>
            </td>
        </tr>
    </table>

    <div class="margin-top">
        <table class="w-full">
            <tr>
                <td class="w-half">
                    <div><h4>To:</h4></div>
                    @foreach($customerData as $key => $value)
                    @if (!empty($value))
                      {{ ucfirst($key) }}:<strong> {{ $value }}</strong><br>
                    @endif
                @endforeach
                </td>
                <td class="w-half">
                    <div><h4>Filiale:</h4></div>
                    @foreach($shopData as $key => $value)
                    @if (!empty($value))
                      <strong> {{ $value }}</strong><br>
                    @endif
                @endforeach
            </div>
                </td>
            </tr>
        </table>
    </div>


    <div class="margin-top">
        <table class="w-full">
            <tr>
                <td class="w-half">
                    <div><h2>Bestellung:</h2></div>
                    <div>
                        @foreach($orderData as $key => $value)
                            @if (!empty($value))
                              {{ ucfirst($key) }}:<strong> {{ $value }}</strong><br>
                            @endif
                        @endforeach
                    </div>
                </td>
                <td class="w-half">
                    <div><h4>Scan Me</h4></div>
                    <img src="data:image/png;base64,{{ $qrcode }}">
                    <div>


                    </div>
                </td>
            </tr>
        </table>
    </div>


    <div class="margin-top">
        <table class="payment_info">
            <tr>
                <td style="border: 1px solid #857d7d; font-weight: bold; text-align: center;">

                        @if($payment_method === 'paypal')
                            <h4>Zahlung: Onlinezahlung!!!</h4>
                        @elseif($payment_method === 'cash')
                            <h4> Barzahlung beim Fahrer!!! </h4>
                        @elseif($payment_method === 'ec-card')
                            <h4>Zahlung: EC-Karte Kunde zahlt mit Karte!!!</h4>
                        @else
                            <h4>Zahlungsmethode nicht bekannt</h4>
                        @endif

                </td>
            </tr>
        </table>
    </div>


    <div class="margin-top">
        <table class="products">
            <tr>
                <th>Art.-Nr. </th>
                <th>Artikel + Zutaten</th>
                <th>Summe</th>
            </tr>
        @php
        $totalPrice = 0; // Initialisieren Sie die Gesamtsumme
    @endphp

    @foreach($orderItems['items'] as $item)
        @php
            $totalPrice += $item->Price; // Addieren Sie den Preis jedes Artikels zur Gesamtsumme
        @endphp
        <tr class="items">
            <td>{{ $item->ArticleNo }}</td>
            <td>{{ $item->ArticleName }} ({{ $item->ArticleSize }})</td>
            <td>{{ number_format($item->Price, 2, '.', '') }}</td>
        </tr>
        @if (!empty($item->SubArticleList) && is_array($item->SubArticleList->SubArticle))
            @foreach ($item->SubArticleList->SubArticle as $subArticle)
                <tr class="subitems">
                    <td></td>
                    <td>-- {{ $subArticle->ArticleName }}</td>
                    <td>
                        @if(is_array($subArticle->Price))
                            Gratis
                        @else
                            {{ number_format($subArticle->Price, 2, '.', '') }}
                            @php
                                $totalPrice += $subArticle->Price; // Addieren Sie den Preis jedes Subartikels zur Gesamtsumme
                            @endphp
                        @endif
                    </td>
                </tr>
            @endforeach
        @endif
    @endforeach
        </table>
    </div>


    <div class="total">
        Total: ${{ number_format($totalPrice, 2, '.', '') }} Euro <!-- Zeigen Sie die Gesamtsumme -->
    </div>


    <div class="footer margin-top">
        <div>Thank you</div>
        <div>&copy; {{ $shopData['title'] }}</div>
    </div>
</body>
</html>
