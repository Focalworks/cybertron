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
    $selectArr = array(
        'u.id', 'u.email', 'u.last_login', 'u.first_name', 'u.last_name'
    );

    $users = DB::table('users as u')
        ->select($selectArr)
        ->orderBy('u.id', 'desc')
        ->get();

    $dataCols = array('id', 'email', 'first_name', 'last_name', 'last_login');
    $headerCol = array('Id', 'Email', 'First name', 'Last name', 'Last login');
    $output = FileApi::dataToCSV($users, $headerCol, $dataCols);

    $headers = array(
        'Content-Type' => 'text/csv',
        'Content-Disposition' => 'attachment; filename="ExportFileName.csv"',
    );

    return Response::make(rtrim($output, "\n"), 200, $headers);
});