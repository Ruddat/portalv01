<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use constGuards;
use constDefaults;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use App\Models\GeneralSettings;


class AdminController extends Controller
{
    //

    public function loginHandler(Request $request)
    {

        $fieldType = filter_var($request->login_id, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if ($fieldType == 'email') {
            $request->validate([
                'login_id' => 'required|email|exists:admins,email',
                'password' => 'required|min:5|max:45'
            ],[
                'login_id.required' => 'Email or Username ist required',
                'login_id.email' => 'Invalid email adress',
                'login_id.exists' => 'This email is not exists',
                'password.required' => 'Password is required',
            ]);

        }else{
            $request->validate([
                'login_id' => 'required|exists:admins,username',
                'password' => 'required|min:5|max:45'
            ],[
                'login_id.required' => 'Email or Username ist required',
                'login_id.exists' => 'This username is not exists',
                'password.required' => 'Password is required',
            ]);
        }

        $creds = array(
            $fieldType => $request->login_id,
            'password' => $request->password
        );

        if(Auth::guard('admin')->attempt($creds)){
            return redirect()->route('admin.home');

        }else{
            session()->flash('fail', 'Invalid credentials');
            return redirect()->route('admin.login');
        }


     //   return redirect()->route('admin.login')->with('error', 'Invalid credentials');
    }

    public function logoutHandler(Request $request)
    {
        Auth::guard('admin')->logout();
        session()->flash('fail', 'You are logged out!');
        return redirect()->route('admin.login');
    }

    public function sendPasswordResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:admins,email'
        ],[
            'email.required' => 'The :attribute is required',
            'email.email' => 'Invalid email adress',
            'email.exists' => 'The :attribute is not exists',
        ]);



        // get admin details
        $admin = Admin::where('email', $request->email)->first();

        // generate token
        //$token = base64_decode((Str::random(64)));
       // $token = Str::hash(microtime().Str::random(40));
       $token = Str::random(40);


        // check if the token is already exists in password_resets table
        $oldToken = DB::table('password_reset_tokens')
            ->where(['email' => $request->email, 'guard' => constGuards::ADMIN])
            ->first();

        if ($oldToken) {

            $encodedToken = base64_encode($token);

        // Update token in password_resets table
        DB::table('password_reset_tokens')
            ->where(['email' => $request->email, 'guard' => constGuards::ADMIN])
            ->update([
            'token' => $token,
            'created_at' => now(),
        ]);

    } else {

        $encodedToken = base64_encode($token);

        // Speichere das Base64-codierte Token in der Datenbank
        DB::table('password_reset_tokens')->insert([
            'email' => $request->email,
            'guard' => constGuards::ADMIN,
            'token' => $token,
            'created_at' => now(),
        ]);
    }


        // send email to user
        $actionLink = route('admin.reset-password', ['token'=>$token, 'email'=>$request->email]);

        $data = array(
            'admin'=>$admin,
            'actionLink'=>$actionLink
        );

        $email_body = view('email-templates.admin-forgot-email-template', $data)->render();

        $mailConfig = array(
            'mail_from_email'=>env('MAIL_FROM_ADDRESS'),
            'mail_from_name'=>env('MAIL_FROM_NAME'),
            'mail_recipient_email'=>$admin->email,
            'mail_recipient_name'=>$admin->name,
            'mail_subject'=>'Reset your password',
            'mail_body'=>$email_body

        );

        if(sendEmail($mailConfig)){
            session()->flash('success', 'Password reset link sent on your email');
            return redirect()->route('admin.forgot-password');

    }else{
        session()->flash('fail', 'Something went wrong');
        return redirect()->route('admin.forgot-password');
    }

    }

    public function resetPassword(Request $request, $token = null)
    {

        $check_token = DB::table('password_reset_tokens')
            ->where(['token' => $token, 'guard' => constGuards::ADMIN])
            ->first();

        if ($check_token) {

            // check if token is not expired
            $diffMins = Carbon::createFromFormat('Y-m-d H:i:s', $check_token->created_at)->diffInMinutes(now());

            if ($diffMins > constDefaults::tokenExpiredMinutes) {
                session()->flash('fail', 'Token expired');
                return redirect()->route('admin.forgot-password', ['token' => $token]);
            }else{
                return view('backend.pages.admin.auth.reset-password')->with(['token' => $token]);
            }

            return view('backend.pages.admin.auth.reset-password', ['token' => $token, 'email' => $check_token->email]);
        } else {
            session()->flash('fail', 'Invalid token');
            return redirect()->route('admin.forgot-password');
        }
    }



    
    public function resetPasswordHandler(Request $request)
    {
    $request->validate([
        'new_password' => 'required|min:5|max:45|required_with:new_password_confirmation|same:new_password_confirmation',
        'new_password_confirmation' => 'required|min:5|max:45|same:new_password'
    ]);

    $token = DB::table('password_reset_tokens')
        ->where(['token' => $request->token, 'guard' => constGuards::ADMIN])
        ->first();

        // get admin details
        $admin = Admin::where('email', $token->email)->first();

        // update admin password
        Admin::where('email', $token->email)->update([
            'password' => Hash::make($request->new_password)
        ]);

        // delete token from password_resets table
        DB::table('password_reset_tokens')
            ->where(['token' => $request->token, 'guard' => constGuards::ADMIN])
            ->delete();

        // send email to admin
        $data = array(
            'admin'=>$admin,
            'new_password' =>$request->new_password
        );

        $mail_body = view('email-templates.admin-reset-email-template', $data)->render();

        $mailConfig = array(
            'mail_from_email'=>env('MAIL_FROM_ADDRESS'),
            'mail_from_name'=>env('MAIL_FROM_NAME'),
            'mail_recipient_email'=>$admin->email,
            'mail_recipient_name'=>$admin->name,
            'mail_subject'=>'Your password has been changed',
            'mail_body'=>$mail_body

        );

        sendEmail($mailConfig);
        return redirect()->route('admin.login')->with('success', 'Done!, Password changed successfully. Use new password to login');


    }


    public function profileView(request $request)
    {

        $admin = null;
        if (Auth::guard('admin')->check()) {
         //   $admin = Auth::findOrFail(auth()->id()); // get admin details
         $admin = Auth::user();
        }

        return view('backend.pages.admin.profile', ['admin' => $admin]);
    }


    public function changeProfilePicture(Request $request)
    {
        $admin = Admin::findOrFail(auth('admin')->id());
        $path = 'images/users/admins';
        $file = $request->file('adminProfilePictureFile');
        $old_picture = $admin->getAttributes()['picture'];
        $file_path = $path.$old_picture;
        $filename = 'ADMIN_IMG_' . rand(2, 1000) . $admin->id . time() . uniqid() . '.jpg';

        $upload = $file->move(public_path($path), $filename);



        if ($upload) {
            if ($old_picture != null && File::exists(public_path($path . $old_picture))) {
                File::delete(public_path($path.$old_picture));
            }
            $admin->update(['picture' => $filename]);
            return response()->json(['status' => 1, 'msg' => 'Your profile picture has been successfully updated.']);
        } else {
            return response()->json(['status' => 0, 'msg' => 'Something went wrong']);
        }
    }

    public function changeLogo(Request $request)
    {

    //    dd('on site');

        // Überprüfen, ob eine Datei hochgeladen wurde
        if ($request->hasFile('site_logo')) {
            $path = 'images/site/';
            $file = $request->file('site_logo');

            // Eindeutigen Dateinamen generieren
            $filename = 'LOGO_IMG_' . uniqid() . '.' .$file->getClientOriginalExtension();

            // Datei verschieben und Überprüfen, ob der Vorgang erfolgreich war
            if ($file->move(public_path($path), $filename)) {
                // Wenn die Datei erfolgreich verschoben wurde, alte Datei löschen
                $settings = GeneralSettings::first();
                $old_logo = $settings->site_logo;
                if ($old_logo != null && File::exists(public_path($path . $old_logo))) {
                    File::delete(public_path($path . $old_logo));
                }

                // Datenbank aktualisieren
                $settings->site_logo = $filename;
                $settings->save();

                // Erfolgreiche Antwort zurückgeben
                return response()->json(['status' => 1, 'msg' => 'Your logo has been successfully updated.']);
            } else {
                // Fehlermeldung, wenn Datei nicht verschoben werden konnte
                return response()->json(['status' => 0, 'msg' => 'Failed to upload file.']);
            }
        } else {
            // Fehlermeldung, wenn keine Datei hochgeladen wurde
            return response()->json(['status' => 0, 'msg' => 'No file uploaded.']);
        }
    }

    public function changeFavicon(Request $request)
    {
        // Überprüfen, ob eine Datei hochgeladen wurde
        if ($request->hasFile('site_favicon')) {
            $path = 'images/site/';
            $file = $request->file('site_favicon');

            // Eindeutigen Dateinamen generieren
            $filename = 'FAVICON_IMG_' . uniqid() . '.' . $file->getClientOriginalExtension();

            // Datei verschieben und Überprüfen, ob der Vorgang erfolgreich war
            if ($file->move(public_path($path), $filename)) {
                // Wenn die Datei erfolgreich verschoben wurde, alte Datei löschen
                $settings = GeneralSettings::first();
                $old_favicon = $settings->site_favicon;
                if ($old_favicon != null && File::exists(public_path($path . $old_favicon))) {
                    File::delete(public_path($path . $old_favicon));
                }

                // Datenbank aktualisieren
                $settings->site_favicon = $filename;
                $settings->save();

                // Erfolgreiche Antwort zurückgeben
                return response()->json(['status' => 1, 'msg' => 'Your favicon has been successfully updated.']);
            } else {
                // Fehlermeldung, wenn Datei nicht verschoben werden konnte
                return response()->json(['status' => 0, 'msg' => 'Failed to upload file.']);
            }
        } else {
            // Fehlermeldung, wenn keine Datei hochgeladen wurde
            return response()->json(['status' => 0, 'msg' => 'No file uploaded.']);
        }
    }

}
