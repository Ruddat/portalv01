<?php

namespace App\Http\Controllers\Backend\Seller;

use constGuards;
use constDefaults;
use App\Models\Seller;
use App\Models\ModShop;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Rules\UniqueUsername;
use App\Models\ModSellerShops;
use Illuminate\Support\Carbon;
use App\Services\GeocodeService;
use App\Models\PasswordResetToken;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use NominatimLaravel\Content\Nominatim;

class SellerController extends Controller
{

    public function dashboard()
    {
        // Überprüfen, ob der Benutzer authentifiziert ist und das $seller-Objekt vorhanden ist
        if (Auth::guard('seller')->check()) {
            $seller = Auth::guard('seller')->user();

            // Überprüfen, ob das $seller-Objekt korrekt zugewiesen wurde
            if ($seller) {
                // Nehmen wir an, dass wir die ausgewählte Shop-ID aus dem Seller-Objekt erhalten
                $selectedShopId = $seller->selected_shop_id;

                            // Lade die Shops des Verkäufers mit den Pivot-Daten
            $sellerShops = $seller->shops()->withPivot('is_master')->get();

                // $seller-Objekt ist verfügbar, Sie können auf seine Eigenschaften zugreifen
                $data = [
                    'pageTitle' => 'Dashboard',
                    'seller' => $seller, // Das $seller-Objekt an die Ansicht übergeben
                    'selectedShopId' => $selectedShopId, // Die ausgewählte Shop-ID an die Ansicht übergeben
                    'sellerShops' => $sellerShops, // Übergib die geladenen Shops an die Ansicht
                    'currentShopId' => null,

                    // Weitere Daten hier hinzufügen, falls erforderlich


                ];

                        // Löschen Sie die Shop-ID aus der Sitzung, wenn das Dashboard aufgerufen wird
                Session::forget('currentShopId');
                Session::forget('currentShopId');
                Session::forget('currentShopTitle');
                return view('backend.pages.seller.dashboard', $data);
            }
        }
        // Falls die Authentifizierung fehlschlägt oder der Seller nicht korrekt zugewiesen wurde,
        // leiten Sie den Benutzer an eine Fehlerseite oder eine andere Seite weiter
        return redirect()->route('login')->withErrors(['error' => 'Unauthorized access.']);
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
        $user = Seller::where($fieldType, $request->login_id)->first();

        // Prüfen, ob "Remember Me" ausgewählt wurde
        $remember = $request->has('remember') ? true : false;

        if ($user) {
            // Check if the password has been set
            if (!is_null($user->password)) {
                // Authenticate the user
                if (Auth::guard('seller')->attempt($creds, $remember)) {
                    // Check email verification status
                    if ($user->email_verified_at) {
                        // Redirect to dashboard or another protected page
                        return redirect()->route('seller.dashboard');
                    } else {
                        // Email not verified, show error message
                        Auth::guard('seller')->logout();
                        session()->flash('fail', 'Your email is not verified. Please verify your email to login.');
                        return redirect()->route('seller.login');
                    }
                } else {
                    // Invalid credentials
                    session()->flash('fail', 'Invalid credentials');
                    return redirect()->route('seller.login');
                }
            } else {
                // Password has not been set yet
                session()->flash('fail', 'Password not set');
                return redirect()->route('seller.login');
            }
        } else {
            // User does not exist
            session()->flash('fail', 'User does not exist');
            return redirect()->route('seller.login');
        }
    }

    public function logoutHandler()
    {
        Auth::guard('seller')->logout();
        session()->flash('fail', 'You are logged out!');
        return redirect()->route('seller.login');
    }



