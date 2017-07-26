<?php
/**
 * Created by PhpStorm.
 * User: yav
 * Date: 26.07.17
 * Time: 10:38
 */

return [
    'settings' => [
        'determineRouteBeforeAppMiddleware' => false,
        'displayErrorDetails' => true,

        'logger' => [
            'name' => 'ApiLog',
            'path' => __DIR__.'/../logs/app.log',
        ]
    ]
];