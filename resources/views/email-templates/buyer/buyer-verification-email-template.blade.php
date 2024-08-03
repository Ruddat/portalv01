<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@autotranslate('Account Verification', app()->getLocale())</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f8f8;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-top: 5px solid #ff6f61;
        }

        h1 {
            color: #ff6f61;
            text-align: center;
        }

        p {
            color: #555555;
            margin-bottom: 15px;
        }

        .button {
            display: inline-block;
            padding: 12px 24px;
            background-color: #ff6f61;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
            text-align: center;
            font-weight: bold;
        }

        .button:hover {
            background-color: #e65b55;
        }

        .greeting {
            color: #333333;
            margin-bottom: 20px;
            text-align: center;
        }

        .signature {
            margin-top: 30px;
            text-align: center;
            color: #999999;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>>@autotranslate('Account Verification', app()->getLocale())</h1>
        <p class="greeting">Hello {{ $buyer['name'] }},</p>
        <p>Thank you for registering with our service. To complete your registration, please click the link below to verify your account:</p>
        <p style="text-align: center;"><a class="button" href="{{ $verificationUrl }}">Verify Account</a></p>
        <p>@autotranslate('Please note that the verification link will expire in 30 minutes. If you do not use the link within this timeframe, you will need to register again.', app()->getLocale())</p>
        <p class="signature">Thank you,<br>{{ config('app.name') }}</p>
    </div>
</body>

</html>
