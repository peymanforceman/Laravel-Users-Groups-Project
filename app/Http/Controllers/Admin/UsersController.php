<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Sgroup;
use App\Suser;
use Illuminate\Http\Request;
use Session;
use Auth;
use App\User;


class UsersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $gp = Sgroup::get();
        $users = Suser::with('groups')->get();
        return view('dashboard.users')->with(
            ['path' => __('admin.User Management'),
                'msg' => __('admin.User Management Message'),
                'users' => $users,
                'groups' => $gp,
            ]);
    }

    public function add_user(Request $request)
    {
        $this->validate($request, [
            'user_name' => 'required|string',
            'groups.*' => 'integer',
        ]);

        $new_usr = new Suser();
        $new_usr->name = $request->user_name;
        $new_usr->save();

        if ($request->groups != null) {
            $gp = Sgroup::get();
            foreach ($request->groups as $group_id) {

                $get_gp = $gp->where('id', $group_id)->first();
                if ($get_gp != null) {
                    $new_usr->groups()->save($get_gp);
                }
            }

        }

        return redirect()->back()->with('status', __('admin.User has been created successfully'));
    }

    public function edit_user($id, Request $request)
    {
        $gp = Sgroup::get();
        $usr = Suser::where('id', $id)->with('groups')->first();
        if ($usr != null) {
            return view('dashboard.user_edit')->with(
                ['path' => __('admin.User Management'),
                    'msg' => __('admin.Edit User'),
                    'user' => $usr,
                    'groups' => $gp,
                ]);
        } else {
            return redirect()->back()->withErrors(__('admin.User not found'));
        }
    }

    public function update_user($id, Request $request)
    {

        $this->validate($request, [
            'user_name' => 'required|string',
            'groups.*' => 'integer',
        ]);

        $usr = Suser::with('groups')->where('id', $id)->first();

        if ($usr != null) {
            $usr->name = $request->user_name;
            $usr->save();

            $usr->groups()->detach();
            if ($request->groups != null) {
                $gp = Sgroup::get();
                foreach ($request->groups as $group_id) {

                    $get_gp = $gp->where('id', $group_id)->first();
                    if ($get_gp != null) {
                        $usr->groups()->save($get_gp);
                    }
                }
            }

            return redirect()->route('users')->with('status', __('admin.User has been updated successfully'));
        } else {
            return redirect()->back()->withErrors(__('admin.User not found'));
        }
    }

    public function remove_user($id, Request $request)
    {

        $usr = Suser::with('groups')->where('id', $id)->first();

        if ($usr != null) {
            if (!$usr->groups->isEmpty()) {
                // foreach remove groups then remove user .
                $usr->groups()->detach();
            }

            $usr->delete();
            return redirect()->back()->with('status', __('admin.User has been removed successfully'));
        } else {
            return redirect()->back()->withErrors(__('admin.User not found'));
        }


    }
}
