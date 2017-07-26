<?php
/**
 * Created by PhpStorm.
 * User: yav
 * Date: 25.07.17
 * Time: 12:12
 */

use Illuminate\Database\Capsule\Manager as Capsule;

class m201706250720_ProjetsUsers
{
    function run()
    {
        Capsule::schema()->dropIfExists('projects_users');
        Capsule::schema()->create('projects_users', function ($table) {
            $table->increments('id');
            $table->integer('projectId');
            $table->integer('userId');
            $table->foreign('userId')
                ->references('id')->on('users')
                ->onDelete('cascade');
            $table->foreign('projectId')
                ->references('id')->on('projects')
                ->onDelete('cascade');
        });
    }
}