<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            color: #555;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .email-header {
            background: #e67e22;
            color: #ffffff;
            text-align: center;
            padding: 20px;
        }
        .email-header h1 {
            margin: 0;
            font-size: 24px;
        }
        .email-body {
            padding: 20px;
            line-height: 1.6;
        }
        .email-body p {
            margin: 0 0 10px;
        }
        .email-button {
            display: inline-block;
            padding: 12px 20px;
            margin: 20px 0;
            font-size: 16px;
            font-weight: bold;
            color: #ffffff;
            background: #e67e22;
            text-decoration: none;
            border-radius: 5px;
            text-align: center;
        }
        .email-footer {
            background: #f4f4f4;
            color: #888;
            text-align: center;
            padding: 10px;
            font-size: 14px;
        }
        .email-footer p {
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h1>Email Verification</h1>
        </div>
        <div class="email-body">
            <p>Dear {{ $author }},</p>
            <p>Thank you for your comment on our blog post. To complete the process, please verify your email address by clicking the button below:</p>
            <a href="{{ $verificationUrl }}" class="email-button">Verify Email</a>
            <p>If the button above does not work, copy and paste the following URL into your browser:</p>
            <p><a href="{{ $verificationUrl }}">{{ $verificationUrl }}</a></p>
            <p><strong>Please note:</strong> This verification link is valid for 30 minutes. If you do not verify within this timeframe, your comment will be deleted.</p>
        </div>
        <div class="email-footer">
            <p>&copy; {{ date('Y') }} Your Website. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
