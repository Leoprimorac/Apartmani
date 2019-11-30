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

//Apartments
Route::resource('apartments', 'ApartmentsController')->except('update','create', 'edit');
Route::post('apartments/{apartment}', 'ApartmentsController@update');
//Email sending

Route::post('apartmentEmail/', 'ApartmentsController@email');

//Prices
Route::resource('prices', 'PricesController')->except('update','create', 'edit');

Route::resource('calendars', 'CalendarController')->except('update','create', 'edit');
