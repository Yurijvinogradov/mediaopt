<?php
/**
 * Created by PhpStorm.
 * User: yav
 * Date: 25.07.17
 * Time: 12:12
 */

use Illuminate\Database\Capsule\Manager as Capsule;

class m201706250717_Projets {
    function run()
    {
        Capsule::schema()->dropIfExists('projects');
        Capsule::schema()->create('projects', function($table) {
            $table->increments('id');
            $table->string('projectName');
        });
    }
}