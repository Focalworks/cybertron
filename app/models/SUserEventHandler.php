<?php
/**
 * Created by PhpStorm.
 * User: Amitav Roy
 * Date: 7/29/14
 * Time: 9:29 AM
 */

class SUserEventHandler {
    /**
     * Handle user login events.
     */
    public function onTest($event)
    {
        Log::info('I was inside test' . print_r($event, true));
    }

    /**
     * Handle user logout events.
     */
    public function onBest($event)
    {
        Log::info('I was inside best' . print_r($event, true));
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  Illuminate\Events\Dispatcher  $events
     * @return array
     */
    public function subscribe($events)
    {
        $events->listen('suser.test', 'SUserEventHandler@onTest');

        $events->listen('suser.best', 'SUserEventHandler@onBest');
    }
}