    public function registerHandler(Request $request)
    {
        $request->validate([
            'name_register' => 'required',
            'email_register' => 'required|email|unique:sellers,email',
            'restaurantname_register' => 'required|min:5',
            'address_register' => 'required',
            'city_register' => 'required',
            'zip_register' => 'required',
            'country_register' => 'required',
        ],[
            'name_register.required' => 'Name is required',
            'email_register.required' => 'Email is required',
            'email_register.email' => 'Email is not valid',
            'email_register.unique' => 'Email is already taken',
            'restaurantname_register.required' => 'Restaurant name is required',
            'restaurantname_register.min' => 'Restaurant name must be at least 5 characters',
            'address_register.required' => 'Address is required',
            'city_register.required' => 'City is required',
            'zip_register.required' => 'Zip is required',
            'country_register.required' => 'Country is required',
        ]);

        if ($request->filled('bot_trap')) {
            return redirect()->back()->withInput()->withErrors(['bot_trap' => 'Das Formular wurde von einem Roboter ausgefüllt.']);
        }

        // Generiere eine eindeutige Shopnummer
        $timestamp = now()->format('ymdHi');
        $randomNumber = mt_rand(10, 99);
        $uniqueShopNumber = sprintf('%s-%s', $timestamp, $randomNumber);

        $uniqueShopNumber = generateCopyUniqueShopNumber('Self');

        $this->newShop['shop_nr'] = $uniqueShopNumber;
        $defaultPhone = '1234567890';

        // Extrahiere und baue die vollständige Adresse
        $address = $request->input('address_register');
        $city = $request->input('city_register');
        $zip = $request->input('zip_register');
        $userInput = "$address $zip $city";

        // Geocode-Service initialisieren
        $geocodeService = new GeocodeService();
        $results = $geocodeService->searchByAddress($userInput);

        if (!empty($results) && isset($results[0]['lat']) && isset($results[0]['lon'])) {
            // Nutze die Koordinaten des ersten Ergebnisses
            $latitude = $results[0]['lat'];
            $longitude = $results[0]['lon'];

            // Extrahiere die korrigierte Adresse
            $correctedAddress = [
                'street' => $results[0]['address']['road'] ?? $address,
                'housenumber' => $results[0]['address']['house_number'] ?? '',
                'postal_code' => $results[0]['address']['postcode'] ?? $zip,
                'city' => $results[0]['address']['city'] ?? $results[0]['address']['village'] ?? $city,
                'city_district' => $results[0]['address']['city_district'] ?? null,
                'suburb' => $results[0]['address']['suburb'] ?? null,
            ];
//dd($correctedAddress);

            // Speichere die korrigierte Adresse in der Session
            session(['address_data' => $correctedAddress]);

        } else {
            return redirect()->back()->withInput()->withErrors(['address_register' => 'Die Adresse konnte nicht gefunden werden.']);
        }

        $seller = Seller::create([
            'name' => $request->name_register,
            'email' => $request->email_register,
        ]);


        $shop = $seller->shops()->create([
            'shop_nr' => $this->newShop['shop_nr'],
            'title' => $request->restaurantname_register,
            'street' => ucfirst($request->address_register),
            'city' => $correctedAddress['city'],
            'zip' => $correctedAddress['postal_code'],
            'phone' => $defaultPhone,
            'email' => $request->email_register,
            'lat' => $latitude,
            'lng' => $longitude,
            'ordering' => '100000',
            'published' => '1',
            'broker' => $request->name_register,
            'order_email' => $request->email_register,
            'progress' => '0',
            'status' => 'limited',
        ]);

        $seller->shops()->wherePivot('mod_shop_id', $shop->id)->updateExistingPivot($shop->id, ['is_master' => true]);

        $token = Str::random(40);
        $encodedToken = base64_encode($token);

        $oldToken = DB::table('password_reset_tokens')
            ->where(['email' => $request->email_register, 'guard' => constGuards::SELLER])
            ->first();

        if ($oldToken) {
            DB::table('password_reset_tokens')
                ->where(['email' => $request->email_register, 'guard' => constGuards::SELLER])
                ->update([
                'token' => $token,
                'created_at' => now(),
            ]);
        } else {
            DB::table('password_reset_tokens')->insert([
                'email' => $request->email_register,
                'guard' => constGuards::SELLER,
                'token' => $token,
                'created_at' => now(),
            ]);
        }

        $verificationUrl = route('seller.verify-email', ['token' => $token, 'email' => $request->email_register]);
        $data = [
            'seller' => $seller,
            'verificationUrl' => $verificationUrl
        ];

        $email_body = view('email-templates.seller-verification-email-template', $data)->render();

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
            return view('backend.pages.seller.auth.email-verificaton', $data);
        } else {
            session()->flash('fail', 'Something went wrong');
            return redirect()->route('admin.forgot-password');
        }

