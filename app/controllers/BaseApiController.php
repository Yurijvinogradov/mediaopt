<?php
/**
 * Created by PhpStorm.
 * User: yav
 * Date: 26.07.17
 * Time: 9:51
 */

namespace App\Controllers;


use Psr\Http\Message\ResponseInterface as Response;



class BaseApiController
{

    public function __construct()
    {

    }
    /**
     * @param Array $return
     */
    public function ret($return,Response $response){
        $response->withHeader(
            'Content-Type',
            'application/json'
        )->write($return);
        return $response;

    }
}