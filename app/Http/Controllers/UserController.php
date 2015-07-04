<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    // this is the login page
    public function getLoginPage()
    {
        return view('user.user-login');
    }

    // doing the login action
    public function doLogin(Request $request)
    {
        $credentials = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];

        if (!Auth::attempt($credentials)) {
            // if the user credentials are not correct we
            // will redirect user to the login page with
            // message that the credentials were wrong
            Session::flash('flash_error', 'Something went wrong with the username and / or password');
            return redirect('user');
        }

        Session::flash('flash_message', 'You have logged in successfully');
        return redirect('admin/user/dashboard');

        dd('failed');
    }
}
