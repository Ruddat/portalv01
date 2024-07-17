<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Rechnung</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }
        .container {
            width: 80%;
            margin: 0 auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .invoice-header {
            margin-bottom: 20px;
        }
        .footer {
            margin-top: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="invoice-header">
            <h1>Rechnung</h1>
            <p>
                Pizza Express Ingo Ruddat E.K. <br>
                z.Hd. Ingo Ruddat <br>
                Heidkrugsweg 31 <br>
                31234 Edemissen <br>
            </p>
            <p>
                Kundennummer: {{ $invoiceData['shop_id'] }} | Steuernummer: 38/137/00390 <br>
                Datum: {{ \Carbon\Carbon::now()->format('d-m-Y') }} | Rechnungsnummer: {{ $invoiceData['invoice_number'] }} <br>
            </p>
        </div>

        <h2>Folgende Leistungen stellen wir in Rechnung</h2>

        <table>
            <thead>
                <tr>
                    <th>PortalName</th>
                    <th>Zeitraum</th>
                    <th>Anzahl Bestellungen</th>
                    <th>Gesamtbetrag</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>PortalName</td>
                    <td>{{ \Carbon\Carbon::parse($invoiceData['start_date'])->format('d-m-Y') }} bis einschließlich {{ \Carbon\Carbon::parse($invoiceData['end_date'])->format('d-m-Y') }}</td>
                    <td>{{ $invoiceData['total_orders'] }}</td>
                    <td>{{ number_format($invoiceData['total_amount'], 2, ',', '.') }} EUR</td>
                </tr>
            </tbody>
        </table>

        <h2>Servicegebühren</h2>
        <table>
            <thead>
                <tr>
                    <th>Beschreibung</th>
                    <th>Anzahl Bestellungen</th>
                    <th>Betrag</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Verwaltungsgebühr (Onlinezahlungen PayPal)</td>
                    <td>{{ $invoiceData['paypal_count'] }} Bestellungen im Wert von {{ number_format($invoiceData['paypal_amount'], 2, ',', '.') }} EUR</td>
                    <td>{{ number_format($invoiceData['paypal_fee'], 2, ',', '.') }} EUR</td>
                </tr>
                <tr>
                    <td>Verwaltungsgebühr (Onlinezahlungen)</td>
                    <td>{{ $invoiceData['other_count'] }} Bestellungen im Wert von {{ number_format($invoiceData['other_amounts'], 2, ',', '.') }} EUR</td>
                    <td>{{ number_format(($invoiceData['other_amounts'] * 0.08), 2, ',', '.') }} EUR</td>
                </tr>
                <tr>
                    <td>PortalName ({{ \Carbon\Carbon::parse($invoiceData['start_date'])->format('d-m-Y') }} bis einschließlich {{ \Carbon\Carbon::parse($invoiceData['end_date'])->format('d-m-Y') }}): {{ $invoiceData['total_orders'] }} Bestellungen im Wert von {{ number_format($invoiceData['total_amount'], 2, ',', '.') }} EUR</td>
                    <td>Servicegebühr: {{ $invoiceData['commission'] }}% von {{ number_format($invoiceData['total_amount'], 2, ',', '.') }}</td>
                    <td>{{ number_format($invoiceData['commission_amount'], 2, ',', '.') }} EUR</td>
                </tr>
            </tbody>
        </table>

        <h2>Rechnungsdetails</h2>
        <table>
            <thead>
                <tr>
                    <th>Zwischensumme</th>
                    <th>MwSt (19%)</th>
                    <th>Gesamtbetrag dieser Rechnung</th>
                    <th>Verrechnet mit eingehenden Onlinezahlungen</th>
                    <th>Offener Rechnungsbetrag</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ number_format($invoiceData['total_amount'], 2, ',', '.') }} EUR</td>
                    <td>{{ number_format(($invoiceData['total_amount'] * 0.19), 2, ',', '.') }} EUR</td>
                    <td>{{ number_format(($invoiceData['total_amount'] * 1.19), 2, ',', '.') }} EUR</td>
                    <td>{{ number_format($invoiceData['paypal_amount'] + $invoiceData['other_amounts'], 2, ',', '.') }} EUR</td>
                    <td>{{ number_format(($invoiceData['total_amount'] * 1.19) - ($invoiceData['paypal_amount'] + $invoiceData['other_amounts']), 2, ',', '.') }} EUR</td>
                </tr>
            </tbody>
        </table>

        {{ number_format($invoiceData['paypal_amount'] + $invoiceData['commission_amount'], 2, ',', '.') }} EUR</td>



        <div class="footer">
            Just Deliver UG <br>
            Rebenring 18 <br>
            38118 Braunschweig <br>
            Deutschland <br>
            Geschäftsführer: Ingo Ruddat <br>
            Tel: +49 <br>
            Commerzbank | IBAN: xxxxxxxxxx <br>
            Amtsgericht Braunschweig | HRB <br>
            USt.-Nr. DE <br>
        </div>
    </div>
</body>
</html>