        return redirect()->route('seller.login')->with('success', 'Registration successful. Please verify your email');
    }


    // verification email and finish the registration

    public function verifyEmail(Request $request, $token = null)
    {
        $check_token = DB::table('password_reset_tokens')
            ->where(['token' => $token, 'guard' => constGuards::SELLER])
            ->first();

        if ($check_token) {
            // Überprüfen, ob der Token abgelaufen ist
            $diffMins = Carbon::createFromFormat('Y-m-d H:i:s', $check_token->created_at)->diffInMinutes(now());

            if ($diffMins > constDefaults::sellerTokenExpiredMinutes) {
                session()->flash('fail', 'Leider ist die Zeit der Registrierung abgelaufen. Ihre Daten wurden gelöscht. Bitte registrieren Sie sich erneut.');
                // Lösche den Seller und zeige eine Fehlermeldung an
                $this->deleteUnfinishedShops($check_token->email);
                return redirect()->route('seller.register', ['token' => $token]);
            } else {

                // Token ist gültig
                // email ist gültig in der datenbank eintragen
                $seller = Seller::where('email', $check_token->email)->first();
                $seller->email_verified_at = now();
                $seller->status = 'active';
                $seller->save();

                return view('backend.pages.seller.auth.complette-register')->with(['token' => $token]);
            }
        } else {
            session()->flash('fail', 'Registered Link is invalid');
            return redirect()->route('seller.register');
        }
    }

    public function deleteUnfinishedShops($sellerEmail)
    {
        // Hole den Seller anhand der E-Mail-Adresse
        $seller = Seller::where('email', $sellerEmail)->first();

        // Überprüfe, ob der Seller existiert
        if ($seller) {
            // Hole die IDs der nicht fertigen Shops, die mit diesem Seller verbunden sind
            $unfinishedShopIds = ModSellerShops::where('seller_id', $seller->id)
                ->where('is_finished', false)
                ->pluck('mod_shop_id');

             //   dd($unfinishedShopIds);

            // Lösche die nicht fertigen Shops aus der mod_shops-Tabelle, die diesem Seller zugeordnet sind
         //   $deletedShopsCount = ModShop::whereIn('id', $unfinishedShopIds)->delete();
            $deletedShopsCount = ModShop::whereIn('id', $unfinishedShopIds)->forceDelete();

            // Lösche den Seller
            $seller->delete();

            // Optional: Du könntest hier weitere Aktionen ausführen, z.B. eine Bestätigungsmeldung anzeigen
            if ($deletedShopsCount > 0) {
                session()->flash('success', 'Der Seller und seine nicht fertigen Shops wurden erfolgreich gelöscht.');
            } else {
                session()->flash('success', 'Der Seller wurde gelöscht, aber keine nicht fertigen Shops gefunden.');
            }
        } else {
            // Der Seller existiert nicht
            session()->flash('fail', 'Der Seller wurde nicht gefunden.');
        }

            // Leite den Benutzer zu einer anderen Seite weiter oder zeige eine Meldung an
        // return redirect()->route('route_name');
    }

    public function registerLastStepHandler(Request $request)
    {
    // Get the seller using the token from the password_reset_tokens table
    $sellerToken = DB::table('password_reset_tokens')->where('token', $request->token)->first();

    // Check if the token exists and is associated with a seller
    if ($sellerToken) {
        // Get the seller using the email associated with the token
        $seller = Seller::where('email', $sellerToken->email)->first();

        // Validate the request data after retrieving the seller
        $request->validate([
            'username' => ['required', 'min:5', 'max:50', new UniqueUsername(optional($seller)->id)],
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
        return redirect()->route('seller.register')->with('fail', 'Invalid token.');
    }

        // Get the seller using the token from the password_reset_tokens table
        $sellerToken = DB::table('password_reset_tokens')->where('token', $request->token)->first();

        // Check if the token exists and is associated with a seller
        if ($sellerToken) {
            // Get the seller using the email associated with the token
            $seller = Seller::where('email', $sellerToken->email)->first();

            // Check if the seller exists
            if ($seller) {
                // Update seller data
                $seller->update([
                    'username' => $request->username,
                    'password' => bcrypt($request->new_password),
                ]);

                // Delete the token from the password_reset_tokens table
                DB::table('password_reset_tokens')->where('token', $request->token)->delete();

                // Holen Sie den Eintrag aus der Tabelle ModSellerShops anhand der seller_id
                $modSellerShop = ModSellerShops::where('seller_id', $seller->id)->first();

                // Überprüfen Sie, ob der Eintrag gefunden wurde
                if ($modSellerShop) {
                    // Holen Sie den Shop anhand seiner ID
                    $shop = ModShop::find($modSellerShop->mod_shop_id);

                    // Überprüfen Sie, ob der Shop gefunden wurde
                    if ($shop) {
                        // Aktualisieren Sie den Fortschritt des Shops auf 10%
                        $shop->update(['progress' => 10]);

                        // Optional: Speichern Sie die Änderungen
                        $shop->save();
                    } else {
                        // Der Shop wurde nicht gefunden
                        // Fügen Sie hier den entsprechenden Fehlerhinweis hinzu
                    }
                } else {
                    // Der Eintrag in ModSellerShops wurde nicht gefunden
                    // Fügen Sie hier den entsprechenden Fehlerhinweis hinzu
                }



    // Überprüfen Sie, ob der Verkäufer gefunden wurde
    if ($seller) {
    // login url erzeugen fuer den verkaeufer
    $loginUrl = route('seller.dashboard');

    // Daten für die E-Mail-Vorlage zusammenstellen
    $data = [
        'seller' => $seller,
        'verificationUrl' => $loginUrl
    ];

    // E-Mail-Vorlage rendern
    $email_body = view('email-templates.registration-confirmation', $data)->render();

   // dd($email_body, $data, $seller, $loginUrl);


    // E-Mail-Konfiguration zusammenstellen
    $mailConfig = [
        'mail_from_email' => custom_env('MAIL_FROM_ADDRESS'),
        'mail_from_name' => custom_env('MAIL_FROM_NAME'),
        'mail_recipient_email' => $seller->email,
        'mail_recipient_name' => $seller->name,
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
    return "Seller not found.";
    }




    // Anmelden des Verkäufers nach der Registrierung

   // Auth::guard('seller')->login($seller);
    Auth::guard('seller')->login($seller, true, ['username' => $seller->username]);
    // Optional: Perform any additional actions here, such as redirecting or displaying a success message
     return redirect()->route('seller.dashboard')->with('success', 'Registration completed successfully.');
            } else {
                // Seller not found
                return redirect()->route('seller.register')->with('fail', 'Seller not found.');
            }
        } else {
            // Token not found
            return redirect()->route('seller.register')->with('fail', 'Invalid token.');
        }
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
        $seller = Seller::where('email', $request->email)->first();

        // Überprüfen Sie, ob der Verkäufer gefunden wurde
        if ($seller) {
            // Überprüfen Sie, ob der Verkäufer bereits verifiziert wurde
            if ($seller->email_verified_at) {



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
                    'guard' => constGuards::SELLER,
                    'token' => $token,
                    'created_at' => now(),
                ]);

                // Generieren Sie die URL für das Zurücksetzen des Passworts
                $resetUrl = route('seller.reset-password', ['token' => $token, 'email' => $request->email]);

                // Daten für die E-Mail-Vorlage zusammenstellen
                $data = [
                    'seller' => $seller,
                    'resetUrl' => $resetUrl
                ];

                // E-Mail-Vorlage rendern
                $email_body = view('email-templates.seller-password-reset-email-template', $data)->render();

                // E-Mail-Konfiguration zusammenstellen
                $mailConfig = [
                    'mail_from_email' => custom_env('MAIL_FROM_ADDRESS'),
                    'mail_from_name' => custom_env('MAIL_FROM_NAME'),
                    'mail_recipient_email' => $seller->email,
                    'mail_recipient_name' => $seller->name,
                    'mail_subject' => 'Password Reset',
                    'mail_body' => $email_body,
                ];

 //               dd($mailConfig);


                // E-Mail senden
                if(sendEmail($mailConfig)){
                    session()->flash('success', 'Success Password Reset link sent on your email');
                    return redirect()->route('seller.login');
                }else{
                    session()->flash('fail', 'Something went wrong');
                    return redirect()->route('seller.forgot-password');
                }

                // Jetzt können Sie die E-Mail senden oder andere Aktionen ausführen
            } else {
                // Der Verkäufer wurde nicht verifiziert
                return redirect()->route('seller.forgot-password')->with('fail', 'Your email is not verified. Please verify your email to reset your password.');
            }
        } else {
            // Der Verkäufer wurde nicht gefunden
            return redirect()->route('seller.forgot-password')->with('fail', 'Seller not found.');
        }
    } else {
        // Die E-Mail-Adresse ist nicht im Request enthalten
        return redirect()->route('seller.forgot-password')->with('fail', 'Email is required.');
    }
}

