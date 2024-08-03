<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@autotranslate('Your Passord has changes', app()->getLocale())</title>

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
            padding-bottom: 20px;
            margin-bottom: 20px;
            border-bottom: 2px solid #ff9800;
        }
        .email-header img {
            max-width: 150px;
        }
        .email-content {
            font-size: 16px;
            color: #555555;
            line-height: 1.6;
        }
        .email-content p {
            margin: 10px 0;
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
        .email-button {
            display: inline-block;
            padding: 12px 24px;
            margin: 20px 0;
            background-color: #ff9800;
            color: #ffffff;
            text-decoration: none;
            border-radius: 25px;
            font-size: 16px;
            font-weight: bold;
        }
        .email-highlight {
            font-weight: bold;
        }
        .separator {
            margin: 20px 0;
            border-top: 1px solid #e0e0e0;
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

            <p>
                @autotranslate('Your password ', app()->getLocale()) <span class="email-highlight">{{ config('app.name') }}</span> @autotranslate(' was changed successfully.', app()->getLocale())
            </p>

            <p>
                @autotranslate('Here are your new login details:', app()->getLocale())
            </p>

            <p>
                <span class="email-highlight">Email:</span> {{ $buyer->email }}<br>
                <span class="email-highlight">Password:</span> {{ $new_password }}
            </p>

            <p>@autotranslate('Please keep your login details safe and do not share them with anyone.', app()->getLocale())</p>

            <p>
                <span class="email-highlight">@autotranslate('Note:', app()->getLocale())</span> @autotranslate('The', app()->getLocale()) {{ config('app.name') }} @autotranslate('team will not be able to retrieve your password if you forget it.', app()->getLocale())
            </p>

            <div class="separator"></div>

            <p>
                @autotranslate('If you have any questions, please contact us at', app()->getLocale()) <a href="mailto:{{ config('app.email') }}">{{ config('app.email') }}</a>
            </p>

            <p>
                @autotranslate('This email was automatically sent by the', app()->getLocale()) {{ config('app.name') }} @autotranslate('system. Please do not reply to this email.', app()->getLocale())
            </p>

            <p>@autotranslate('Regards', app()->getLocale()),</p>
            <p>{{ config('app.name') }}</p>
        </div>
        <div class="email-footer">
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. @autotranslate('All rights reserved.', app()->getLocale())</p>
        </div>
    </div>
</body>
</html>
