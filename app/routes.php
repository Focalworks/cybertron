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

Route::group(array(
        'before' => 'checkAuth'
    ), function ()
    {
        // entity urls
        Route::get('user-dump-csv', 'HomeController@getUserDumpCSV');
    });