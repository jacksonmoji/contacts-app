<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/contacts/store','ContactController@store');
Route::delete('/contacts/{id}', 'ContactController@destroy');
Route::put('/contacts/edit', 'ContactController@update');
Route::get('/contacts/index','ContactController@getContacts');
Route::get('/contacts/{id}', 'ContactController@show');

Route::put('/profile/edit', 'ProfileController@update');
Route::get('/profile', 'ProfileController@show');
Route::delete('/profile/{id}', 'ProfileController@destroy');
