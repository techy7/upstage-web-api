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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/login', 'Api\Auth\LoginController@index');
Route::post('/register', 'Api\Auth\RegisterController@index'); 
Route::post('/password/email', 'Api\Auth\ForgotPasswordController@index');
Route::post('/password/reset', 'Api\Auth\ResetPasswordController@index'); 
Route::post('/login/facebook', 'Api\Auth\SocialController@facebook');  

Route::post('/v2/login/check_email', 'Api\Auth\RegisterController@check_email');
Route::post('/v2/login/check_code', 'Api\Auth\RegisterController@check_code');
Route::post('/v2/register', 'Api\Auth\RegisterController@registerv2');

Route::middleware(['api'])->group(function () {
	Route::post('/register/verify', 'Api\Auth\RegisterController@verify'); 
	Route::post('/register/verify/resend', 'Api\Auth\RegisterController@reverify'); 

	Route::get('logout', 'Api\ProfileController@logout');

	Route::get('profile', 'Api\ProfileController@index');
	Route::post('profile', 'Api\ProfileController@update');
	Route::post('profile/avatar', 'Api\ProfileController@avatar');
	Route::post('logout', 'Api\ProfileController@logout');

	Route::get('projects', 'Api\ListingController@index');
	Route::post('projects', 'Api\ListingController@store');
	Route::get('projects/{listing}', 'Api\ListingController@show');
	Route::post('projects/{listing}', 'Api\ListingController@update');
	Route::delete('projects/{listing}', 'Api\ListingController@destroy');

	Route::get('projects/{listing}/presentations', 'Api\ItemController@index');
	Route::post('projects/{listing}/presentations', 'Api\ItemController@store'); 
	Route::get('projects/{listing}/presentations/{item}', 'Api\ItemController@show'); 
	Route::post('projects/{listing}/presentations/{item}', 'Api\ItemController@update');
	Route::delete('projects/{listing}/presentations/{item}', 'Api\ItemController@destroy');

	Route::get('projects/{listing}/presentations/{item}/media-assets', 'Api\ItemController@layer_index');
	Route::post('projects/{listing}/presentations/{item}/media-assets', 'Api\ItemController@layer_store');
	Route::get('projects/{listing}/presentations/{item}/media-assets/{layer}', 'Api\ItemController@layer_show');
	Route::delete('projects/{listing}/presentations/{item}/media-assets/{layer}', 'Api\ItemController@layer_delete');

	Route::get('templates', 'Api\TemplateController@index');
	Route::get('templates/{template}', 'Api\TemplateController@show');

	Route::get('chats', 'Api\ChatController@index');
	Route::get('chats/{chat}', 'Api\ChatController@show');
	Route::get('chats/{chat}/messages', 'Api\ChatController@message_index');
	Route::post('chats/{chat}/messages', 'Api\ChatController@message_store');
	Route::post('chats/{chat}/seen', 'Api\ChatController@seen');
});
