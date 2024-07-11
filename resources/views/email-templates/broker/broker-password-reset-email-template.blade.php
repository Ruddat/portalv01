<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .email-header {
            text-align: center;
            border-bottom: 1px solid #e0e0e0;
            padding-bottom: 20px;
            margin-bottom: 20px;
        }
        .email-header img {
            max-width: 150px;
        }
        .email-content {
            font-size: 16px;
            color: #333333;
        }
        .email-content p {
            margin: 10px 0;
        }
        .email-button {
            display: block;
            width: fit-content;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #007bff;
            color: #ffffff;
            text-decoration: none;
            border-radius: 4px;
            font-size: 16px;
        }
        .email-footer {
            text-align: center;
            font-size: 12px;
            color: #777777;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <img src="{{ asset('images/site/' . get_settings()->site_logo) }}" alt="{{ config('app.name') }}">
        </div>
        <div class="email-content">
            <p>@autotranslate('Hello', app()->getLocale()) {{ $broker->name }},</p>
            <p>@autotranslate('You are receiving this email because we received a password reset request for your account.', app()->getLocale())</p>
            <p>@autotranslate('Click the button below to reset your password:', app()->getLocale())</p>
            <a href="{{ $resetUrl }}" target="_blank" class="email-button">@autotranslate('Reset Password', app()->getLocale())</a>
            <p>@autotranslate('If you did not request a password reset, no further action is required.', app()->getLocale())</p>
            <p><b>NB:</b> @autotranslate('This link will automatically expire in 15 minutes.', app()->getLocale()) </p>
            <p>@autotranslate('Regards,', app()->getLocale()) </p>
            <p>{{ config('app.name') }}</p>
        </div>
        <div class="email-footer">
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. @autotranslate('All rights reserved.', app()->getLocale())</p>
        </div>
    </div>
</body>
</html>
