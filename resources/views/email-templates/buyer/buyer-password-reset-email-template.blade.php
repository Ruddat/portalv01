<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@autotranslate('Password reset', app()->getLocale())</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f8f8;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        .email-header {
            text-align: center;
            border-bottom: 2px solid #ff9800;
            padding-bottom: 20px;
            margin-bottom: 20px;
        }
        .email-header img {
            max-width: 150px;
        }
        .email-content {
            font-size: 16px;
            color: #555555;
        }
        .email-content p {
            margin: 10px 0;
        }
        .email-button {
            display: block;
            width: fit-content;
            margin: 20px auto;
            padding: 12px 24px;
            background-color: #ff9800;
            color: #ffffff;
            text-decoration: none;
            border-radius: 25px;
            font-size: 16px;
            font-weight: bold;
        }
        .email-footer {
            text-align: center;
            font-size: 12px;
            color: #999999;
            margin-top: 20px;
        }
        .email-footer p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <img src="{{ asset('images/site/' . get_settings()->site_logo) }}" alt="{{ config('app.name') }}">
        </div>
        <div class="email-content">
            <p>@autotranslate('Hello', app()->getLocale()) {{ $buyer->name }},</p>
            <p>@autotranslate('You are receiving this email because we received a password reset request for your account.', app()->getLocale())</p>
            <p>@autotranslate('Click the button below to reset your password:', app()->getLocale())</p>
            <a href="{{ $resetUrl }}" target="_blank" class="email-button">@autotranslate('Reset Password', app()->getLocale())</a>
            <p>@autotranslate('If you did not request a password reset, no further action is required.', app()->getLocale())</p>
            <p><b>@autotranslate('NB:', app()->getLocale())</b> @autotranslate('This link will automatically expire in 15 minutes.', app()->getLocale()) </p>
            <p>@autotranslate('Regards,', app()->getLocale())</p>
            <p>{{ config('app.name') }}</p>
        </div>
        <div class="email-footer">
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. @autotranslate('All rights reserved.', app()->getLocale())</p>
        </div>
    </div>
</body>
</html>
