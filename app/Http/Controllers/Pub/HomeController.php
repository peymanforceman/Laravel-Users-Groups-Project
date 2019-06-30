<?php

namespace App\Http\Controllers\Pub;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Auth;
use App\User;

class HomeController extends Controller
{

    public function home_page()
    {
        if (!Auth::check()) {
            $admin_exist = User::first();
            if (!$admin_exist) {
                return view('auth.register');
            } else {
                return view('auth.login');
            }
        } else {
            return redirect()->route('admin');
        }
    }
}
