<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Watchdog extends Model {
	protected $table = 'watchdog';

	protected $fillable = ['message', 'level', 'variable', 'incident_time'];

	public $timestamps = false;
}
