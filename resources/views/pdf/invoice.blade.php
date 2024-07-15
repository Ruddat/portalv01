<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Rechnung</title>
</head>
<body>
    <h1>Rechnung</h1>
    <p><strong>Geschäft ID:</strong> {{ $shopId }}</p>
    <p><strong>Zeitraum:</strong> {{ $startOfWeek }} - {{ $endOfWeek }}</p>

    <h2>Rechnungsdetails</h2>
    <p><strong>Gesamtbetrag:</strong> {{ $invoiceData['total_amount'] }} EUR</p>
    <p><strong>Bargeld:</strong> {{ $invoiceData['cash_amount'] }} EUR</p>
    <p><strong>EC-Karte:</strong> {{ $invoiceData['ec_card_amount'] }} EUR</p>
    <p><strong>PayPal:</strong> {{ $invoiceData['paypal_amount'] }} EUR</p>
    <p><strong>Andere Beträge:</strong> {{ $invoiceData['other_amounts'] }} EUR</p>
    <p><strong>Gesamtaufträge:</strong> {{ $invoiceData['total_orders'] }}</p>
    <p><strong>Durchschnittlicher Auftragswert:</strong> {{ $invoiceData['average_order_value'] }} EUR</p>

    <h2>Bestellungen</h2>
    <table border="1" cellspacing="0" cellpadding="5">
        <thead>
            <tr>
                <th>Bestellnummer</th>
                <th>Name</th>
                <th>Nachname</th>
                <th>Firma</th>
                <th>Abteilung</th>
                <th>PLZ-ID</th>
                <th>Straße</th>
                <th>Hausnummer</th>
                <th>Stadt</th>
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
                    <td>{{ $order['shipping_city'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
