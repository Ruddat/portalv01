<?php

namespace App\Livewire\Frontend\Buyer;

use Carbon\Carbon;
use App\Models\Client;
use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\ModBuyerDeleteToken;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;


class DashboardSecurity extends Component
{

    public $client;
    public $currentPassword;
    public $newPassword;
    public $newPassword_confirmation;

    public function mount()
    {
        // Hole den authentifizierten Benutzer
        $this->client = Client::find(auth()->id());
    }

    public function changePassword()
    {
        $validator = Validator::make([
            'currentPassword' => $this->currentPassword,
            'newPassword' => $this->newPassword,
            'newPassword_confirmation' => $this->newPassword_confirmation,
        ], [
            'currentPassword' => 'required|string|min:4',
            'newPassword' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            $this->setErrorBag($validator->errors());
            return;
        }

        if (!Hash::check($this->currentPassword, $this->client->password)) {
            session()->flash('error', 'Current password is incorrect.');
            return;
        }

        $this->client->password = Hash::make($this->newPassword);
        $this->client->save();

        session()->flash('message', 'Password updated successfully.');
        $this->reset(['currentPassword', 'newPassword', 'newPassword_confirmation']);
    }


    public function confirmDeleteAccount()
    {
        // Generiere einen Lösch-Token
        $token = Str::random(60);
        $expiresAt = Carbon::now()->addHours(1);

        // Speichern des Tokens und des Ablaufdatums in der Datenbank
        ModBuyerDeleteToken::updateOrCreate(
            ['client_id' => $this->client->id],
            ['token' => $token, 'expires_at' => $expiresAt]
        );

        // Erstelle den Bestätigungslink
        $verificationUrl = route('account.confirmDeletion', ['token' => $token]);

        // Daten für die E-Mail
        $data = [
            'client' => $this->client,
            'verificationUrl' => $verificationUrl
        ];

        // Erstelle den E-Mail-Body
        $email_body = view('email-templates.buyer.buyer-accountdelete-email-template', $data)->render();

        // E-Mail Konfiguration
        $mailConfig = [
            'mail_from_email' => custom_env('MAIL_FROM_ADDRESS'),
            'mail_from_name' => custom_env('MAIL_FROM_NAME'),
            'mail_recipient_email' => $this->client->email,
            'mail_recipient_name' => $this->client->name,
            'mail_subject' => 'Account Deletion Confirmation',
            'mail_body' => $email_body
        ];

        // Sende die E-Mail
        if (sendEmail($mailConfig)) {
            session()->flash('message', 'A confirmation email has been sent to you. Please check your email to complete the account deletion process.');
        } else {
            session()->flash('error', 'Something went wrong while sending the email.');
        }
    }


    public function render()
    {
        return view('livewire.frontend.buyer.dashboard-security')
            ->layout('layouts.buyerdashboard');
    }
}
