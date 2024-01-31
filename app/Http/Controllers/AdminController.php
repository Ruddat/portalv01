<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}
