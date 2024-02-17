<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account-Verifizierung</title>
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
        }

        h1 {
            color: #333333;
        }

        p {
            color: #666666;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
        }

        .button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Account Verification</h1>
        <p>Sehr geehrter {{ $seller['name'] }},</p>
        <p>Vielen Dank für Ihre Registrierung bei unserem Service. Bitte klicken Sie auf den unten stehenden Link, um Ihren Account zu verifizieren:</p>
        <p><a class="button" href="{{ $verificationUrl }}">Account verifizieren</a></p>
        <p>Bitte beachten Sie, dass der Verifizierungslink in 30 Minuten abläuft. Wenn Sie den Link nicht innerhalb dieses Zeitraums verwenden, müssen Sie sich erneut registrieren.</p>
        <p>Vielen Dank,<br>{{ config('app.name') }}</p>
    </div>
</body>

</html>
