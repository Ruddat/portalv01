<!DOCTYPE html>
<html>
<head>
    <title>Account Deletion Confirmation</title>
</head>
<body>
    <p>Hello {{ $client->name }},</p>
    <p>To confirm the deletion of your account, please click the following link:</p>
    <p><a href="{{ $verificationUrl }}">Confirm Account Deletion</a></p>
    <p>This link will expire in 1 hour.</p>
    <p>If you did not request this deletion, please ignore this email.</p>
    <p>Thank you,</p>
    <p>Your Company</p>
</body>
</html>
