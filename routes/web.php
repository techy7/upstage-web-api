<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');
Route::get('email-verify/{user}', 'UserController@verify');

Route::get('/image/{folder}/{width}/{height}/{img_name}', 'ImageController@crop');
Route::get('/image/{folder}/{img_name}', 'ImageController@full');

Route::prefix('/')->middleware(['auth'])->group(function () {
	Route::get('users', 'UserController@index'); 
	Route::get('users/new', 'UserController@create'); 
	Route::get('users/{user}', 'UserController@show'); 
	Route::get('users/{user}/edit', 'UserController@edit'); 
	Route::get('users/{user}/delete', 'UserController@delete'); 

	Route::get('plans', 'PlanController@index'); 
	Route::get('plans/new', 'PlanController@create'); 
	Route::get('plans/{plan}', 'PlanController@show'); 
	Route::get('plans/{plan}/edit', 'PlanController@edit'); 
	Route::get('plans/{plan}/delete', 'PlanController@delete'); 

	Route::get('listings', 'ListingController@index'); 
	Route::get('listings/new', 'ListingController@create'); 
	Route::get('listings/{listing}', 'ListingController@show'); 
	Route::get('listings/{listing}/edit', 'ListingController@edit'); 
	Route::get('listings/{listing}/delete', 'ListingController@delete'); 
});

// psuedo API for admin purposes so web auth session can be used
Route::prefix('/admin_api')->middleware(['auth'])->group(function () {
	Route::get('plans', 'PlanController@api_index'); 
	Route::get('plans/all', 'PlanController@all'); 
	Route::post('plans', 'PlanController@api_store'); 
	Route::get('plans/{plan}', 'PlanController@api_show'); 
	Route::put('plans/{plan}', 'PlanController@api_update'); 
	Route::delete('plans/{plan}', 'PlanController@api_destroy'); 

	Route::get('users', 'UserController@api_index'); 
	Route::get('users/all', 'UserController@all'); 
	Route::post('users', 'UserController@api_store'); 
	Route::get('users/{user}', 'UserController@api_show'); 
	Route::put('users/{user}', 'UserController@api_update'); 
	Route::delete('users/{user}', 'UserController@api_destroy'); 

	Route::get('listings', 'ListingController@api_index'); 
	Route::get('listings/all', 'ListingController@all'); 
	Route::post('listings', 'ListingController@api_store'); 
	Route::get('listings/{listing}', 'ListingController@api_show'); 
	Route::put('listings/{listing}', 'ListingController@api_update'); 
	Route::delete('listings/{listing}', 'ListingController@api_destroy'); 
});