public function resetPassword(Request $request, $token = null)
{

    $check_token = DB::table('password_reset_tokens')
        ->where(['token' => $token, 'guard' => constGuards::SELLER])
        ->first();

    if ($check_token) {

        // check if token is not expired
        $diffMins = Carbon::createFromFormat('Y-m-d H:i:s', $check_token->created_at)->diffInMinutes(now());

        if ($diffMins > constDefaults::tokenExpiredMinutes) {
            session()->flash('fail', 'Token expired');
            return redirect()->route('seller.forgot-password', ['token' => $token]);
        }else{
            return view('backend.pages.seller.auth.reset-password')->with(['token' => $token]);
        }

        return view('backend.pages.seller.auth.reset-password', ['token' => $token, 'email' => $check_token->email]);
    } else {
        session()->flash('fail', 'Invalid token provided for password reset');
        return redirect()->route('seller.forgot-password');
    }
}


public function resetPasswordHandler(Request $request)
{
$request->validate([
    'new_password' => 'required|min:5|max:45|required_with:new_password_confirmation|same:new_password_confirmation',
    'new_password_confirmation' => 'required|min:5|max:45|same:new_password'
]);

$token = DB::table('password_reset_tokens')
    ->where(['token' => $request->token, 'guard' => constGuards::SELLER])
    ->first();

    // get seller details
    $seller = Seller::where('email', $token->email)->first();

    // update admin password
    Seller::where('email', $token->email)->update([
        'password' => Hash::make($request->new_password)
    ]);

    // delete token from password_resets table
    DB::table('password_reset_tokens')
        ->where(['token' => $request->token, 'guard' => constGuards::SELLER])
        ->delete();

    // send email to admin
    $data = array(
        'seller'=>$seller,
        'new_password' =>$request->new_password
    );

    $mail_body = view('email-templates.seller-reset-email-template', $data)->render();

    $mailConfig = array(
        'mail_from_email'=>env('MAIL_FROM_ADDRESS'),
        'mail_from_name'=>env('MAIL_FROM_NAME'),
        'mail_recipient_email'=>$seller->email,
        'mail_recipient_name'=>$seller->name,
        'mail_subject'=>'Your password has been changed',
        'mail_body'=>$mail_body

    );

    sendEmail($mailConfig);
    return redirect()->route('seller.login')->with('success', 'Done!, Password changed successfully. Use new password to login');


}

