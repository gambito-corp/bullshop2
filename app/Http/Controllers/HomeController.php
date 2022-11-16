<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use TCG\Voyager\Facades\Voyager;

class HomeController extends \TCG\Voyager\Http\Controllers\VoyagerController
{
    public function index()
    {
        return Voyager::view('home');
    }
    
    public function logout()
    {
        Auth::logout();
        
        return redirect()->route('voyager.login');
    }
    
    public function admin()
    {
        return Voyager::view('voyager::index');
    }
}
