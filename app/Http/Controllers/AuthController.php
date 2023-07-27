<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function admin (Request $request)
    {
        $credentials = $request->validate(
            [
                'username'     => 'required',
                'password'  => 'required',
            ],
            [
                'username.required'    => 'Please enter username',
                'password.required'          => 'Please enter password'
            ]
        );
        if (Auth::guard('admin')->attempt($credentials))
        {
            $request->session()->regenerate();
            
            return redirect()->route('admin-dashboard');

        }

        return back()->with('error', 'Invalid Username Or Password');
    }
    
    // Receiver Login Authenticating
    public function user (Request $request)
    {
        $credentials = $request->validate(
            [
                'username'      => 'required',
                'password'      => 'required',
            ],
            [
                'username.required'         => 'Please enter username',
                'password.required'         => 'Please enter password'
            ]
        );


        if (Auth::attempt($credentials))
        {
            $request->session()->regenerate();
            
            if (Auth::user()->role === 'receiver')
            {
                return redirect()->route('receiver-dashboard');
            }

            return redirect()->route('sender-dashboard');

        } 

        return back()->with('error', 'Invalid Username Or Password');
    }

    // Logging out the user
    public function logout (Request $request) {

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('user-login');

    }
}