public function profileView(request $request)
{

    $seller = null;
    if (Auth::guard('seller')->check()) {
        // $seller = Auth::findOrFail(auth()->id()); // get seller details
        $seller = Seller::findOrFail(auth()->id()); // get seller details

    // $seller = Auth::user();
    }

                    // Löschen Sie die Shop-ID aus der Sitzung, wenn das Dashboard aufgerufen wird
                    Session::forget('currentShopId');
                    Session::forget('currentShopId');
                    Session::forget('currentShopTitle');

    return view('backend.pages.seller.settings.profile', ['seller' => $seller]);
}



public function changeProfilePicture(Request $request)
{

    $seller = Seller::findOrFail(auth('seller')->id());

    $path = 'uploads/images/user/sellers';
    $file = $request->file('sellerProfilePictureFile');
    $old_picture = $seller->picture; // direkter Zugriff auf das Bildattribut
    $file_path = public_path($path . '/' . $old_picture); // Pfad des alten Bildes
    $filename = 'SELLER_IMG_' . uniqid() . '.jpg'; // Neuer Dateiname
//    $filename = 'SELLER_IMG_' . uniqid() . '.' .$file->getClientOriginalExtension();

    // Überprüfen, ob eine Datei hochgeladen wurde
    if ($file) {
        // Das neue Bild hochladen
        $upload = $file->move(public_path($path), $filename);

        // Überprüfen, ob das Hochladen erfolgreich war
        if ($upload) {
            // Das alte Bild löschen, wenn es existiert
            if ($old_picture && File::exists($file_path)) {
                File::delete($file_path);
            }

            // Das neue Bild im Seller-Modell aktualisieren
            $seller->update(['picture' => $filename]);

            return response()->json(['status' => 1, 'msg' => 'Your profile picture has been successfully updated.']);
        }
    }

    // Rückgabe im Fehlerfall
    return response()->json(['status' => 0, 'msg' => 'Something went wrong']);
}



}
