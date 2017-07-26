<?php
/**
 * Created by PhpStorm.
 * User: yav
 * Date: 26.07.17
 * Time: 10:04
 */

namespace App\Controllers;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use common\models\User as User;


class UsersController extends BaseApiController
{

    public function getAll(Request $request, Response $response)
    {
        $user = User::all();

        if (!is_null($user)){
            $result=$user->toJson();
        }else{
            $result=json_encode(['Users not found']);
        }

        return $this->ret($result,$response);
    }

    public function get(Request $request, Response $response)
    {
        $userId = $request->getAttribute('id');
        $user = User::where('id', $userId)->first();

        if (!is_null($user)){
            $result=$user->toJson();
        }else{
            $result=json_encode(['User not found']);
        }
        return $this->ret($result,$response);
    }

}