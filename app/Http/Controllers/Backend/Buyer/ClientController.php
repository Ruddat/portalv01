<?php

namespace App\Http\Controllers\Backend\Buyer;

use constGuards;
use constDefaults;
use App\Models\Client;
use App\Models\ModShop;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use app\Helpers\AvatarHelper;
use App\Rules\UniqueUsername;
use App\Models\ModClientShops;
use Illuminate\Support\Carbon;
use App\Services\GeocodeService;
use App\Models\PasswordResetToken;
use Illuminate\Support\Facades\DB;
use App\Helpers\CoolUsernameHelper;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use NominatimLaravel\Content\Nominatim;

class ClientController extends Controller
{

    public function dashboard()
    {
        // Überprüfen, ob der Benutzer authentifiziert ist und das $client-Objekt vorhanden ist
        if (Auth::guard('client')->check()) {
            $client = Auth::guard('client')->user();

            // Überprüfen, ob das $client-Objekt korrekt zugewiesen wurde
            if ($client) {
                // Nehmen wir an, dass wir die ausgewählte Shop-ID aus dem Client-Objekt erhalten
                $selectedShopId = $client->selected_shop_id;

                // Lade die Shops des Clients mit den Pivot-Daten
                $clientShops = $client->shops()->withPivot('is_master')->get();

                // $client-Objekt ist verfügbar, Sie können auf seine Eigenschaften zugreifen
                $data = [
                    'pageTitle' => 'Dashboard',
                    'client' => $client, // Das $client-Objekt an die Ansicht übergeben
                    'selectedShopId' => $selectedShopId, // Die ausgewählte Shop-ID an die Ansicht übergeben
                    'clientShops' => $clientShops, // Übergib die geladenen Shops an die Ansicht
                    'currentShopId' => null,
                    // Weitere Daten hier hinzufügen, falls erforderlich
                ];

                // Löschen Sie die Shop-ID aus der Sitzung, wenn das Dashboard aufgerufen wird
                Session::forget('currentShopId');
                Session::forget('currentShopTitle');
                return view('backend.pages.client.dashboard', $data);
            }
        }
        // Falls die Authentifizierung fehlschlägt oder der Client nicht korrekt zugewiesen wurde,
        // leiten Sie den Benutzer an eine Fehlerseite oder eine andere Seite weiter
        return redirect()->route('login')->withErrors(['error' => 'Unauthorized access.']);
    }

