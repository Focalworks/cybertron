<?php
/**
 * Created by PhpStorm.
 * User: Amitav Roy
 * Date: 7/17/14
 * Time: 11:21 AM
 */

class SentryUser extends Eloquent
{
    public function authenticateUser($username, $password)
    {
        try
        {
            // Authenticate the user
            $credentials = array(
                'email' => $username,
                'password' => $password
            );

            $user = Sentry::authenticate($credentials, false);
            $userObj = UserHelper::getUserObj($user->id);
            Session::put('userObj', $userObj);

            return true;
        }
        catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
        {
            GlobalHelper::setMessage('Login field is required.', 'warning');
        } catch (Cartalyst\Sentry\Users\PasswordRequiredException $e)
        {
            GlobalHelper::setMessage('Password field is required.', 'warning');
        } catch (Cartalyst\Sentry\Users\WrongPasswordException $e)
        {
            GlobalHelper::setMessage('Wrong password, try again.', 'warning');
        } catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
        {
            GlobalHelper::setMessage('User was not found.', 'warning');
        } catch (Cartalyst\Sentry\Users\UserNotActivatedException $e)
        {
            GlobalHelper::setMessage('User is not activated.', 'warning');
        }

            // The following is only required if the throttling is enabled
        catch (Cartalyst\Sentry\Throttling\UserSuspendedException $e)
        {
            GlobalHelper::setMessage('User is suspended.', 'warning');
        } catch (Cartalyst\Sentry\Throttling\UserBannedException $e)
        {
            GlobalHelper::setMessage('User is banned.', 'warning');
        }
    }
}