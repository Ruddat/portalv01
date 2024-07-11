<?php

namespace App\Livewire\Backend\Broker;

use constGuards;
use constDefaults;
use App\Models\Broker;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class BrokerRegistration extends Component

{

public $step = 1;
public $location, $vehicle, $how_hear = [], $firstname, $surname, $email, $telephone, $age, $gender, $terms;

protected $rules = [
    'location' => 'required',
    'vehicle' => 'required',
    'how_hear' => 'required|array|min:1',
    'firstname' => 'required|string|max:255',
    'surname' => 'required|string|max:255',
    'email' => 'required|email|max:255|unique:brokers,email',
    'telephone' => 'required|string|max:255',
    'age' => 'required|numeric|min:18',
    'gender' => 'required',
    'terms' => 'accepted'
];

public function updated($propertyName)
{
    $this->validateOnly($propertyName);
}

public function nextStep()
{
    $this->validate($this->getStepRules());

    $this->step++;
}

public function previousStep()
{
    $this->step--;
}

public function getStepRules()
{
    switch ($this->step) {
        case 1:
            return ['location' => 'required'];
        case 2:
            return ['vehicle' => 'required'];
        case 3:
            return ['how_hear' => 'required|array|min:1'];
        case 4:
            return [
                'firstname' => 'required|string|max:255',
                'surname' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:brokers,email',
                'telephone' => 'required|string|max:255',
                'age' => 'required|numeric|min:18',
                'gender' => 'required',
            ];
        case 5:
            return ['terms' => 'accepted'];
        default:
            return [];
    }
}

public function submit()
{
    $this->validate();

    // Prüfen, ob die E-Mail bereits existiert
    if (Broker::where('email', $this->email)->exists()) {
        session()->flash('fail', 'Diese E-Mail-Adresse wird bereits verwendet.');
        return;
    }

    // Broker erstellen
    $broker = Broker::create([
        'first_name' => $this->firstname,
        'last_name' => $this->surname,
        'email' => $this->email,
        'phone' => $this->telephone,
        'location_to_work' => $this->location,
        'your_age' => $this->age,
        'gender' => $this->gender,
        'how_hear' => json_encode($this->how_hear),
        'terms' => $this->terms,
        'vehicle' => $this->vehicle,
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
        'mail_recipient_name' => $this->surname,
        'mail_subject' => 'Email Verification',
        'mail_body' => $email_body
    ];

    if (sendEmail($mailConfig)) {
        session()->flash('success', 'Your email has been verified.');
        return redirect()->route('broker.email_send')->with('success', 'Registration successful. Please verify your email');
    } else {
        session()->flash('fail', 'Something went wrong');
        return redirect()->route('admin.forgot-password');
    }
}

public function render()
{
    return view('livewire.backend.broker.broker-registration');
}
}
