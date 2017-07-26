<?php

/**
 * Created by PhpStorm.
 * User: yav
 * Date: 25.07.17
 * Time: 13:25
 */

use Illuminate\Database\Capsule\Manager as Capsule;

class m201706250740_UsersLogins
{
    function run()
    {
        Capsule::schema()->dropIfExists('users_logins');
        Capsule::schema()->create('users_logins', function($table) {
            $table->increments('id');
            $table->integer('userId');
            $table->foreign('userId')
                ->references('id')->on('users')
                ->onDelete('cascade');
            $table->datetime('dt_login');
            $table->datetime('dt_logout');
        });
    }
}