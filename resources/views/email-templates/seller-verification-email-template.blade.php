<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Verification</title>
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
            margin-bottom: 15px;
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
        <p>Dear {{ $seller['name'] }},</p>
        <p>Thank you for registering with our service. Please click the link below to verify your account:</p>
        <p><a class="button" href="{{ $verificationUrl }}">Verify Account</a></p>
        <p>Please note that the verification link will expire in 30 minutes. If you do not use the link within this timeframe, you will need to register again.</p>
        <p>Thank you,<br>{{ config('app.name') }}</p>
    </div>
</body>

</html>
