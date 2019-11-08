<?php

use Illuminate\Http\Request;

// Auth
Route::post('login', 'AuthController@login');
Route::post('register', 'AuthController@register');
Route::middleware('auth:api')->post('logout', 'AuthController@logout');
Route::middleware('auth:api')->get('/users/logged', 'AuthController@getUser');


// Users
Route::get('users/{user}/reservations', 'UserController@reservations');
Route::resource('users', 'UserController')->except('update', 'create', 'edit', 'store');
Route::post('users/{user}', 'UserController@update');
