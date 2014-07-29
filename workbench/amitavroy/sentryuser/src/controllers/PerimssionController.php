<?php
use Illuminate\Support\Facades\Redirect;
/**
 * Created by PhpStorm.
 * User: Amitav Roy
 * Date: 7/19/14
 * Time: 4:09 PM
 */

class PermissionController extends BaseController
{
    protected $layout = 'sentryuser::master';

    public function handlePermissionListing()
    {
        Log::info('Before the event');
        $subscriber = new SUserEventHandler;

        Event::subscribe($subscriber);
        $user = array(1,2,4);
        Event::fire('suser.test', array($user));
        // creating the sentry permissin model instance
        $SentryPermission = new SentryPermission;

        // fetch the permission table data in array format
        $permissions = $SentryPermission->formatPermissionData();

        // get the groups data from groups table in array format
        $groups = $SentryPermission->getPermissionTableGroups();

        $this->layout->content = View::make('sentryuser::permissions.permission-list')
            ->with('groups', $groups)
            ->with('permissions', $permissions);
    }

    public function handlePermissionSave()
    {
        $subscriber = new SUserEventHandler;

        Event::subscribe($subscriber);
        $user = array(1,2,3);
        Event::fire('suser.best', array($user));

        $postData = Input::all();
        $SentryPermission = new SentryPermission;

        if ($SentryPermission->updatePermissionMapping($postData))
        {
            GlobalHelper::setMessage('Permissions have been updated.');
            return Redirect::to('user/permission/list');
        }
        else 
        {
            GlobalHelper::setMessage('Not updated because of some problems.', 'warning');
            return Redirect::to('user/permission/list');
        }
    }
    
    public function handlePermissionAdd()
    {
//         dd(Input::all());
        $SentryPermission = new SentryPermission;
        $SentryPermission->addPermission(Input::all());
        
        return Redirect::to('user/permission/list');
    }
}