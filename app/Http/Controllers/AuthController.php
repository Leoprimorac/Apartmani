<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{

    public function register(Request $request) {

        $this->validate(request(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed'
        ]);

        $user = User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
            ]
        );


        return $user;
    }

    public function login(Request $request) {

        $this->validate(request(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6'
        ]);

        if (auth()->attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
            $user = auth()->user();
            $user->api_token = Str::random(60);
            $user->save();
            return $user;
        }

        return response()->json([
            'error' => 'Unauthenticated user',
            'code' => 401,
        ], 401);
    }

    public function logout(Request $request) {

        if (auth()->user()) {
            $user = auth()->user();
            $user->api_token = null;
            $user->save();

            return response()->json([
                'message' => 'Thank you for using our application',
            ], 200);
        }

        return response()->json([
            'error' => 'Unable to logout user',
            'code' => 401,
        ], 401);
    }

    public function getUser()
    {
        return Auth::guard('api')->user();
    }

}
