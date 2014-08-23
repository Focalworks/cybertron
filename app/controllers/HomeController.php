<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function showWelcome()
	{
		return View::make('hello');
	}

    public function getUserDumpCSV()
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
    }

}
