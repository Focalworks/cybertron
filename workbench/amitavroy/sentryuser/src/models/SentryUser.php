<?php

/**
 * Created by PhpStorm.
 * User: Amitav Roy
 * Date: 7/17/14
 * Time: 11:21 AM
 */
class SentryUser extends Eloquent
{

    /**
     * This function is login the user in by taking the username and password.
     * 
     * @param unknown $username            
     * @param unknown $password            
     * @return boolean
     */
    public function authenticateUser($username, $password)
    {
        try {
            // Authenticate the user
            $credentials = array(
                'email' => $username,
                'password' => $password
            );
            
            $user = Sentry::authenticate($credentials, false);
            $userObj = UserHelper::getUserObj($user->id);
            Session::put('userObj', $userObj);
            
            return true;
        } catch (Cartalyst\Sentry\Users\LoginRequiredException $e) {
            GlobalHelper::setMessage('Login field is required.', 'warning');
        } catch (Cartalyst\Sentry\Users\PasswordRequiredException $e) {
            GlobalHelper::setMessage('Password field is required.', 'warning');
        } catch (Cartalyst\Sentry\Users\WrongPasswordException $e) {
            GlobalHelper::setMessage('Wrong password, try again.', 'warning');
        } catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {
            GlobalHelper::setMessage('User was not found.', 'warning');
        } catch (Cartalyst\Sentry\Users\UserNotActivatedException $e) {
            GlobalHelper::setMessage('User is not activated.', 'warning');
        }        

        // The following is only required if the throttling is enabled
        catch (Cartalyst\Sentry\Throttling\UserSuspendedException $e) {
            GlobalHelper::setMessage('User is suspended.', 'warning');
        } catch (Cartalyst\Sentry\Throttling\UserBannedException $e) {
            GlobalHelper::setMessage('User is banned.', 'warning');
        }
    }

    /**
     * This function handles the post data and does the edit profile
     * 
     * @param unknown $postData            
     */
    public function editProfile($postData)
    {
        // flag to check if we need to change the password or not.
        $passwordChangeFlag = false;
        
        // checking if we need to change the password or not
        if ($postData['newPassword'] != '' && $postData['conf'] != '' && $postData['currentPassword'] != '')
        {
            if ($this->updateProfilePassword($postData['currentPassword'], $postData['newPassword'], $postData['conf']))
                $passwordChangeFlag = true;
        }
        
        // get the sentry user object
        $user = Sentry::findUserById(Sentry::getId());
        
        // set the password only if the flag is true
        if ($passwordChangeFlag == true)
            $user->password = $postData['conf'];
        
        $user->first_name = $postData['firstname'];
        $user->last_name = $postData['lastName'];
        
        if ($user->save())
        {
            GlobalHelper::setMessage('Your profile details were updated');
            return true;
        }
        else
        {
            GlobalHelper::setMessage('Your changes were not saved. Please try again', 'info');
            return false;
        }
    }
    
    /**
     * This function is checking if the current password is correct.
     * @param unknown $password
     * @return boolean
     */
    private function checkUserCurrentPassword($password)
    {
        if (Sentry::checkPassword($password))
            return true;
        else 
            return false;
    }
    
    /**
     * This is the logic for change password.
     * @param unknown $currentPass
     * @param unknown $newPass
     * @param unknown $confPass
     * @return boolean
     */
    private function updateProfilePassword($currentPass, $newPass, $confPass)
    {
        // although check in JS, still at PHP end checking if the two password match.
        if ($newPass != $confPass)
        {
            GlobalHelper::setMessage('The two password does not match.', 'info');
            return false;
        }
        
        // checking if the current password is correct or not.
        if (!$this->checkUserCurrentPassword($currentPass))
        {
            GlobalHelper::setMessage('Your current password does not match.', 'info');
            return false;
        }
        else
            return true;
    }
}