    public function loginHandler(Request $request)
    {
        $fieldType = filter_var($request->login_id, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        // Validierungsregeln und -meldungen
        $rules = [
            'login_id' => $fieldType == 'email' ? 'required|email' : 'required',
            'password' => 'required|min:5|max:45',
        ];

        $messages = [
            'login_id.required' => 'Email or Username is required',
            'login_id.email' => 'Invalid email address',
            'password.required' => 'Password is required',
        ];

        $request->validate($rules, $messages);

        $creds = [
            $fieldType => $request->login_id,
            'password' => $request->password
        ];

        $user = Client::where($fieldType, $request->login_id)->first();

        // Prüfen, ob "Remember Me" ausgewählt wurde
        $remember = $request->has('remember') ? true : false;

        if ($user) {
            if (!is_null($user->password)) {
                if (Auth::guard('client')->attempt($creds, $remember)) {
                    if ($user->email_verified_at) {

                    //    dd($user);

                        // Adresse des Benutzers abrufen und setzen
                        $correctedAddress = $this->getCorrectedAddress($user); // Funktion zur Adresskorrektur
                        $latitude = $user->latitude;
                        $longitude = $user->longitude;

                        // Adresse in der Session speichern
                        session(['address_data' => $correctedAddress]);
                        session(['userLatitude' => $latitude]);
                        session(['userLongitude' => $longitude]);

                        // Vollständige Adresse zusammensetzen
                        $addressString = "{$correctedAddress['street']} {$correctedAddress['houseno']}, {$correctedAddress['postal_code']} {$correctedAddress['city']}";
                        session(['selectedLocation' => $addressString]);

                        return redirect()->route('home');
                    } else {
                        Auth::guard('client')->logout();
                        return back()->withErrors(['fail' => 'Your email is not verified. Please verify your email to login.']);
                    }
                } else {
                    session()->flash('openModal', true);
                    return back()->withErrors(['fail' => 'Invalid credentials']);
                }
            } else {
                session()->flash('openModal', true);
                return back()->withErrors(['fail' => 'Password not set']);
            }
        } else {
            session()->flash('openModal', true);
            return back()->withErrors(['fail' => 'User does not exist']);
        }
    }

    // Beispielhafte Funktion zur Adresskorrektur
    private function getCorrectedAddress($user)
    {
        // Hier könnte eine API-Abfrage oder eine andere Logik zur Adresskorrektur stehen
        return [
            'street' => $user->shipping_street,
            'houseno' => $user->shipping_house_no,
            'postal_code' => $user->postal_code,
            'city' => $user->city
        ];
    }


    public function logoutHandler(Request $request)
    {
        Auth::guard('client')->logout();

        // Remember me token and session cleanup
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        session()->flash('fail', 'You are logged out!');
        return redirect()->route('home');
    }

    public function registerHandler(Request $request)
    {
        $request->validate([
            'name_register' => 'required',
            'last_name_register' => 'required',
            'email_register' => 'required|email',
            'password_register' => 'required|min:5|max:45',
            'password_confirmation_register' => 'required|same:password_register',
        ],[
            'name_register.required' => 'Name is required',
            'last_name_register.required' => 'Last name is required',
            'email_register.required' => 'Email is required',
            'email_register.email' => 'Email is not valid',
            'password_register.required' => 'Password is required',
            'password_register.min' => 'Password must be at least 5 characters',
            'password_register.max' => 'Password must not exceed 45 characters',
            'password_confirmation_register.required' => 'Password confirmation is required',
            'password_confirmation_register.same' => 'Passwords do not match',
        ]);

        // Check for bot trap
        if ($request->filled('bot_trap')) {
            return redirect()->back()->withInput()->withErrors(['bot_trap' => 'Das Formular wurde von einem Roboter ausgefüllt.']);
        }

        // Check if email already exists
        $existingClient = Client::where('email', $request->email_register)->first();

        if ($existingClient) {
            // If the client exists but doesn't have a password, complete the registration
            if (is_null($existingClient->password)) {

                $username = CoolUsernameHelper::generate($request->name_register);
                $existingClient->update([
                    'name' => $request->name_register,
                    'last_name' => $request->last_name_register,
                    'password' => bcrypt($request->password_register),
                    'email_verified_at' => null, // Ensure email verification is required
                ]);

                $token = Str::random(40);
                $encodedToken = base64_encode($token);

                $oldToken = DB::table('password_reset_tokens')
                    ->where(['email' => $request->email_register, 'guard' => constGuards::CLIENT])
                    ->first();

                if ($oldToken) {
                    DB::table('password_reset_tokens')
                        ->where(['email' => $request->email_register, 'guard' => constGuards::CLIENT])
                        ->update([
                            'token' => $token,
                            'created_at' => now(),
                        ]);
                } else {
                    DB::table('password_reset_tokens')->insert([
                        'email' => $request->email_register,
                        'guard' => constGuards::CLIENT,
                        'token' => $token,
                        'created_at' => now(),
                    ]);
                }

                $verificationUrl = route('client.verify-email', ['token' => $encodedToken, 'email' => $request->email_register]);
                $data = [
                    'buyer' => $existingClient,
                    'verificationUrl' => $verificationUrl
                ];

                $email_body = view('email-templates.buyer.buyer-verification-email-template', $data)->render();

                $mailConfig = [
                    'mail_from_email' => custom_env('MAIL_FROM_ADDRESS'),
                    'mail_from_name' => custom_env('MAIL_FROM_NAME'),
                    'mail_recipient_email' => $request->email_register,
                    'mail_recipient_name' => $request->name_register,
                    'mail_subject' => 'Email Verification',
                    'mail_body' => $email_body
                ];

                if (sendEmail($mailConfig)) {
                    session()->flash('success', 'Your email has been verified.');
                    return view('frontend.pages.buyer.auth.email-verificaton', $data);
                } else {
                    session()->flash('fail', 'Something went wrong');
                    return redirect()->route('admin.forgot-password');
                }
            } else {
                return redirect()->back()->withInput()->withErrors(['email_register' => 'Email is already registered.']);
            }
        }


        // Create a new client if not exists
        $username = CoolUsernameHelper::generate($request->name_register);

        // Create a new client if not exists
        $client = Client::create([
            'name' => $request->name_register,
            'last_name' => $request->last_name_register,
            'username' => $username,
            'email' => $request->email_register,
            'password' => bcrypt($request->password_register), // Encrypt the password
        ]);

        $token = Str::random(60);
        $encodedToken = base64_encode($token);

        $oldToken = DB::table('password_reset_tokens')
        ->where(['email' => $request->email_register, 'guard' => constGuards::CLIENT])
        ->first();

    if ($oldToken) {
        DB::table('password_reset_tokens')
            ->where(['email' => $request->email_register, 'guard' => constGuards::CLIENT])
            ->update([
                'token' => $token,
                'created_at' => now(),
            ]);
    } else {
        DB::table('password_reset_tokens')->insert([
            'email' => $request->email_register,
            'guard' => constGuards::CLIENT,
            'token' => $token,
            'created_at' => now(),
        ]);
    }

        $verificationUrl = route('client.verify-email', ['token' => $encodedToken, 'email' => $request->email_register]);
        $data = [
            'buyer' => $client,
            'verificationUrl' => $verificationUrl
        ];

        $email_body = view('email-templates.buyer.buyer-verification-email-template', $data)->render();

        $mailConfig = [
            'mail_from_email' => custom_env('MAIL_FROM_ADDRESS'),
            'mail_from_name' => custom_env('MAIL_FROM_NAME'),
            'mail_recipient_email' => $request->email_register,
            'mail_recipient_name' => $request->name_register,
            'mail_subject' => 'Email Verification',
            'mail_body' => $email_body
        ];

        if (sendEmail($mailConfig)) {
            session()->flash('success', 'Your email has been verified.');
            return view('frontend.pages.buyer.auth.email-verificaton', $data);
        } else {
            session()->flash('fail', 'Something went wrong');
            return redirect()->route('admin.forgot-password');
        }

        return redirect()->route('client.registration.success')->with('success', 'Thank you for your registration. Check your email for verification.');
    }



    // verification email and finish the registration

    public function verifyEmail(Request $request, $token = null)
    {
        // Decode the token
        $decodedToken = base64_decode($token);

        $check_token = DB::table('password_reset_tokens')
            ->where(['token' => $decodedToken, 'guard' => constGuards::CLIENT])
            ->first();

        if ($check_token) {
            // Check if the token is expired
            $diffMins = Carbon::createFromFormat('Y-m-d H:i:s', $check_token->created_at)->diffInMinutes(now());

            if ($diffMins > constDefaults::sellerTokenExpiredMinutes) {
                session()->flash('fail', 'Leider ist die Zeit der Registrierung abgelaufen. Ihre Daten wurden gelöscht. Bitte registrieren Sie sich erneut.');

                // Delete the client and show an error message
                $client = Client::where('email', $check_token->email)->first();
                $client->delete();

                DB::table('password_reset_tokens')
                    ->where(['email' => $check_token->email, 'guard' => constGuards::CLIENT])
                    ->delete();

                return redirect()->route('client.register');
            } else {
                // Token is valid
                // Set email_verified_at and status in the database
                $client = Client::where('email', $check_token->email)->first();
                $client->email_verified_at = now();
                $client->status = 'active';
                $client->save();

                return view('frontend.pages.buyer.auth.complette-register')->with([
                    'token' => $token,
                    'username' => $client->username
                ]);
            }
        } else {
            session()->flash('fail', 'Der Registrierungslink ist ungültig.');
            return redirect()->route('client.register');
        }
    }




    public function registerLastStepHandler(Request $request)
    {
        // Decode the token
        $decodedToken = base64_decode($request->token);

        $clientToken = DB::table('password_reset_tokens')
            ->where(['token' => $decodedToken, 'guard' => constGuards::CLIENT])
            ->first();

        // Check if the token exists and is associated with a client
        if (!$clientToken) {
            return redirect()->route('client.register')->with('fail', 'Invalid token.');
        }

        // Get the client using the email associated with the token
        $client = Client::where('email', $clientToken->email)->first();

        // Validate the request data after retrieving the client
        $request->validate([
            'username' => ['required', 'min:5', 'max:50', new UniqueUsername(optional($client)->id)],
            'shipping_street' => ['required', 'min:5', 'max:50'],
            'shipping_house_no' => ['required', 'min:1', 'max:10'],
            'postal_code' => ['required', 'min:5', 'max:10'],
            'city' => ['required', 'min:3', 'max:50'],
            'token' => 'required', // Ensure that the token is included in the request
        ], [
            'username.required' => 'Username is required',
            'username.min' => 'Username must be at least 5 characters',
            'username.max' => 'Username must not be more than 50 characters',
            'username.unique' => 'Username is already taken',
            'shipping_street.required' => 'Street is required',
            'shipping_street.min' => 'Street must be at least 5 characters',
            'shipping_street.max' => 'Street must not be more than 50 characters',
            'shipping_house_no.required' => 'House number is required',
            'shipping_house_no.min' => 'House number must be at least 1 character',
            'shipping_house_no.max' => 'House number must not be more than 10 characters',
            'postal_code.required' => 'Postal code is required',
            'postal_code.min' => 'Postal code must be at least 5 characters',
            'postal_code.max' => 'Postal code must not be more than 10 characters',
            'city.required' => 'City is required',
            'city.min' => 'City must be at least 3 characters',
            'city.max' => 'City must not be more than 50 characters',
            'token.required' => 'Token is required',
        ]);

        // Generate avatar for the comment
        $nameString = $client->name . ' ' . $client->last_name;

        $avatarUrl = AvatarHelper::createAvatar($nameString);

        $avatarUrl = AvatarHelper::createAvatar($nameString);



        // Extract and construct the complete address
        $street = $request->input('shipping_street');
        $houseNo = $request->input('shipping_house_no');
        $city = $request->input('city');
        $zip = $request->input('postal_code');
        $userInput = "$street $houseNo, $zip $city";

        // Initialize Geocode service
        $geocodeService = new GeocodeService();
        $results = $geocodeService->searchByAddress($userInput);

        if (!empty($results) && isset($results[0]['lat']) && isset($results[0]['lon'])) {
            // Use the coordinates of the first result
            $latitude = $results[0]['lat'];
            $longitude = $results[0]['lon'];

            // Extract the corrected address
            $correctedAddress = [
                'street' => $results[0]['address']['road'] ?? $street,
                'housenumber' => $results[0]['address']['house_number'] ?? $houseNo,
                'postal_code' => $results[0]['address']['postcode'] ?? $zip,
                'city' => $results[0]['address']['city'] ?? $results[0]['address']['village'] ?? $city,
                'city_district' => $results[0]['address']['city_district'] ?? null,
                'suburb' => $results[0]['address']['suburb'] ?? null,
                'country_code' => $results[0]['address']['country_code'] ?? null,
                'country' => $results[0]['address']['country'] ?? null,
                'state' => $results[0]['address']['state'] ?? null,
            ];

            // Store the corrected address in the session
            session(['address_data' => $correctedAddress]);
            session(['userLatitude' => $latitude]);
            session(['userLongitude' => $longitude]);


            // Build the full address string
            $addressString = "{$correctedAddress['street']} {$request->shipping_house_no}, {$correctedAddress['postal_code']} {$correctedAddress['city']}";
            // Save the full address string in the session
            session(['selectedLocation' => $addressString]);


        } else {
            return redirect()->back()->withInput()->withErrors(['address_register' => 'Die Adresse konnte nicht gefunden werden.']);
        }

        // Check if the client exists
        if ($client) {
            // Update client data
            $client->update([
                'username' => $request->username,
                'avatar' => $avatarUrl,
                'shipping_street' => $correctedAddress['street'],
                'shipping_house_no' => $request->shipping_house_no,
                'postal_code' => $correctedAddress['postal_code'],
                'city' => $correctedAddress['city'],
                'country' => $correctedAddress['country'],
                'state' => $correctedAddress['state'],
                'latitude' => $latitude,
                'longitude' => $longitude,
                'status' => 'active',
            ]);

            // Generate login URL for the client
            $loginUrl = route('client.login');

            // Data for the email template
            $data = [
                'buyer' => $client,
                'verificationUrl' => $loginUrl
            ];

            // Render email template
            $email_body = view('email-templates.buyer.registration-confirmation', $data)->render();

            // Email configuration
            $mailConfig = [
                'mail_from_email' => custom_env('MAIL_FROM_ADDRESS'),
                'mail_from_name' => custom_env('MAIL_FROM_NAME'),
                'mail_recipient_email' => $client->email,
                'mail_recipient_name' => $client->name,
                'mail_subject' => 'Email Verification',
                'mail_body' => $email_body,
            ];

            // Send email
            if (sendEmail($mailConfig)) {
                session()->flash('success', 'Password reset link sent on your email');

                // Delete the token from the password_reset_tokens table
                DB::table('password_reset_tokens')->where('token', $clientToken->token)->delete();

                // Log in the client after registration
                Auth::guard('client')->login($client, true);

                // Redirect to the seller dashboard with success message
                return redirect()->route('client.dashboard')->with('success', 'Registration completed successfully.');
            } else {
                session()->flash('fail', 'Something went wrong');
                return redirect()->route('client.register')->with('fail', 'Failed to send verification email.');
            }
        } else {
            return redirect()->route('client.register')->with('fail', 'Client not found.');
        }
    }



    public function login(Request $request)
    {


      //  dd($request->all());

        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        $credentials = $request->only('email', 'password');

        // Prüfen, ob "Remember Me" ausgewählt wurde
        $remember = $request->has('remember') ? true : false;



        if (Auth::guard('client')->attempt($credentials, $remember)) {
            // Login erfolgreich, leiten Sie den Benutzer zur Client-Dashboard-Seite weiter
        return redirect()->intended(route('client.dashboard'));
        }

        // Login fehlgeschlagen, leiten Sie zurück zur Login-Seite mit einer Fehlermeldung
        return redirect()->back()->withInput($request->only('email', 'remember'))->withErrors([
        'email' => 'Diese Anmeldeinformationen stimmen nicht mit unseren Aufzeichnungen überein.',
    ]);
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
        $buyer = Client::where('email', $request->email)->first();

        // Überprüfen Sie, ob der Verkäufer gefunden wurde
        if ($buyer) {
            // Überprüfen Sie, ob der Verkäufer bereits verifiziert wurde
            if ($buyer->email_verified_at) {

                // Überprüfen, ob bereits ein Token für diese E-Mail-Adresse vorhanden ist
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
                    'guard' => constGuards::CLIENT,
                    'token' => $token,
                    'created_at' => now(),
                ]);

                // Generieren der URL für das Zurücksetzen des Passworts
                $resetUrl = route('client.reset-password', ['token' => $token, 'email' => $request->email]);

                // Daten für die E-Mail-Vorlage zusammenstellen
                $data = [
                    'buyer' => $buyer,
                    'resetUrl' => $resetUrl
                ];

                // E-Mail-Vorlage rendern
                $email_body = view('email-templates.buyer.buyer-password-reset-email-template', $data)->render();

                // E-Mail-Konfiguration zusammenstellen
                $mailConfig = [
                    'mail_from_email' => custom_env('MAIL_FROM_ADDRESS'),
                    'mail_from_name' => custom_env('MAIL_FROM_NAME'),
                    'mail_recipient_email' => $buyer->email,
                    'mail_recipient_name' => $buyer->name,
                    'mail_subject' => 'Password Reset',
                    'mail_body' => $email_body,
                ];

 //               dd($mailConfig);


                // E-Mail senden
                if(sendEmail($mailConfig)){
                    session()->flash('success', 'Success Password Reset link sent on your email');
                    return redirect()->route('client.login');
                }else{
                    session()->flash('fail', 'Something went wrong');
                    return redirect()->route('client.forgot-password');
                }

                // Jetzt können Sie die E-Mail senden oder andere Aktionen ausführen
            } else {
                // Der Verkäufer wurde nicht verifiziert
                return redirect()->route('client.forgot-password')->with('fail', 'Your email is not verified. Please verify your email to reset your password.');
            }
        } else {
            // Der Verkäufer wurde nicht gefunden
            return redirect()->route('client.forgot-password')->with('fail', 'Seller not found.');
        }
    } else {
        // Die E-Mail-Adresse ist nicht im Request enthalten
        return redirect()->route('client.forgot-password')->with('fail', 'Email is required.');
    }
}


