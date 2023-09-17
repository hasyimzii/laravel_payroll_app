<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class WebRequest
{
    public static function validator($allRequest, $rules)
    {
        $validator = Validator::make($allRequest, $rules);

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $message) {
                Alert::toast($message, 'error');
            }
            return false;
        }
        return true;
    }
}