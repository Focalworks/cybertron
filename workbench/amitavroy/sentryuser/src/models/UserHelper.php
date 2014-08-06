<?php

class UserHelper extends Eloquent
{
    /**
     * Pass the user id to get the user object with the required details.
     *
     * @param unknown $user_id
     * @param bool    $extra
     *
     * @return unknown|boolean
     */
    public static function getUserObj($user_id, $extra = false)
    {
        $arrSelect = array(
            'users.id', 'users.email', 'users.first_name', 'users.last_name', 'users.created_at', 'users.updated_at',
            'user_details.user_profile_img'
        );
        
        $query = DB::table('users');
        
        if ($extra == false)
            $query->select($arrSelect);
        
        $query->join('user_details', 'user_details.user_id', '=', 'users.id');
        $query->where('users.activated', 1);
        $result = $query->first();
        
        if ($result != null)
            return $result;
        else 
            return false;
    }
    
    /**
     * Get the user profile picture
     */
    public static function getUserPicture()
    {
        if (Session::has('userObj'))
        {
            $userObj = Session::get('userObj');

            if ($userObj->user_profile_img != 0)
                return $userObj->user_profile_img;
            else
            {
                return Config::get('sentryuser::sentryuser.default-pic');
            }
        }
    }
    
    /**
     * 
     * @return string
     */
    public static function getUserDisplayName()
    {
        if (Session::has('userObj'))
        {
            $userObj = Session::get('userObj');
            return $userObj->first_name . ' ' . $userObj->last_name;
        }
    }
}