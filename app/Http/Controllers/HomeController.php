<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends Controller
{
    public function home()
    {        
        $user = Auth::user();

        if ($user->hasRole('supervisor')) {
            return to_route('user.index'); // TODO: ganti ke payroll
        } else if ($user->hasRole('staff')) {
            return to_route('employee.index');
        } else {
            Auth::logout();
            Alert::toast('Anda belum terautentifikasi!', 'error');
            return to_route('auth.showLogin');
        }
    }
}
