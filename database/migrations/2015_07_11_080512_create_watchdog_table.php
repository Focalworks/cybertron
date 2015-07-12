<?php

use Illuminate\Database\Migrations\Migration;

class CreateWatchdogTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('watchdog', function ($table) {
			$table->increments('id')->comment('Unique identifier');
			$table->string('message')->comment('The message for the event');
			$table->string('level', 20)->comment('The event level');
			$table->text('variable')->comment('Context data in serialized format');
			$table->timestamp('incident_time')->comment('When the incident happened');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('watchdog');
	}
}
