<p>Dear {{ $seller->name }},</p>

<p>You are receiving this email because we received a password reset request for your account.</p>

<p>Click the button below to reset your password:</p>

<a href="{{ $resetUrl }}" target="_blank" class="btn btn-primary">Reset Password</a>
<br>

<p>If you did not request a password reset, no further action is required.</p>

<br>
<b>NB:</b> This link will automatically expire in 15 minutes.
<br>
If

<p>Regards,</p>

<p>{{ config('app.name') }}</p>

