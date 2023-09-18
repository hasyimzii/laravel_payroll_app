<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }
    
    public function login(Request $request)
    {
        $validated = WebRequest::validator($request->all(), [
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);
        if (!$validated) return back();

        $remember = ($request->remember) ? true : false;
 
        if (Auth::attempt($request->only('username', 'password'), $remember)) {
            $request->session()->regenerate();

            Alert::toast('Selamat datang di dashboard, '. Auth::user()->name .'!', 'success');
            return to_route('home');
        }
        
        Alert::toast('Email atau password salah!', 'error');
        return back();
    }

    public function logout()
    {
        if (Auth::check()) {
            Auth::logout();
            return to_route('home');
        }
        return back();
    }
}
