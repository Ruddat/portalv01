<?php

namespace App\Http\Controllers\Backend\Broker;


use constGuards;
use Carbon\Carbon;
use constDefaults;
use App\Models\Broker;
use Illuminate\Http\Request;
use App\Rules\UniqueUsername;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class BrokerController extends Controller
{
    //

    public function dashboard()
    {
        // Überprüfen, ob der Benutzer authentifiziert ist und das $seller-Objekt vorhanden ist
        if (Auth::guard('broker')->check()) {
            $broker = Auth::guard('broker')->user();

            // Überprüfen, ob das $seller-Objekt korrekt zugewiesen wurde
            if ($broker) {
                // Daten für die Dashboard-Ansicht zusammenstellen


                // Löschen Sie die Shop-ID aus der Sitzung, wenn das Dashboard aufgerufen wird
                Session::forget('currentShopId');
                Session::forget('currentShopId');
                Session::forget('currentShopTitle');
                return view('backend.pages.broker.dashboard');
                return view('backend.pages.seller.dashboard', $data);
            }
        }
        // Falls die Authentifizierung fehlschlägt oder der Seller nicht korrekt zugewiesen wurde,
        // leiten Sie den Benutzer an eine Fehlerseite oder eine andere Seite weiter
        return redirect()->route('login')->withErrors(['error' => 'Unauthorized access.']);
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

            if ($diffMins > constDefaults::brokerTokenExpiredMinutes) {
                session()->flash('fail', 'Leider ist die Zeit der Registrierung abgelaufen. Ihre Daten wurden gelöscht. Bitte registrieren Sie sich erneut.');
                // Lösche den Seller und zeige eine Fehlermeldung an
                $this->deleteTimeDownBroker($check_token->email);
                return redirect()->route('broker.register', ['token' => $token]);
            } else {

                // Token ist gültig
                // email ist gültig in der datenbank eintragen
                $seller = Broker::where('email', $check_token->email)->first();
                $seller->email_verified_at = now();
                $seller->status = 'inReview';
                $seller->save();

                return view('backend.pages.broker.auth.complette-register')->with(['token' => $token]);
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
    // Get the seller using the token from the password_reset_tokens table
    $brokerToken = DB::table('password_reset_tokens')->where('token', $request->token)->first();

    // Check if the token exists and is associated with a seller
    if ($brokerToken) {
        // Get the seller using the email associated with the token
        $broker = Broker::where('email', $brokerToken->email)->first();

        // Validate the request data after retrieving the seller
        $request->validate([
            'username' => ['required', 'min:5', 'max:50', new UniqueUsername(optional($broker)->id)],
            'new_password' => 'required|confirmed',
            'new_password_confirmation' => 'required',
            'token' => 'required', // Sicherstellen, dass der Token im Request enthalten ist
        ], [
            'username.required' => 'Username is required',
            'username.min' => 'Username must be at least 5 characters',
            'username.max' => 'Username must not be more than 50 characters',
            'username.unique' => 'Username is already taken',
            'new_password.required' => 'Password is required',
            'new_password.confirmed' => 'Password does not match',
            'new_password_confirmation.required' => 'Password confirmation is required',
            'token.required' => 'Token is required', // Fehlermeldung hinzufügen, wenn der Token nicht im Request enthalten ist
        ]);

    } else {
        // Token not found
        return redirect()->route('broker.register')->with('fail', 'Invalid token.');
    }

        // Get the seller using the token from the password_reset_tokens table
        $brokerToken = DB::table('password_reset_tokens')->where('token', $request->token)->first();

        // Check if the token exists and is associated with a seller
        if ($brokerToken) {
            // Get the seller using the email associated with the token
            $broker = Broker::where('email', $brokerToken->email)->first();

            // Check if the seller exists
            if ($broker) {
                // Update seller data
                $broker->update([
                    'username' => $request->username,
                    'password' => bcrypt($request->new_password),
                ]);

                // Delete the token from the password_reset_tokens table
                DB::table('password_reset_tokens')->where('token', $request->token)->delete();



                // Überprüfen Sie, ob der Verkäufer gefunden wurde
                if ($broker) {

                    // login url erzeugen fuer den verkaeufer
                    $loginUrl = route('seller.dashboard');

                    // Daten für die E-Mail-Vorlage zusammenstellen

                    $data = [
                        'broker' => $broker,
                        'verificationUrl' => $loginUrl
                    ];

                    // E-Mail-Vorlage rendern
                    $email_body = view('email-templates.broker.registration-confirmation', $data)->render();

   // dd($email_body, $data, $seller, $loginUrl);


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
    if(sendEmail($mailConfig)){
        session()->flash('success', 'Password reset link sent on your email');
    //  return redirect()->route('admin.forgot-password');

    }else{
    session()->flash('fail', 'Something went wrong');
   // return redirect()->route('admin.forgot-password');
    }



    // Jetzt können Sie die E-Mail senden oder andere Aktionen ausführen
    } else {
    // Wenn der Verkäufer nicht gefunden wurde, können Sie entsprechend reagieren
    return "Broker not found.";
    }

    // Anmelden des Verkäufers/Brokers nach der Registrierung

    Auth::guard('broker')->login($broker, true, ['username' => $broker->username]);
    // Optional: Perform any additional actions here, such as redirecting or displaying a success message
     return redirect()->route('broker.dashboard')->with('success', 'Registration completed successfully.');
            } else {
                // Seller not found
                return redirect()->route('broker.register')->with('fail', 'Seller not found.');
            }
        } else {
            // Token not found
            return redirect()->route('broker.register')->with('fail', 'Invalid token.');
        }
    }















    public function registerHandler(Request $request)
    {

      //  dd($request->all());


        $request->validate([
            'location' => 'required|string',
            'vehicle' => 'required|string',
            'how_hear' => 'required|array',
            'how_hear.*' => 'required|string',
            'firstname' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telephone' => 'required|string|max:20',
            'age' => 'required|integer|min:18',
            'gender' => 'required|string|in:Männlich,Weiblich',
            'terms' => 'required|accepted',
        ], [
            'location.required' => 'Bitte geben Sie Ihren Standort an',
            'vehicle.required' => 'Bitte geben Sie Ihr Fahrzeug an',
            'how_hear.required' => 'Bitte geben Sie an, wie Sie von uns erfahren haben',
            'firstname.required' => 'Bitte geben Sie Ihren Vornamen an',
            'surname.required' => 'Bitte geben Sie Ihren Nachnamen an',
            'email.required' => 'Bitte geben Sie Ihre E-Mail-Adresse an',
            'telephone.required' => 'Bitte geben Sie Ihre Telefonnummer an',
            'age.required' => 'Bitte geben Sie Ihr Alter an',
        ]);





    }
}
