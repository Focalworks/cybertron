<?php

if (!function_exists('watchdog')) {
	function watchdog($message, $level = 'info', $variable = null) {
		$watchdog = new App\Watchdog;
		$watchdog->message = $message;
		$watchdog->level = $level;
		$watchdog->variable = ($variable) ? serialize($variable) : '';
		$watchdog->incident_time = Carbon\Carbon::now();
		$watchdog->save();
	}
}
