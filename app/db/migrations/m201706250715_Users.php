<?php
/**
 * Created by PhpStorm.
 * User: yav
 * Date: 25.07.17
 * Time: 12:12
 */

use Illuminate\Database\Capsule\Manager as Capsule;

class m201706250715_Users {
    function run()
    {
        Capsule::schema()->dropIfExists('users');
        Capsule::schema()->create('users', function($table) {
            $table->increments('id');
            $table->string('userName');
        });
    }
}