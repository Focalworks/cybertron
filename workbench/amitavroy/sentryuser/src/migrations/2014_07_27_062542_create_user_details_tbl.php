<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserDetailsTbl extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('user_details');
        
        Schema::create('user_details', function ($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('user_detail_id');
            $table->integer('user_id');
            $table->string('profile_image_url');
        });
        
        DB::table('user_details')->insert(array(
            'user_id' => 1,
            'profile_image_url' => 'https://lh5.googleusercontent.com/-Ir-XRK83A7Y/UbRVdmaRgOI/AAAAAAAACxs/cVo_HQxc6Ig/s442/179285_496786981064_3036812_n.jpg',
        ));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_details');
    }
}
