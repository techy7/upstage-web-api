<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', 'Api\Auth\LoginController@index');
Route::post('/register', 'Api\Auth\RegisterController@index');
Route::post('/register/verify', 'Api\Auth\RegisterController@verify'); 
Route::post('/password/email', 'Api\Auth\ForgotPasswordController@index');
Route::post('/password/reset', 'Api\Auth\ResetPasswordController@index'); 
Route::post('/login/facebook', 'Api\Auth\SocialController@facebook');  

Route::middleware(['api'])->group(function () {
	Route::get('logout', 'Api\ProfileController@logout');

	Route::get('profile', 'Api\ProfileController@index');
	Route::post('profile', 'Api\ProfileController@update');
	Route::post('profile/avatar', 'Api\ProfileController@avatar');
	Route::post('logout', 'Api\ProfileController@logout');

	Route::get('listings', 'Api\ListingController@index');
	Route::post('listings', 'Api\ListingController@store');
	Route::get('listings/{listing}', 'Api\ListingController@show');
	Route::post('listings/{listing}', 'Api\ListingController@update');
	Route::delete('listings/{listing}', 'Api\ListingController@destroy');

	Route::get('listings/{listing}/items', 'Api\ItemController@index');
	Route::post('listings/{listing}/items', 'Api\ItemController@store'); 
	Route::get('listings/{listing}/items/{item}', 'Api\ItemController@show'); 
	Route::post('listings/{listing}/items/{item}', 'Api\ItemController@update');
	Route::delete('listings/{listing}/items/{item}', 'Api\ItemController@destroy');
});
