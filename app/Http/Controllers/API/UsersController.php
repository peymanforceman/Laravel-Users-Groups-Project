<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Sgroup;
use App\Suser;
use Illuminate\Http\Request;
use Session;
use Auth;
use Validator;
use App\User;


class UsersController extends Controller
{
    public $successStatus = 200;

    public function index()
    {
        $users = Suser::with('groups')->paginate(20);
        return response()->json([
            'success' => 1,
            'response' => $users
        ]);
    }

    public function add_user(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_name' => 'required|string',
            'groups.*' => 'integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err' => 1,
                'msg' => __('admin.Wrong Parameters')
            ]);
        }

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

        return response()->json([
            'success' => 1,
            'response' => $new_usr
        ]);
    }

    public function edit_user($id, Request $request)
    {
        $usr = Suser::where('id', $id)->with('groups')->first();
        if ($usr != null) {
            return response()->json([
                'success' => 1,
                'response' => $usr
            ]);
        } else {
            return response()->json([
                'err' => 1,
                'msg' => __('admin.User not found')
            ]);
        }
    }

    public function update_user($id, Request $request)
    {

        $validator = Validator::make($request->all(), [
            'user_name' => 'required|string',
            'groups.*' => 'integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err' => 1,
                'msg' => __('admin.Wrong Parameters')
            ]);
        }

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

            return response()->json([
                'success' => 1,
                'response' => $usr
            ]);

        } else {
            return response()->json([
                'err' => 1,
                'msg' => __('admin.User not found')
            ]);
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

            return response()->json([
                'success' => 1,
                'msg' => __('admin.User has been removed successfully')
            ]);
        } else {
            return response()->json([
                'err' => 1,
                'msg' => __('admin.User not found')
            ]);
        }
    }
}
