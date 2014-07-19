<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDefaultUsers extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $user = Sentry::createUser(array(
                'email'     => 'amitavroy@gmail.com',
                'password'  => 'test1234',
                'activated' => true,
                'first_name' => 'Amitav',
                'last_name' => 'Roy'
            ));

        $group = Sentry::createGroup(array(
                'name' => 'Super Admin',
                'permissions' => array(
                    'create users' => 1,
                    'edit users' => 1,
                    'delete users' => 1,
                ),
            ));

        $group = Sentry::createGroup(array(
                'name' => 'Administrator',
                'permissions' => array(
                    'create users' => 1,
                    'edit users' => 1,
                ),
            ));

        $adminGroup = Sentry::findGroupById(1);

        $user->addGroup($adminGroup);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }

}
