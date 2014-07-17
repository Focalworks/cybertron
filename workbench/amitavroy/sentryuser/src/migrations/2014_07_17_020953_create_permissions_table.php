<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::dropIfExists('permissions');

        Schema::create('permissions', function($table){
                $table->engine = 'InnoDB';
                $table->increments('permission_id');
                $table->string('permission_name', 100);
                $table->integer('group_id');
            });

        DB::table('permissions')->insert(array(
                'permission_name' => 'create users',
                'group_id' => 2,
            ));
        
        DB::table('permissions')->insert(array(
                'permission_name' => 'edit users',
                'group_id' => 2,
            ));
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::dropIfExists('permissions');
	}

}
