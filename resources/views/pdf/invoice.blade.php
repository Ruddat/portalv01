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

        .header-table {
            width: 100%;
            margin-bottom: 30px;
            border: none;
        }

        .header-table td {
            vertical-align: top;
            border: none;
        }

        #logo {
            text-align: right;
        }

        #logo img {
            width: 90px;
        }

        h1 {
            border-top: 1px solid #5D6975;
            border-bottom: 1px solid #5D6975;
            color: #5D6975;
            font-size: 2.4em;
            line-height: 1.4em;
            font-weight: normal;
            text-align: center;
            margin: 0 0 20px 0;
            background: url("{{ asset('images/invoice/dimension.png') }}");
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
        <table class="header-table">
            <tr>
                <td>
                    <p>
                        {{ $shop->title }}<br>
                        z.Hd. {{ $shop->owner }} <br>
                        {{ $shop->street }} <br>
                        {{ $shop->zip }} {{ $shop->city }} <br>
                    </p>
                    <p style="font-size: 11px">
                        Kundennummer: {{ $shop->shop_nr }} | Steuernummer: 38/137/00390 <br>
                        Datum: {{ \Carbon\Carbon::now()->format('d-m-Y') }} | Rechnungsnummer:
                        {{ $invoiceData['invoice_number'] }} <br>
                    </p>
                </td>

                <td id="logo">
                    @if(!empty(get_settings()->site_logo))
                    <img src="/images/site/{{ get_settings()->site_logo }}" width="162" height="35" alt="{{ get_settings()->site_name }}">
                    @else
                    <img src="{{ asset('frontend/img/logo_sticky.svg') }}" alt="Default Logo">
                    @endif
                </td>
            </tr>
        </table>

        <h1>Rechnung: {{ $invoiceData['invoice_number'] }}</h1>

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
                    <td>{{ number_format($invoiceData['paypal_amount'] + $invoiceData['other_amounts'], 2, ',', '.') }} EUR</td>
                    <td>{{ number_format($invoiceData['total_amount'] * 1.19 - ($invoiceData['paypal_amount'] + $invoiceData['other_amounts']), 2, ',', '.') }} EUR</td>
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