public function resetPassword(Request $request, $token = null)
{

    // Überprüfen, ob der Token im Request enthalten ist
    $check_token = DB::table('password_reset_tokens')
        ->where(['token' => $token, 'guard' => constGuards::CLIENT])
        ->first();

    if ($check_token) {

        // check if token is not expired
        $diffMins = Carbon::createFromFormat('Y-m-d H:i:s', $check_token->created_at)->diffInMinutes(now());

//dd($diffMins);

        if ($diffMins > constDefaults::tokenExpiredMinutes) {
            session()->flash('fail', 'Token expired');
            return redirect()->route('client.forgot-password', ['token' => $token]);
        }else{
            return view('frontend.pages.buyer.auth.reset-password')->with(['token' => $token]);
        }

        return view('frontend.pages.buyer.auth.reset-password', ['token' => $token, 'email' => $check_token->email]);
    } else {
        session()->flash('fail', 'Invalid token provided for password reset');
        return redirect()->route('client.forgot-password');
    }
}

public function resetPasswordHandler(Request $request)
{
$request->validate([
    'new_password' => 'required|min:5|max:45|required_with:new_password_confirmation|same:new_password_confirmation',
    'new_password_confirmation' => 'required|min:5|max:45|same:new_password'
]);

$token = DB::table('password_reset_tokens')
    ->where(['token' => $request->token, 'guard' => constGuards::CLIENT])
    ->first();

    // get client details
    $buyer = Client::where('email', $token->email)->first();

    // update admin password
    Client::where('email', $token->email)->update([
        'password' => Hash::make($request->new_password)
    ]);

    // delete token from password_resets table
    DB::table('password_reset_tokens')
        ->where(['token' => $request->token, 'guard' => constGuards::CLIENT])
        ->delete();

    // send email to admin
    $data = array(
        'buyer'=>$buyer,
        'new_password' =>$request->new_password
    );

    $mail_body = view('email-templates.buyer.buyer-reset-email-template', $data)->render();

    $mailConfig = array(
        'mail_from_email'=>env('MAIL_FROM_ADDRESS'),
        'mail_from_name'=>env('MAIL_FROM_NAME'),
        'mail_recipient_email'=>$buyer->email,
        'mail_recipient_name'=>$buyer->name,
        'mail_subject'=>'Your password has been changed',
        'mail_body'=>$mail_body

    );

    sendEmail($mailConfig);
    return redirect()->route('client.login')->with('success', 'Done!, Password changed successfully. Use new password to login');


}


}
