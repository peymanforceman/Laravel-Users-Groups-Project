<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Sgroup;
use Illuminate\Http\Request;
use Session;
use Auth;
use App\User;
use App\Suser;


class GroupsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        // select available groups if exist and return to view
        $groups = Sgroup::get();

        return view('dashboard.groups')->with(
            ['path' => __('admin.Group Management'),
                'msg' => __('admin.Group Management Message'),
                'groups' => $groups,
            ]);
    }

    public function add_group(Request $request)
    {
        $this->validate($request, [
            'group_name' => 'required|string',
        ]);

        $new_group = new Sgroup();
        $new_group->name = $request->group_name;
        $new_group->save();

        return redirect()->back()->with('status', __('admin.Group has been created successfully'));
    }

    public function edit_group($id, Request $request)
    {
        $gp = Sgroup::where('id', $id)->first();
        if ($gp != null) {
            return view('dashboard.group_edit')->with(
                ['path' => __('admin.Group Management'),
                    'msg' => __('admin.Edit Group'),
                    'group' => $gp,
                ]);
        } else {
            return redirect()->back()->withErrors(__('admin.Group not found'));
        }
    }

    public function update_group($id, Request $request)
    {

        $this->validate($request, [
            'group_name' => 'required|string',
        ]);

        $gp = Sgroup::where('id', $id)->first();

        if ($gp != null) {
            $gp->name = $request->group_name;
            $gp->save();
            return redirect()->route('groups')->with('status', __('admin.Group has been updated successfully'));
        } else {
            return redirect()->back()->withErrors(__('admin.Group not found'));
        }
    }

    public function remove_group($id, Request $request)
    {

        $gp = Sgroup::with('users')->where('id', $id)->first();

        // if group has no user member , then we can remove it otherwise return an error
        if ($gp != null) {
            if ($gp->users->isEmpty()) {
                $gp->delete();
                return redirect()->back()->with('status', __('admin.Group has been removed successfully'));

            } else {
                return redirect()->back()->withErrors(__('admin.group is not empty err'));
            }
        } else {
            return redirect()->back()->withErrors(__('admin.Group not found'));
        }


    }

    public function group_users($id, Request $request)
    {
        $users = Suser::whereHas('groups', function ($q) use ($id) {
            $q->where('sgroup_id', $id);
        })->with('groups')->get();
        return view('dashboard.group_users')->with(
            ['path' => __('admin.Group Users'),
                'msg' => __('admin.User Management Message'),
                'users' => $users,
            ]);
    }

}
