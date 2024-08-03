<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@autotranslate('Account Login', app()->getLocale())</title>
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
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            color: #333333;
        }

        h1 {
            color: #d9534f;
        }

        p {
            color: #555555;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #d9534f;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .button:hover {
            background-color: #c9302c;
        }

        .highlight {
            color: #5cb85c;
            font-weight: bold;
        }

        .stampcard {
            margin-top: 20px;
            padding: 15px;
            background-color: #f9f9f9;
            border-left: 5px solid #f0ad4e;
        }

        .coupons {
            margin-top: 20px;
            padding: 15px;
            background-color: #f9f9f9;
            border-left: 5px solid #5bc0de;
        }

        .actions {
            margin-top: 20px;
            padding: 15px;
            background-color: #f9f9f9;
            border-left: 5px solid #d9534f;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>@autotranslate('Willkommen', app()->getLocale()), {{ $buyer['username'] }}!</h1>
        <p>@autotranslate('Vielen Dank für Ihre Registrierung! Ihr Konto wurde erfolgreich erstellt.', app()->getLocale())</p>
        <br /><br />
        <hr>
        <p>Hier sind Ihre Anmeldedaten:</p>
        <p>Benutzername: <strong>{{ $buyer['username'] }}</strong> oder <strong>{{ $buyer['email'] }}</strong></p>
        <p>Passwort: Ihr Passwort</p>
        <hr>
        <p>Bitte klicken Sie auf den untenstehenden Link, um sich in Ihr Konto einzuloggen:</p>
        <p><a class="button" href="{{ $verificationUrl }}">Login</a></p>
        <p>Bei Fragen oder weiteren Anliegen steht Ihnen unser Support-Team unter support@example.com gerne zur Verfügung.</p>
        <p>Vielen Dank!</p>

        <div class="stampcard">
            <p><span class="highlight">Neu:</span> Sammeln Sie StampCards und erhalten Sie tolle Prämien!</p>
        </div>

        <div class="coupons">
            <p><span class="highlight">Aktuell:</span> Nutzen Sie unsere exklusiven Coupons für zusätzliche Rabatte!</p>
        </div>

        <div class="actions">
            <p><span class="highlight">Besonderes Angebot:</span> Entdecken Sie unsere neuesten Aktionen und profitieren Sie davon!</p>
        </div>

        <p>Mit freundlichen Grüßen,<br>{{ config('app.name') }}</p>
    </div>
</body>

</html>
