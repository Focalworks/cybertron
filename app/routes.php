<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return Redirect::to('user');
});

Route::get('file', function ()
{
//    $url = 'https://fbcdn-sphotos-a-a.akamaihd.net/hphotos-ak-xfa1/t1.0-9/580460_10151280295341065_746889994_n.jpg';
//    $url = 'http://localhost/office_cybertron/public/uploads/user_pic/user-picture-1.jpg';
//    $destination = 'uploads/user_pic/';
//    FileApi::uploadFromURL($url, $destination);
});