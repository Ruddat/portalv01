<!DOCTYPE html>
<html lang="en">
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
            padding-bottom: 20px;
            margin-bottom: 20px;
            border-bottom: 1px solid #e0e0e0;
        }
        .email-header img {
            max-width: 150px;
        }
        .email-content {
            font-size: 16px;
            color: #333333;
            line-height: 1.6;
        }
        .email-content p {
            margin: 10px 0;
        }
        .email-footer {
            text-align: center;
            font-size: 12px;
            color: #777777;
            margin-top: 20px;
        }
        .email-footer p {
            margin: 5px 0;
        }
        .email-button {
            display: inline-block;
            padding: 10px 20px;
            margin: 20px 0;
            background-color: #007bff;
            color: #ffffff;
            text-decoration: none;
            border-radius: 4px;
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
            <p>@autotranslate('Hello', app()->getLocale()) {{ $broker->name }},</p>

            <p>
                @autotranslate('Your password on the', app()->getLocale()) <span class="email-highlight">{{ config('app.name') }}</span>  @autotranslate('system was changed successfully.', app()->getLocale())
            </p>

            <p>
                @autotranslate('Here are your new login details:', app()->getLocale())
            </p>

            <p>
                <span class="email-highlight">Email:</span> {{ $broker->email }}<br>
                <span class="email-highlight">Password:</span> {{ $new_password }}
            </p>

            <p>@autotranslate('Please keep your login details safe and do not share them with anyone.', app()->getLocale())</p>

            <p>
                <span class="email-highlight">Note:</span> {{ config('app.name') }} @autotranslate('will not be able to retrieve your password if you forget it.', app()->getLocale())
            </p>

            <div class="separator"></div>

            <p>
                @autotranslate('If you have any questions, please contact us at', app()->getLocale()) <a href="mailto:{{ config('app.email') }}">{{ config('app.email') }}</a>
            </p>

            <p>
                @autotranslate('Diese E-Mail wurde automatisch gesendet vom', app()->getLocale()) {{ config('app.name') }} @autotranslate('system. Please do not reply to this email.', app()->getLocale())
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
