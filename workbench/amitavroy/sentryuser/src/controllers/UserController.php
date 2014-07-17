<?php
/**
 * Created by PhpStorm.
 * User: Amitav Roy
 * Date: 7/17/14
 * Time: 10:26 AM
 */

class UserController extends BaseController
{
    protected $layout = 'sentryuser::master';

    public function handleLoginPage()
    {
        $this->layout->menuSkip = true;
        $this->layout->content = View::make('sentryuser::login');
    }

    public function handleUserAuthentication()
    {
        $username = Input::get('email');
        $password = Input::get('password');

        $SentryUser = new SentryUser;
        if ($SentryUser->authenticateUser($username, $password))
        {
            GlobalHelper::setMessage('Login successful', 'success');
            return Redirect::to('user/dashboard');
        }

    }

    public function handleUserDashboard()
    {
        $this->layout->content = "asdffsdasdsadd";
    }

    public function handleUserLogout()
    {
        Sentry::logout();
        return Redirect::to('/');
    }
}