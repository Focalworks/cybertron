<?php
/**
 * Created by PhpStorm.
 * User: Amitav Roy
 * Date: 7/29/14
 * Time: 11:43 AM
 */

class SentryuserEventHandler {

    public function onUserLogin($event)
    {
        Log::info('I was here while login');
    }

    public function subscribe($events)
    {
        $events->listen('sentryuser.login', 'SentryuserEventHandler@onUserLogin');
    }
}