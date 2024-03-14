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
                <h2>Invoice ID: 834847473</h2>
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
                    <div><h4>Bestellung:</h4></div>
                    <div>
                        @foreach($customerData as $key => $value)
                            @if (!empty($value))
                              {{ ucfirst($key) }}:<strong> {{ $value }}</strong><br>
                            @endif
                        @endforeach
                    </div>
                </td>
                <td class="w-half">
                    <div><h4>From:</h4></div>
                    <div>Laravel Daily</div>
                    <div>London</div>
                </td>
            </tr>
        </table>
    </div>


    <div class="margin-top">
        <table class="payment_info">
            <tr>
                <td style="border: 1px solid #000; padding: 10px; font-weight: bold; text-align: center;">
                    <div>
                        @if($payment_method === 'paypal')
                            <p>Zahlung: Onlinezahlung!!!</p>
                        @elseif($payment_method === 'cash')
                            <p>Zahlung: Barzahlung beim Fahrer!!!</p>
                        @elseif($payment_method === 'ec-card')
                            <p>Zahlung: EC-Karte Kunde zahlt mit Karte!!!</p>
                        @else
                            <p>Zahlungsmethode nicht bekannt</p>
                        @endif
                    </div>
                </td>
            </tr>
        </table>
    </div>


    <div class="margin-top">
        <table class="products">
            <tr>
                <th>Qty</th>
                <th>Description</th>
                <th>Price</th>
            </tr>
            <tr class="items">
                @foreach($data as $item)
                    <td>
                        {{ $item['quantity'] }}
                    </td>
                    <td>
                        {{ $item['description'] }}
                    </td>
                    <td>
                        {{ $item['price'] }}
                    </td>
                @endforeach
            </tr>
        </table>
    </div>

    <div class="total">
        Total: $129.00 USD
    </div>

    <div class="footer margin-top">
        <div>Thank you</div>
        <div>&copy; Laravel Daily</div>
    </div>
</body>
</html>
