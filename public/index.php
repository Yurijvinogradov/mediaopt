<?php

use \Slim\App as App;

require '../app/vendor/autoload.php';

$settings = require '../app/configs/settings.php';
$app = new App($settings);
$container = $app->getContainer();
$container['upload_directory'] = __DIR__ . '/uploads';


$container['App\Controllers\UsersController'] = function () {
    return new \App\Controllers\UsersController();
};
$container['App\Controllers\ProjectsController'] = function () {
    return new \App\Controllers\ProjectsController();
};
$container['App\Controllers\UsersLoginsController'] = function () {
    return new \App\Controllers\UsersLoginsController();
};


$app->group('/api', function () use ($app) {
    $app->group('/v1', function () use ($app) {
        $app->group('/users', function () use ($app) {
            $app->get('', '\App\Controllers\UsersController:getAll');
            $app->get('/', '\App\Controllers\UsersController:getAll');
            $app->get('/{id:[0-9]+}', '\App\Controllers\UsersController:get');


        });
        $app->group('/projects', function () use ($app) {
            $app->get('', '\App\Controllers\ProjectsController:getAll');
            $app->get('/', '\App\Controllers\ProjectsController:getAll');
            $app->get('/{id:[0-9]+}', '\App\Controllers\ProjectsController:get');
            $app->get('/{id:[0-9]+}/billableHours', '\App\Controllers\ProjectsController:billableHours');
            $app->get('/{id:[0-9]+}/peakTimes/{date}', '\App\Controllers\ProjectsController:peakTimes');

        });
        $app->group('/userslogin', function () use ($app) {
            $app->get('', '\App\Controllers\UsersLoginsController:getAll');
            $app->get('/', '\App\Controllers\UsersLoginsController:getAll');
            $app->get('/{id:[0-9]+}', '\App\Controllers\UsersLoginsController:get');
            $app->post('', '\App\Controllers\UsersLoginsController:insertLogin');
            $app->post('/{id:[0-9]+}/csv', '\App\Controllers\UsersLoginsController:csv');

        });
    });

});


$app->run();