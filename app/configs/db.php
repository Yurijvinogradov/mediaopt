<?php
/**
 * Created by PhpStorm.
 * User: yav
 * Date: 25.07.17
 * Time: 12:17
 */

use Illuminate\Database\Capsule\Manager as Capsule;
/**
 * Configure the database and boot Eloquent
 */

$capsule = new Capsule;
$capsule->addConnection(array(
    'driver'   => 'sqlite',
    'database' => dirname(__DIR__,1).'/db/database.sqlite',
    'prefix'   => '',
));

$capsule->setAsGlobal();
$capsule->bootEloquent();
date_default_timezone_set('UTC');