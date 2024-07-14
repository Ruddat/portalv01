<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rechnung</title>

    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        table, th, td { border: 1px solid black; }
        th, td { padding: 8px; text-align: left; }
        .order-details { margin-bottom: 20px; font-family: DejaVu Sans, sans-serif; font-size: 8px; line-height: 1.2; }

        .w-full {
    width: 100%;
}
.w-half {
    width: 50%;
}

table {
    width: 100%;
    border-spacing: 0;
}



    </style>
</head>
<body>

    <table class="w-full">
        <tr>
            <td class="w-half">
                <img src="{{ asset('laraveldaily.png') }}" alt="laravel daily" width="200" />
            </td>
            <td class="w-half">
                <h2>Invoice ID: 834847473</h2>
            </td>
        </tr>
    </table>



    <header class="clearfix">
        <div id="logo">
          <img src="logo.png">
        </div>
        <h1>INVOICE 3-2-1</h1>
        <div id="company" class="clearfix">
          <div>Company Name</div>
          <div>455 Foggy Heights,<br /> AZ 85004, US</div>
          <div>(602) 519-0450</div>
          <div><a href="mailto:company@example.com">company@example.com</a></div>
        </div>
        <div id="project">
          <div><span>PROJECT</span> Website development</div>
          <div><span>CLIENT</span> John Doe</div>
          <div><span>ADDRESS</span> 796 Silver Harbour, TX 79273, US</div>
          <div><span>EMAIL</span> <a href="mailto:john@example.com">john@example.com</a></div>
          <div><span>DATE</span> August 17, 2015</div>
          <div><span>DUE DATE</span> September 17, 2015</div>
        </div>
        <table class="w-full">
            <tr>
                <td class="w-half">
                    <h3>Summary</h3>
                    <p>Balance Due: 2,100.00 EUR</p>
                </td>
                <td class="w-half">
                    <h3>Company Information</h3>
                    <p>Company Name: Company Name</p>
                    <p>Address: 455 Foggy Heights, AZ 85004, US</p>
                    <p>Phone: (602) 519-0450</p>
                    <p>Email: <a href="mailto:andrew@gmail.com">andrew@gmail.com</a></p>
                </td>
            </tr>
        </table>
    </header>


<main>
    <table class="w-full">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Name</th>
                <th>Surname</th>
                <th>Company</th>
                <th>Department</th>
                <th>Zip ID</th>
                <th>Street</th>
                <th>House No</th>
                <th>Zip</th>
                <th>City</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
            <tr>
                <td>{{ $order['order_nr'] }}</td>
                <td>{{ $order['name'] }}</td>
                <td>{{ $order['surname'] }}</td>
                <td>{{ $order['company'] }}</td>
                <td>{{ $order['department'] }}</td>
                <td>{{ $order['shipping_zip_id'] }}</td>
                <td>{{ $order['shipping_street'] }}</td>
                <td>{{ $order['shipping_house_no'] }}</td>
                <td>{{ $order['shipping_zip'] }}</td>
                <td>{{ $order['shipping_city'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</main>



<footer>
    Invoice was created on a computer and is valid without the signature and seal.
</footer>

    <h1>Rechnung</h1>
    <p><strong>Geschäft ID:</strong> {{ $shopId }}</p>
    <p><strong>Zeitraum:</strong> {{ $startOfWeek }} - {{ $endOfWeek }}</p>

    <h2>Rechnungsdetails</h2>
    <p><strong>Gesamtbetrag:</strong> {{ $invoiceData['total_amount'] }} EUR</p>
    <p><strong>Bargeld:</strong> {{ $invoiceData['cash_amount'] }} EUR</p>
    <p><strong>EC-Karte:</strong> {{ $invoiceData['ec_card_amount'] }} EUR</p>
    <p><strong>PayPal:</strong> {{ $invoiceData['paypal_amount'] }} EUR</p>
    <p><strong>Andere Beträge:</strong> {{ $invoiceData['other_amounts'] }} EUR</p>
    <p><strong>Anzahl Bestellungen:</strong> {{ $invoiceData['total_orders'] }}</p>
    <p><strong>Durchschnittlicher Bestellwert:</strong> {{ $invoiceData['average_order_value'] }} EUR</p>

    <h2>Bestelldetails</h2>
    <div class="order-details">
        @foreach ($orders as $order)
        {{ $order['order_nr'] }},
        {{ mb_substr($order['name'], 0, 3) . 'xx' }},
        {{ mb_substr($order['surname'], 0, 3) . 'xx' }},
        {{ $order['company'] ? mb_substr($order['company'], 0, 3) . 'xx' : '' }},
        {{ $order['department'] }},
        {{ $order['shipping_zip_id'] }},
        {{ $order['shipping_street'] }},
        {{ $order['shipping_house_no'] }},
        {{ $order['shipping_zip'] }},
        {{ $order['shipping_city'] }} </br>
        @endforeach
    </div>

</body>
</html>
