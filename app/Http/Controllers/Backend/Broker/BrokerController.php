<?php

namespace App\Http\Controllers\Backend\Broker;


use constGuards;
use Carbon\Carbon;
use constDefaults;
use App\Models\Broker;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Rules\UniqueUsername;
use App\Models\PasswordResetToken;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class BrokerController extends Controller
{
    //

    public function dashboard()
    {
        // Überprüfen, ob der Benutzer authentifiziert ist und das $broker-Objekt vorhanden ist
        if (Auth::guard('broker')->check()) {
            $broker = Auth::guard('broker')->user();

            // Überprüfen, ob das $broker-Objekt korrekt zugewiesen wurde
            if ($broker) {
                // Daten für die Dashboard-Ansicht zusammenstellen


                // Löschen Sie die Shop-ID aus der Sitzung, wenn das Dashboard aufgerufen wird
                Session::forget('currentShopId');
                Session::forget('currentShopId');
                Session::forget('currentShopTitle');
                return view('dreamposadmin.broker.broker-dashboard');
                return view('backend.pages.broker.dashboard', $data);
            }
        }
        // Falls die Authentifizierung fehlschlägt oder der Broker nicht korrekt zugewiesen wurde,
        // leiten Sie den Benutzer an eine Fehlerseite oder eine andere Seite weiter
        return redirect()->route('login')->withErrors(['error' => 'Unauthorized access.']);
    }

    public function resetPassword(Request $request, $token = null)
    {

        $check_token = DB::table('password_reset_tokens')
            ->where(['token' => $token, 'guard' => constGuards::BROKER])
            ->first();

        if ($check_token) {

            // check if token is not expired
            $diffMins = Carbon::createFromFormat('Y-m-d H:i:s', $check_token->created_at)->diffInMinutes(now());

            if ($diffMins > constDefaults::tokenExpiredMinutes) {
                session()->flash('fail', 'Token expired');
                return redirect()->route('broker.forgot-password', ['token' => $token]);
            }else{
                return view('backend.pages.broker.auth.reset-password')->with(['token' => $token]);
            }

            return view('backend.pages.broker.auth.reset-password', ['token' => $token, 'email' => $check_token->email]);
        } else {
            session()->flash('fail', 'Invalid token provided for password reset');
            return redirect()->route('broker.forgot-password');
        }
    }


    public function resetPasswordHandler(Request $request)
{
$request->validate([
    'new_password' => 'required|min:5|max:45|required_with:new_password_confirmation|same:new_password_confirmation',
    'new_password_confirmation' => 'required|min:5|max:45|same:new_password'
]);

$token = DB::table('password_reset_tokens')
    ->where(['token' => $request->token, 'guard' => constGuards::BROKER])
    ->first();


    // get seller details
    $broker = Broker::where('email', $token->email)->first();

    // update admin password
    Broker::where('email', $token->email)->update([
        'password' => Hash::make($request->new_password)
    ]);

    // delete token from password_resets table
    DB::table('password_reset_tokens')
        ->where(['token' => $request->token, 'guard' => constGuards::BROKER])
        ->delete();

    // send email to admin
    $data = array(
        'broker'=>$broker,
        'new_password' =>$request->new_password
    );

    $mail_body = view('email-templates.broker.broker-reset-email-template', $data)->render();

    $mailConfig = array(
        'mail_from_email'=>env('MAIL_FROM_ADDRESS'),
        'mail_from_name'=>env('MAIL_FROM_NAME'),
        'mail_recipient_email'=>$broker->email,
        'mail_recipient_name'=>$broker->name,
        'mail_subject'=>'Your password has been changed',
        'mail_body'=>$mail_body

    );

    sendEmail($mailConfig);
    return redirect()->route('broker.login')->with('success', 'Done!, Password changed successfully. Use new password to login');


}


    public function sendPasswordResetLink(Request $request)
    {
        // Überprüfen Sie, ob die E-Mail-Adresse im Request enthalten ist
        if ($request->filled('email')) {

            $request->validate([
                'email' => 'required|email',
            ], [
                'email.required' => 'Email is required',
                'email.email' => 'Invalid email address',
            ]);


            // Überprüfen Sie, ob der Verkäufer mit der E-Mail-Adresse gefunden wurde
            $broker = Broker::where('email', $request->email)->first();

            // Überprüfen Sie, ob der Verkäufer gefunden wurde
            if ($broker) {
                // Überprüfen Sie, ob der Verkäufer bereits verifiziert wurde
                if ($broker->email_verified_at) {



                    $existingToken = PasswordResetToken::where('email', $request->email)->first();

                    if ($existingToken) {
                        // Eintrag für diese E-Mail-Adresse bereits vorhanden, aktualisieren oder löschen
                        // Zum Beispiel:
                        // $existingToken->update(['token' => $newToken]);
                        // oder
    //dd($existingToken);
                        //$existingToken->delete();
                        PasswordResetToken::where('email', $request->email)->delete();
                        // Hier kannst du deine Logik einfügen, um den vorhandenen Token zu aktualisieren oder zu löschen.
                    }

                    // Generieren Sie einen Token
                    $token = Str::random(40);

                    // Speichern Sie den Token in der Datenbank
                    DB::table('password_reset_tokens')->insert([
                        'email' => $request->email,
                        'guard' => constGuards::BROKER,
                        'token' => $token,
                        'created_at' => now(),
                    ]);

                    // Generieren Sie die URL für das Zurücksetzen des Passworts
                    $resetUrl = route('broker.reset-password', ['token' => $token, 'email' => $request->email]);

                    // Daten für die E-Mail-Vorlage zusammenstellen
                    $data = [
                        'broker' => $broker,
                        'resetUrl' => $resetUrl
                    ];

                    // E-Mail-Vorlage rendern
                    $email_body = view('email-templates.broker.broker-password-reset-email-template', $data)->render();

                    // E-Mail-Konfiguration zusammenstellen
                    $mailConfig = [
                        'mail_from_email' => custom_env('MAIL_FROM_ADDRESS'),
                        'mail_from_name' => custom_env('MAIL_FROM_NAME'),
                        'mail_recipient_email' => $broker->email,
                        'mail_recipient_name' => $broker->name,
                        'mail_subject' => 'Password Reset',
                        'mail_body' => $email_body,
                    ];

     //               dd($mailConfig);


                    // E-Mail senden
                    if(sendEmail($mailConfig)){
                        session()->flash('success', 'Success Password Reset link sent on your email');
                        return redirect()->route('broker.login');
                    }else{
                        session()->flash('fail', 'Something went wrong');
                        return redirect()->route('broker.forgot-password');
                    }

                    // Jetzt können Sie die E-Mail senden oder andere Aktionen ausführen
                } else {
                    // Der Verkäufer wurde nicht verifiziert
                    return redirect()->route('broker.forgot-password')->with('fail', 'Your email is not verified. Please verify your email to reset your password.');
                }
            } else {
                // Der Verkäufer wurde nicht gefunden
                return redirect()->route('broker.forgot-password')->with('fail', 'Broker not found.');
            }
        } else {
            // Die E-Mail-Adresse ist nicht im Request enthalten
            return redirect()->route('broker.forgot-password')->with('fail', 'Email is required.');
        }
    }



    // verification email and finish the registration

    public function verifyEmail(Request $request, $token = null)
    {
        $check_token = DB::table('password_reset_tokens')
            ->where(['token' => $token, 'guard' => constGuards::BROKER])
            ->first();

        if ($check_token) {
            // Überprüfen, ob der Token abgelaufen ist
            $diffMins = Carbon::createFromFormat('Y-m-d H:i:s', $check_token->created_at)->diffInMinutes(now());

            if ($diffMins > constDefaults::tokenExpiredMinutes) {
                session()->flash('fail', 'Leider ist die Zeit der Registrierung abgelaufen. Ihre Daten wurden gelöscht. Bitte registrieren Sie sich erneut.');
                // Lösche den Broker und zeige eine Fehlermeldung an
                $this->deleteTimeDownBroker($check_token->email);
                return redirect()->route('broker.register', ['token' => $token]);
            } else {

                // Token ist gültig
                // email ist gültig in der datenbank eintragen
                $broker = Broker::where('email', $check_token->email)->first();
                $broker->email_verified_at = now();
                $broker->status = 'inReview';
                $broker->save();

                return view('dreamposadmin.broker.auth.complette-register')->with(['token' => $token]);
            }
        } else {
            session()->flash('fail', 'Registered Link is invalid');
            return redirect()->route('broker.register');
        }
    }

    public function deleteTimeDownBroker($brokerEmail)
    {
        // Hole den Broker anhand der E-Mail-Adresse
        $broker = Broker::where('email', $brokerEmail)->first();

        // Überprüfe, ob der Broker existiert
        if ($broker) {

            // fuer spaeter
            $deletedShopsCount = 0;

            // Lösche den Broker
            $broker->forceDelete();

            // Optional: Du könntest hier weitere Aktionen ausführen, z.B. eine Bestätigungsmeldung anzeigen
            if ($deletedShopsCount > 0) {
                session()->flash('success', 'Der Broker und seine nicht fertigen Shops wurden erfolgreich gelöscht.');
            } else {
                session()->flash('success', 'Der Broker wurde gelöscht, aber keine nicht fertigen Shops gefunden.');
            }
        } else {
            // Der Broker existiert nicht
            session()->flash('fail', 'Der Broker wurde nicht gefunden.');
        }

        // Leite den Benutzer zu einer anderen Seite weiter oder zeige eine Meldung an
        // return redirect()->route('route_name');
    }


    public function registerLastStepHandler(Request $request)
    {
        // Überprüfen Sie den Token im Request
      //  dd($request);

        // Get the Broker using the token from the password_reset_tokens table
        $brokerToken = DB::table('password_reset_tokens')->where('token', $request->token)->first();
     //   dd($brokerToken);

        // Check if the token exists and is associated with a Broker
        if ($brokerToken) {
            // Get the Broker using the email associated with the token
            $broker = Broker::where('email', $brokerToken->email)->first();
       //     dd($broker);

            // Validate the request data after retrieving the Broker
            $request->validate([
                'username' => ['required', 'min:5', 'max:50', new UniqueUsername(optional($broker)->id)],
                'first_name' => 'required|string|max:191',
                'last_name' => 'required|string|max:191',
                'street' => 'required|string|max:191',
                'house_number' => 'required|string|max:191',
                'zip_code' => 'required|string|max:191',
                'city' => 'required|string|max:191',
                'phone' => 'required|string|max:191',
                'token' => 'required', // Sicherstellen, dass der Token im Request enthalten ist
            ], [
                'username.required' => 'Username is required',
                'username.min' => 'Username must be at least 5 characters',
                'username.max' => 'Username must not be more than 50 characters',
                'username.unique' => 'Username is already taken',
                'first_name.required' => 'First name is required',
                'last_name.required' => 'Last name is required',
                'street.required' => 'Street is required',
                'house_number.required' => 'House number is required',
                'zip_code.required' => 'ZIP code is required',
                'city.required' => 'City is required',
                'phone.required' => 'Phone number is required',
                'token.required' => 'Token is required', // Fehlermeldung hinzufügen, wenn der Token nicht im Request enthalten ist
            ]);

//dd($request);

            // Check if the Broker exists
            if ($broker) {
                // Update Broker data
                $broker->update([
                    'username' => $request->username,
                    'password' => bcrypt($request->new_password),
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'address' => $request->street . ' ' . $request->house_number,
                    'zip_code' => $request->zip_code,
                    'city' => $request->city,
                    'phone' => $request->phone,
                ]);

                // Delete the token from the password_reset_tokens table
                DB::table('password_reset_tokens')->where('token', $request->token)->delete();

                // Überprüfen Sie, ob der Verkäufer gefunden wurde
                if ($broker) {
                    // login url erzeugen fuer den verkaeufer
                    $loginUrl = route('broker.dashboard');

                    // Daten für die E-Mail-Vorlage zusammenstellen
                    $data = [
                        'broker' => $broker,
                        'verificationUrl' => $loginUrl
                    ];

                    // E-Mail-Vorlage rendern
                    $email_body = view('email-templates.broker.registration-confirmation', $data)->render();

                    // E-Mail-Konfiguration zusammenstellen
                    $mailConfig = [
                        'mail_from_email' => custom_env('MAIL_FROM_ADDRESS'),
                        'mail_from_name' => custom_env('MAIL_FROM_NAME'),
                        'mail_recipient_email' => $broker->email,
                        'mail_recipient_name' => $broker->name,
                        'mail_subject' => 'Email Verification',
                        'mail_body' => $email_body,
                    ];

                    // E-Mail senden
                    if (sendEmail($mailConfig)) {
                        session()->flash('success', 'Password reset link sent on your email');
                    } else {
                        session()->flash('fail', 'Something went wrong');
                    }

                    // Anmelden des Verkäufers/Brokers nach der Registrierung
                    Auth::guard('broker')->login($broker, true, ['username' => $broker->username]);
                    return redirect()->route('broker.dashboard')->with('success', 'Registration completed successfully.');
                } else {
                    // Broker not found
                    return redirect()->route('broker.register')->with('fail', 'Broker not found.');
                }
            } else {
                // Token not found
                return redirect()->route('broker.register')->with('fail', 'Invalid token.');
            }
        }
    }



    public function loginHandler(Request $request )
    {
        $fieldType = filter_var($request->login_id, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if ($fieldType == 'email') {
            $request->validate([
                'login_id' => 'required|email',
                'password' => 'required|min:5|max:45'
            ], [
                'login_id.required' => 'Email or Username is required',
                'login_id.email' => 'Invalid email address',
                'password.required' => 'Password is required',
            ]);
        } else {
            $request->validate([
                'login_id' => 'required',
                'password' => 'required|min:5|max:45'
            ], [
                'login_id.required' => 'Email or Username is required',
                'password.required' => 'Password is required',
            ]);
        }

        $creds = [
            $fieldType => $request->login_id,
            'password' => $request->password
        ];

        // Check if the user exists
        $user = Broker::where($fieldType, $request->login_id)->first();

        if ($user) {
            // Check if the password has been set
            if (!is_null($user->password)) {
                // Authenticate the user
                if (Auth::guard('broker')->attempt($creds, $request->remember)) {
                    // Check email verification status
                    if ($user->email_verified_at) {
                        // Redirect to dashboard or another protected page
                        return redirect()->route('broker.dashboard');
                    } else {
                        // Email not verified, show error message
                        Auth::guard('broker')->logout();
                        session()->flash('fail', 'Your email is not verified. Please verify your email to login.');
                        return redirect()->route('broker.login');
                    }
                } else {
                    // Invalid credentials
                    session()->flash('fail', 'Invalid credentials');
                    return redirect()->route('broker.login');
                }
            } else {
                // Password has not been set yet
                session()->flash('fail', 'Password not set');
                return redirect()->route('broker.login');
            }
        } else {
            // User does not exist
            session()->flash('fail', 'User does not exist');
            return redirect()->route('broker.login');
        }
    }

    public function logoutHandler()
    {
        Auth::guard('broker')->logout();
        session()->flash('fail', 'You are logged out!');
        return redirect()->route('broker.login');
    }


    public function resendVerificationEmail(Request $request)
{
    $request->validate([
        'email' => 'required|email',
    ]);

    $broker = Broker::where('email', $request->email)->first();

    if ($broker) {
        $token = Str::random(40);
        $encodedToken = base64_encode($token);

        $oldToken = DB::table('password_reset_tokens')
            ->where(['email' => $request->email, 'guard' => 'broker'])
            ->first();

        if ($oldToken) {
            DB::table('password_reset_tokens')
                ->where(['email' => $request->email, 'guard' => 'broker'])
                ->update([
                    'token' => $token,
                    'created_at' => now(),
                ]);
        } else {
            DB::table('password_reset_tokens')->insert([
                'email' => $request->email,
                'guard' => 'broker',
                'token' => $token,
                'created_at' => now(),
            ]);
        }

        $verificationUrl = route('broker.verify-email', ['token' => $token, 'email' => $request->email]);
        $data = [
            'broker' => $broker,
            'verificationUrl' => $verificationUrl
        ];

        $email_body = view('email-templates.broker.broker-verification-email-template', $data)->render();

        $mailConfig = [
            'mail_from_email' => env('MAIL_FROM_ADDRESS'),
            'mail_from_name' => env('MAIL_FROM_NAME'),
            'mail_recipient_email' => $request->email,
            'mail_recipient_name' => $broker->name,
            'mail_subject' => 'Email Verification',
            'mail_body' => $email_body
        ];

        if (sendEmail($mailConfig)) {
            return response()->json(['message' => 'Verification email has been resent.']);
        } else {
            return response()->json(['message' => 'Something went wrong'], 500);
        }
    } else {
        return response()->json(['message' => 'Broker not found'], 404);
    }
}

}
