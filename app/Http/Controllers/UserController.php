<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');

        $this->middleware('admin')->only( 'index', 'show');
    }

    public function index()
    {
        return User::all();
    }

    public function show(User $user)
    {
        //return $user->load('cart');
    }

    public function reservations(User $user) {
       /* if (!$user->cart) {
            $user->cart()->create([
                'wedding_date' => '2018-01-01'
            ]);
        }
        return $user->cart->reservations()->with('status', 'advert.category')->get();*/
    }

    public function update(Request $request, User $user)
    {
        $this->validate(request(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
        ]);

        $user->update([
                'name' => $request['name'],
                'email' => $request['email'],
            ]
        );

        return $user;
    }

    public function destroy(User $user)
    {
        /*$user->cart()->reservations()->delete();
        $user->cart()->delete();
        $user->delete();
        return response('Success', 200);*/
    }
}
