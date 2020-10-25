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

Route::get('/', 'WelcomeController@index');

Auth::routes(['register' => false]); 

Route::get('email-verify/{user}', 'UserController@verify');

Route::get('/image/{folder}/{width}/{height}/{img_name}', 'ImageController@crop');
Route::get('/image/{folder}/{img_name}', 'ImageController@full');
Route::get('/image/{folder}/{img_name}/download', 'ImageController@download');
Route::get('/video/{folder}/{filename}', 'VideoController@show');
Route::get('/video/{folder}/{filename}/watch', 'VideoController@watch');
Route::get('/video/{folder}/{filename}/download', 'VideoController@download');
Route::get('/user/{slug}', 'UserController@profile_public');
Route::get('/user/{slug}/{list}', 'UserController@profile_listing');

Route::prefix('/')->middleware(['auth', 'isNotUser'])->group(function () {
	Route::get('/apidocs', 'HomeController@apidocs');
	// function(){
	// 	return view('apidocs.index');
	// });

	Route::get('/home', 'HomeController@index')->name('home');

	Route::get('users', 'UserController@index'); 
	Route::get('users/new', 'UserController@create'); 
	Route::get('users/{user}', 'UserController@show'); 
	Route::get('users/{user}/edit', 'UserController@edit'); 
	Route::get('users/{user}/delete', 'UserController@delete'); 

	Route::get('editors', 'EditorController@index'); 
	Route::get('editors/new', 'EditorController@create'); 
	Route::get('editors/{editor}', 'EditorController@show'); 
	Route::get('editors/{editor}/edit', 'EditorController@edit'); 
	Route::get('editors/{editor}/delete', 'EditorController@delete'); 

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

	Route::get('listings/{listing}/items/new', 'ItemController@create'); 
	Route::get('listings/{listing}/items/{item}', 'ItemController@show'); 
	Route::get('listings/{listing}/items/{item}/edit', 'ItemController@edit'); 
	Route::get('listings/{listing}/items/{item}/delete', 'ItemController@delete'); 

	Route::get('notifications', 'NotificationController@notifications');
	Route::get('notifications/unread', 'NotificationController@unreadnotifications');
	Route::get('notifications/all', 'NotificationController@allnotifications');
	Route::get('notifications/index', 'NotificationController@indexnotifications');
});

// psuedo API for admin purposes so web auth session can be used
Route::prefix('/admin_api')->middleware(['auth', 'isNotUser'])->group(function () {
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

	Route::get('editors', 'EditorController@api_index'); 
	Route::get('editors/all', 'EditorController@all'); 
	Route::post('editors', 'EditorController@api_store'); 
	Route::get('editors/{user}', 'EditorController@api_show'); 
	Route::put('editors/{user}', 'EditorController@api_update'); 
	Route::delete('editors/{user}', 'EditorController@api_destroy'); 

	Route::get('listings', 'ListingController@api_index'); 
	Route::get('listings/all', 'ListingController@all'); 
	Route::post('listings', 'ListingController@api_store'); 
	Route::get('listings/{listing}', 'ListingController@api_show'); 
	Route::put('listings/{listing}', 'ListingController@api_update'); 
	Route::delete('listings/{listing}', 'ListingController@api_destroy'); 

	Route::post('listings/{listing}/items', 'ItemController@api_store'); 
	Route::post('listings/{listing}/items/{item}', 'ItemController@api_update'); 
	Route::delete('listings/{listing}/items/{item}', 'ItemController@api_destroy'); 
	Route::post('listings/{listing}/items/{item}/edited', 'ItemController@api_store_edited'); 
});