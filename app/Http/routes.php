<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
 */

Route::get('/', function () {
    return view('home');
});

// User related pages
Route::get('user', 'UserController@getLoginPage');
Route::post('user/do-login', 'UserController@doLogin');
Route::get('user/dashboard', 'UserController@getUserDashboard');
Route::get('user/change-password', 'UserController@getChangeUserPassword');
Route::post('user/save-new-password', 'UserController@saveNewPassword');
Route::get('user/logout', 'UserController@getUserLogout');
