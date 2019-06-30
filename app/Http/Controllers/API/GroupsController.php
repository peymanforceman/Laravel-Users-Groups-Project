<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Sgroup;
use Illuminate\Http\Request;
use Session;
use Auth;
use App\User;
use App\Suser;
use Validator;

class GroupsController extends Controller
{
    public $successStatus = 200;

    public function index(Request $request)
    {
        // select available groups if exist and return to view
        $groups = Sgroup::paginate(50);

        return response()->json([
            'success' => 1,
            'response' => $groups
        ]);
    }

    public function add_group(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'group_name' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err' => 1,
                'msg' => __('admin.Wrong Parameters')
            ]);
        }

        $new_group = new Sgroup();
        $new_group->name = $request->group_name;
        $new_group->save();

        return response()->json([
            'success' => 1,
            'response' => $new_group
        ]);
    }

    public function edit_group($id, Request $request)
    {
        $gp = Sgroup::where('id', $id)->first();
        if ($gp != null) {
            return response()->json([
                'success' => 1,
                'response' => $gp
            ]);
        } else {
            return response()->json([
                'err' => 1,
                'msg' => __('admin.Group not found')
            ]);
        }
    }

    public function update_group($id, Request $request)
    {

        $validator = Validator::make($request->all(), [
            'group_name' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err' => 1,
                'msg' => __('admin.Wrong Parameters')
            ]);
        }

        $gp = Sgroup::where('id', $id)->first();

        if ($gp != null) {
            $gp->name = $request->group_name;
            $gp->save();

            return response()->json([
                'success' => 1,
                'response' => $gp
            ]);
        } else {
            return response()->json([
                'err' => 2,
                'msg' => __('admin.Group not found')
            ]);
        }
    }

    public function remove_group($id, Request $request)
    {

        $gp = Sgroup::with('users')->where('id', $id)->first();

        // if group has no user member , then we can remove it otherwise return an error
        if ($gp != null) {
            if ($gp->users->isEmpty()) {
                $gp->delete();

                return response()->json([
                    'success' => 1,
                    'msg' => __('admin.Group has been removed successfully')
                ]);

            } else {
                return response()->json([
                    'err' => 2,
                    'msg' => __('admin.group is not empty err')
                ]);
            }
        } else {
            return response()->json([
                'err' => 1,
                'msg' => __('admin.Group not found')
            ]);
        }


    }

    public function group_users($id, Request $request)
    {
        $gp = Sgroup::where('id', $id)->first();

        // if group exist
        if ($gp != null) {
            $users = Suser::whereHas('groups', function ($q) use ($id) {
                $q->where('sgroup_id', $id);
            })->with('groups')->paginate(10);

            return response()->json([
                'success' => 1,
                'response' => $users
            ]);
        } else {
            return response()->json([
                'err' => 1,
                'msg' => __('admin.Group not found')
            ]);
        }

    }

}
