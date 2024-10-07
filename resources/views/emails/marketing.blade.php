<!DOCTYPE html>
<html>
<head>
    <title>Wir vermissen Sie! Spezielles Rabattangebot</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            color: #333;
            line-height: 1.6;
            padding: 20px;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .email-header {
            background-color: #4CAF50;
            color: #ffffff;
            padding: 20px;
            text-align: center;
        }
        .email-body {
            padding: 20px;
        }
        .email-footer {
            background-color: #f1f1f1;
            padding: 10px;
            text-align: center;
            font-size: 12px;
            color: #666;
        }
        .button {
            display: inline-block;
            background-color: #4CAF50;
            color: #ffffff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }
        .button:hover {
            background-color: #45a049;
        }
        .voucher-code {
            font-size: 18px;
            font-weight: bold;
            color: #4CAF50;
        }
    </style>
    <meta charset="UTF-8">
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h1>Wir vermissen Sie bei {{ $shopTitle }}!</h1>
        </div>
        <div class="email-body">
            <p>Liebe Kundin, lieber Kunde,</p>
            <p>wir haben bemerkt, dass Sie schon eine Weile nicht mehr bei uns bestellt haben. Als kleines Dankeschön möchten wir Ihnen einen speziellen Rabatt von <strong>{{ $discountPercentage }}%</strong> auf Ihre nächste Bestellung anbieten.</p>
            <p>Ihr Gutscheincode: <span class="voucher-code">{{ $voucherCode }}</span></p>
            <p>Bitte beachten Sie, dass der Gutscheincode nur bis zum <strong>{{ $validUntil->format('d.m.Y') }}</strong> gültig ist.</p>
            <p>Nutzen Sie den Gutschein jetzt und gönnen Sie sich Ihre Lieblingsspeisen:</p>
            <p><a href="{{ $shopUrl }}" class="button">Jetzt Rabatt nutzen und bestellen!</a></p>
            <p>Vielen Dank für Ihre Treue!</p>
        </div>
        <div class="email-footer">
            &copy; {{ date('Y') }} {{ $shopTitle }}. Alle Rechte vorbehalten.
        </div>
    </div>
</body>
</html>
