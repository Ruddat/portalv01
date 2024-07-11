<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Login</title>
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

        <h1>Dear {{ $broker['username'] }} ,</h1>
        <p>Thank you for registering as a seller! Your account has been successfully created.</p>
        <br /><br />
        <hr>
        <p>Here are your login details:</p>
        <p>Username: <strong>{{ $broker['username'] }}</strong> or <strong>{{ $broker['email'] }}</strong></p>
        <p>Password: your password</p>
        <hr>
        <p>Please click on the link below to login to your account:</p>
        <p><a class="button" href="{{ $verificationUrl }}">Login</a></p>
        <p>If you have any questions or need further assistance, please don't hesitate to contact our support team at support@example.com.</p>
        <p>Thank you for choosing us and happy selling!</p>

           Regards,<br>
        <p>Thank you,<br>{{ config('app.name') }}</p>
    </div>
</body>

</html>
