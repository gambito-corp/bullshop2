<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use TCG\Voyager\Facades\Voyager;

class AuthController extends \TCG\Voyager\Http\Controllers\VoyagerAuthController
{
    public function login()
    {
        if ($this->guard()->user()) {
            return redirect()->route('voyager.dashboard');
        }
        return Voyager::view('voyager::login');
    }
    
    public function redirectTo()
    {
        dd('Hola Mundo');
        return config('voyager.user.redirect', route('voyager.dashboard'));
    }

}
