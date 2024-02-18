<p>Dear {{ $seller->name }},</p>
<br>


<p>
    Your password on Foodiedesk system was changed successfully
    Here are your new login details:
</p>

<br>

<p>
    <b>Email:</b> {{ $seller->email }} or <b>{{ $seller->email }}</b>
    <br>
    <b>Password:</b> {{ $new_password }}
</p>

<br>

Please keep your login details safe and do not share them with anyone.

<p>
    Foodiedesk will not be able to retrieve your password if you forget it.
</p>
<br>
----------------------------------------------------------------
<br>
<p>
    If you have any questions, please contact us at <a href="mailto:{{ config('app.email') }}">{{ config('app.email') }}</a>

</p>
<p>
    This Email was sent Automatically by Foodiedesk system. Please do not reply to this email.
</p>



<p>Regards,</p>

<p>{{ config('app.name') }}</p>


