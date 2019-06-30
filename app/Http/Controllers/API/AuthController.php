<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Sgroup;
use Illuminate\Http\Request;
use App\User;
use App\Suser;
use Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public $successStatus = 200;

    /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);

        $credentials = request(['email', 'password']);
        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            $tokenResult = $user->createToken('Personal Access Token' . $user->id);
            $token = $tokenResult->token;
            if ($request->remember_me) {
                $token->expires_at = Carbon::now()->addWeeks(52);
            } else {
                $token->expires_at = Carbon::now()->addWeeks(1);
            }

            $token->save();
            return response()->json([
                'access_token' => $tokenResult->accessToken,
                'token_type' => 'Bearer',
                'expires_at' => Carbon::parse(
                    $tokenResult->token->expires_at
                )->toDateTimeString()
            ]);

        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'success' => 1,
            'message' => 'Successfully logged out'
        ]);
    }


}
