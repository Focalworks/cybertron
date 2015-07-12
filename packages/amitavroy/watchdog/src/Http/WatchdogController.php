<?php

namespace Amitav\Watchdog\Http;

use App\Http\Controllers\Controller;

class WatchdogController extends Controller
{
    public function getWatchdogListing()
    {
        return view('watchdog::watchdog-listing');
    }
}
