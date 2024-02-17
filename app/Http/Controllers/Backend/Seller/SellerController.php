<?php

namespace App\Http\Controllers\Backend\Seller;

use constGuards;
use constDefaults;
use App\Models\Seller;
use App\Models\ModShop;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ModSellerShops;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use NominatimLaravel\Content\Nominatim;

class SellerController extends Controller
{
    //


    public function dashboard()
    {
        return view('backend.pages.seller.dashboard');
    }

    public function loginHandler(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (auth()->guard('seller')->attempt($credentials)) {
            return redirect()->route('seller.dashboard');
        }

        return redirect()->back()->with('error', 'Invalid credentials');
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

    // Überprüfe, ob das versteckte Formularfeld "bot_trap" nicht leer ist
    if ($request->filled('bot_trap')) {
        // Hier kannst du entsprechend reagieren, wenn das Formular von einem Roboter ausgefüllt wurde
        // Zum Beispiel kannst du eine Fehlermeldung zurückgeben oder die Registrierung verhindern
        return redirect()->back()->withInput()->withErrors(['bot_trap' => 'Das Formular wurde von einem Roboter ausgefüllt.']);
    }

    // shopnumber die unique ist
    $timestamp = now()->format('ymdHi');
    $randomNumber = mt_rand(10, 99);
    $uniqueShopNumber = sprintf('%s-%s', $timestamp, $randomNumber);
    $this->newShop['shop_nr'] = $uniqueShopNumber;
    $defaultPhone = '1234567890';

    // Extrahiere die Adresse aus der Anfrage
    $address = $request->input('address_register');
    $city = $request->input('city_register');
    $zip = $request->input('zip_register');


    // Baue die vollständige Adresse
    $userInput = "$address $zip $city";

    $url = "https://nominatim.openstreetmap.org/";
    $nominatim = new Nominatim($url);

    $search = $nominatim->newSearch();
    $search->query($userInput);

    $results = $nominatim->find($search);

    // Überprüfe, ob Koordinaten gefunden wurden
    if (!empty($results)) {
        // Nutze die Koordinaten des ersten Ergebnisses
        $latitude = $results[0]['lat'];
        $longitude = $results[0]['lon'];

    } else {
        // Hier kannst du entsprechend reagieren, wenn keine Koordinaten gefunden wurden
        // Zum Beispiel kannst du eine Fehlermeldung zurückgeben oder die Registrierung verhindern
        return redirect()->back()->withInput()->withErrors(['address_register' => 'Die Adresse konnte nicht gefunden werden.']);
    }

        $seller = Seller::create([
            'name' => $request->name_register,
            'email' => $request->email_register,
        //    'password' => bcrypt($request->password_register),
        //    'restaurant_name' => $request->restaurantname_register,
        //    'address' => $request->address_register,
        //    'city' => $request->city_register,
        //    'zip' => $request->zip_register,
        //    'country' => $request->country_register,
        ]);

        $seller->shops()->create([
            'shop_nr' => $this->newShop['shop_nr'],
            'title' => $request->restaurantname_register,
            'street' => $request->address_register,
            'city' => $request->city_register,
            'zip' => $request->zip_register,
            'phone' => $defaultPhone,
            'email' => $request->email_register,
            'lat' => $latitude,
            'lng' => $longitude,
            'ordering' => '100000',
            'published' => '0',
            'broker' => $request->name_register,
            'order_email' => $request->email_register,
            'progress' => '0',
            'status' => 'limited',
        ]);


        // Seller-Daten zusammenstellen
        $seller = [
            'name' => $request->input('name_register'),
            'email' => $request->input('email_register'),
            'restaurant_name' => $request->input('restaurantname_register'),
            'address' => $request->input('address_register'),
            'city' => $request->input('city_register'),
            'zip' => $request->input('zip_register'),
            'country' => $request->input('country_register'),
        // Füge weitere Felder hinzu, falls erforderlich
        ];


         // token in database is generated
         // get seller details
        $seller = Seller::where('email', $request->email_register)->first();

            // generate token
            // $token = base64_decode((Str::random(64)));
            // $token = Str::hash(microtime().Str::random(40));
        $token = Str::random(40);


            // check if the token is already exists in password_resets table
        $oldToken = DB::table('password_reset_tokens')
             ->where(['email' => $request->email_register, 'guard' => constGuards::SELLER])
             ->first();

         if ($oldToken) {

             $encodedToken = base64_encode($token);

         // Update token in password_resets table
         DB::table('password_reset_tokens')
             ->where(['email' => $request->email_register, 'guard' => constGuards::SELLER])
             ->update([
             'token' => $token,
             'created_at' => now(),
         ]);

     } else {

         $encodedToken = base64_encode($token);

         // Speichere das Base64-codierte Token in der Datenbank
         DB::table('password_reset_tokens')->insert([
             'email' => $request->email_register,
             'guard' => constGuards::SELLER,
             'token' => $token,
             'created_at' => now(),
         ]);
     }

       // dd($request->email_register, $token, $encodedToken);

        // Erzeuge die Verifizierungs-URL für den Verkäufer
        $verificationUrl = route('seller.verify-email', ['token' => $token, 'email' => $request->email_register]);

        // Daten für die E-Mail-Vorlage zusammenstellen
        $data = [
            'seller' => $seller,
            'verificationUrl' => $verificationUrl
                ];

        // E-Mail-Vorlage rendern
        $email_body = view('email-templates.seller-verification-email-template', $data)->render();



        // E-Mail-Konfiguration zusammenstellen
                $mailConfig = array(
                    'mail_from_email' => env('MAIL_FROM_ADDRESS'),
                    'mail_from_name' => env('MAIL_FROM_NAME'),
                    'mail_recipient_email'=>$request->email_register,
                    'mail_recipient_name'=>$request->name_register,
                    'mail_subject'=>'Email Verification',
                    'mail_body'=>$email_body

                );
//dd($data, $mailConfig);

                if(sendEmail($mailConfig)){
                    session()->flash('success', 'Your email has been verified.');
                    return view('backend.pages.seller.auth.email-verificaton', $data);
                //    return redirect()->route('admin.forgot-password');

            }else{
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

            // Lösche die nicht fertigen Shops aus der mod_shops-Tabelle, die diesem Seller zugeordnet sind
            $deletedShopsCount = ModShop::whereIn('id', $unfinishedShopIds)->delete();

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
            'username' => 'required|min:5|max:50|unique:sellers,username,'.optional($seller)->id,
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
        'mail_from_email' => env('MAIL_FROM_ADDRESS'),
        'mail_from_name' => env('MAIL_FROM_NAME'),
        'mail_recipient_email' => $seller->email,
        'mail_recipient_name' => $seller->name,
        'mail_subject' => 'Email Verification',
        'mail_body' => $email_body,
    ];

    // E-Mail senden
    if(sendEmail($mailConfig)){
        session()->flash('success', 'Password reset link sent on your email');
 //       return redirect()->route('admin.forgot-password');

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
                 Auth::guard('seller')->login($seller);
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




}
