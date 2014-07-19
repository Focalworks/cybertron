<?php
/**
 * Created by PhpStorm.
 * User: Amitav Roy
 * Date: 7/17/14
 * Time: 9:54 AM
 */

Route::get('user', 'UserController@handleLoginPage');
Route::post('do-login', 'UserController@handleUserAuthentication');

Route::get('done', function() {
        return "Done";
    });

/*this section is for authenticated users only*/
Route::group(array('before' => 'checkAuth'), function() {
        Route::get('user/logout', 'UserController@handleUserLogout');
        Route::get('user/dashboard', 'UserController@handleUserDashboard');

        Route::get('user/permission/list', 'PermissionController@handlePermissionListing');
    });

Route::filter('checkAuth', function() {
        /*if (!GlobalHelper::checkAuth())
            return Redirect::to('/');*/
    });