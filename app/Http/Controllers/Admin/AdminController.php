<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Auth;
use App\User;


class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        return view('dashboard.dashboard')->with(
            ['path' => __('admin.dashboard'),
                'msg' => __('admin.dashboard_msg', ['name' => Auth::guard('web')->user()->name]),
            ]);
    }

    public function api_doc()
    {
        return view('dashboard.api_doc');
    }
}
