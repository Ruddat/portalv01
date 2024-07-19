<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rechnung</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }

        .container {
            width: 100%;
            margin: 0 auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #ccc;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .invoice-header {
            margin-bottom: 20px;
        }

        .right-align {
            width: 100%;
            text-align: right;
        }

        .right-align span {
            float: left;
        }

        .right-align .amount {
            float: right;
        }

        .footer-table {
            width: 100%;
            background-color: #f8f9fa;
            font-size: 10px;
            border: none;
        }

        .footer-table td {
            padding: 10px;
            vertical-align: top;
            border: none;
        }

        .footer-table strong {
            font-weight: 700;
        }

        .p {
            margin-top: 0;
            font-size: 10px;
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
            <p style="font-size: 11px">
                Kundennummer: {{ $invoiceData['shop_id'] }} | Steuernummer: 38/137/00390 <br>
                Datum: {{ \Carbon\Carbon::now()->format('d-m-Y') }} | Rechnungsnummer:
                {{ $invoiceData['invoice_number'] }} <br>
            </p>
        </div>

        <h2>Folgende Leistungen stellen wir in Rechnung</h2>
        <hr />

        <p style="font-size: 12px">{{ get_settings()->company_name }} {{ \Carbon\Carbon::parse($invoiceData['start_date'])->format('d-m-Y') }}
            bis einschließlich {{ \Carbon\Carbon::parse($invoiceData['end_date'])->format('d-m-Y') }}:
            {{ $invoiceData['total_orders'] }} Bestellungen im Wert von
            € {{ number_format($invoiceData['total_amount'], 2, ',', '.') }}</p>

        <div class="right-align">
            <span>Servicegebühr: {{ $invoiceData['commission'] }}% von
                € {{ number_format($invoiceData['total_amount'], 2, ',', '.') }}
            </span>
            <span class="amount">€ {{ number_format($invoiceData['commission_amount'], 2, ',', '.') }}</span>
        </div>
        <br />
        <p>Verwaltungsgebühr (Onlinezahlungen PayPal) wird mit
            € {{ number_format($invoiceData['paypal_amount'], 2, ',', '.') }} verrechnet</p>
        </p>




        <div class="right-align">
            <span>{{ $invoiceData['paypal_count'] }} Bestellungen im Wert von
                {{ number_format($invoiceData['paypal_amount'], 2, ',', '.') }} EUR
            </span>
            <span class="amount">{{ number_format($invoiceData['paypal_fee'], 2, ',', '.') }} EUR</span>
        </div>



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
                    <td>{{ $invoiceData['paypal_count'] }} Bestellungen im Wert von
                        {{ number_format($invoiceData['paypal_amount'], 2, ',', '.') }} EUR</td>
                    <td>{{ number_format($invoiceData['paypal_fee'], 2, ',', '.') }} EUR</td>
                </tr>
                <tr>
                    <td>Verwaltungsgebühr (Onlinezahlungen)</td>
                    <td>{{ $invoiceData['other_count'] }} Bestellungen im Wert von
                        {{ number_format($invoiceData['other_amounts'], 2, ',', '.') }} EUR</td>
                    <td>{{ number_format($invoiceData['other_amounts'] * 0.08, 2, ',', '.') }} EUR</td>
                </tr>
                <tr>
                    <td>PortalName ({{ \Carbon\Carbon::parse($invoiceData['start_date'])->format('d-m-Y') }} bis
                        einschließlich {{ \Carbon\Carbon::parse($invoiceData['end_date'])->format('d-m-Y') }}):
                        {{ $invoiceData['total_orders'] }} Bestellungen im Wert von
                        {{ number_format($invoiceData['total_amount'], 2, ',', '.') }} EUR</td>
                    <td>Servicegebühr: {{ $invoiceData['commission'] }}% von
                        {{ number_format($invoiceData['total_amount'], 2, ',', '.') }}</td>
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
                    <td>Storno {{ number_format($invoiceData['refund_amount'], 2, ',', '.') }} EUR</td>
                    <td>{{ number_format($invoiceData['total_amount'], 2, ',', '.') }} EUR</td>
                    <td>{{ number_format($invoiceData['total_amount'] * 0.19, 2, ',', '.') }} EUR</td>
                    <td>{{ number_format($invoiceData['total_amount'] * 1.19, 2, ',', '.') }} EUR</td>
                    <td>{{ number_format($invoiceData['paypal_amount'] + $invoiceData['other_amounts'], 2, ',', '.') }}
                        EUR</td>
                    <td>{{ number_format($invoiceData['total_amount'] * 1.19 - ($invoiceData['paypal_amount'] + $invoiceData['other_amounts']), 2, ',', '.') }}
                        EUR</td>
                </tr>
            </tbody>
        </table>

        {{ number_format($invoiceData['paypal_amount'] + $invoiceData['commission_amount'], 2, ',', '.') }} EUR

        <table class="footer-table">
            <tr>
                <td>
                    <strong>{{ get_settings()->company_name }}</strong><br>
                    {{ get_settings()->address }}<br>
                    {{ get_settings()->zip_code }} {{ get_settings()->city }}<br>
                    {{ get_settings()->country }}
                </td>
                <td>
                    {{ get_settings()->ceo_name }}<br>
                    Tel: {{ get_settings()->phone }}<br>
                    {{ get_settings()->bank_name }}<br>
                    IBAN: {{ get_settings()->iban }}
                </td>
                <td>
                    {{ get_settings()->register_court }}<br>
                    HRB {{ get_settings()->register_number }}<br>
                    USt.-Nr. {{ get_settings()->vat_number }}
                </td>
            </tr>
        </table>
    </div>
</body>

</html>
