<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {        
        $user = Auth::user();

        if ($user->hasRole('supervisor')) {
            return to_route('payroll.index');
        } else if ($user->hasRole('staff')) {
            return to_route('employee.index');
        } else {
            Auth::logout();
            return to_route('auth.showLogin');
        }
    }
}
