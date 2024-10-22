<?php

namespace App\Livewire\Backend\Broker;

use App\Models\Broker;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class BrokerRegistration extends Component
{
    public $name;
    public $email;
    public $password;
    public $confirmpassword;
    public $terms = false;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:brokers,email',
        'password' => 'required|string|min:8',
        'confirmpassword' => 'required|string|same:password',
        'terms' => 'accepted',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function submit()
    {
        $this->validate();

        // Prüfen, ob die E-Mail bereits existiert
        if (Broker::where('email', $this->email)->exists()) {
            session()->flash('fail', app(\App\Services\AutoTranslationService::class)->trans('This email address is already in use.', app()->getLocale()));
            return;
        }

        // Broker erstellen
        $broker = Broker::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password),
        ]);

        $token = Str::random(40);
        $encodedToken = base64_encode($token);

        $oldToken = DB::table('password_reset_tokens')
            ->where(['email' => $this->email, 'guard' => 'broker'])
            ->first();

        if ($oldToken) {
            DB::table('password_reset_tokens')
                ->where(['email' => $this->email, 'guard' => 'broker'])
                ->update([
                    'token' => $token,
                    'created_at' => now(),
                ]);
        } else {
            DB::table('password_reset_tokens')->insert([
                'email' => $this->email,
                'guard' => 'broker',
                'token' => $token,
                'created_at' => now(),
            ]);
        }

        $verificationUrl = route('broker.verify-email', ['token' => $token, 'email' => $this->email]);
        $data = [
            'broker' => $broker,
            'verificationUrl' => $verificationUrl
        ];

        $email_body = view('email-templates.broker.broker-verification-email-template', $data)->render();

        $mailConfig = [
            'mail_from_email' => env('MAIL_FROM_ADDRESS'),
            'mail_from_name' => env('MAIL_FROM_NAME'),
            'mail_recipient_email' => $this->email,
            'mail_recipient_name' => $this->name,
            'mail_subject' => 'Email Verification',
            'mail_body' => $email_body
        ];

        if (sendEmail($mailConfig)) {
            session()->flash('success', app(\App\Services\AutoTranslationService::class)->trans('Registration successful. Please verify your email.', app()->getLocale()));
            session()->flash('email', $this->email); // E-Mail in der Session speichern
            return redirect()->route('broker.email_send');
        } else {
            session()->flash('fail', app(\App\Services\AutoTranslationService::class)->trans('Something went wrong', app()->getLocale()));
            return redirect()->route('admin.forgot-password');
        }
    }

    public function render()
    {
        return view('livewire.backend.broker.broker-registration');
    }
}
