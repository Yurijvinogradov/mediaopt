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
use common\models\UsersLogin as UsersLogin;
use common\models\User as User;

class UsersLoginsController extends BaseApiController
{

    public function getAll(Request $request, Response $response)
    {
        $userLogins = UsersLogin::all();

        if (!is_null($userLogins)){
            $result=$userLogins->toJson();
        }else{
            $result=json_encode(['UsersLogins not found']);
        }

        return $this->ret($result,$response);
    }

    public function get(Request $request, Response $response)
    {
        $userId = $request->getAttribute('id');
        $userLogins = UsersLogin::where('userId', $userId)->get();

        if (!is_null($userLogins)){
            $result=$userLogins->toJson();
        }else{
            $result=json_encode(['UserLogins not found']);
        }
        return $this->ret($result,$response);
    }
    public function csv(Request $request, Response $response)
    {
        $userId = $request->getAttribute('id');
        $user = User::where('id', $userId)->first();

        if (is_null($user)){
            $result=json_encode(['User not found']);
            return $this->ret($result,$response);
        }

        $uploadedFiles = $request->getUploadedFiles();

        if (count($uploadedFiles) == 0) {
            $result=json_encode(['File not found']);
            return $this->ret($result,$response);
        }
        $result = [];
        if (($handle = fopen($uploadedFiles['logs_csv']->file, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                if (count($data) !== 2) {
                    continue;
                } else {

                    $dt_start = $data[0];
                    $dt_end = $data[1];
                    if (strtotime($dt_end) >= strtotime($dt_start)) {
                        $usersLogin = new UsersLogin;
                        $usersLogin->userId = (int)$userId;
                        $usersLogin->dt_login = $dt_end;
                        $usersLogin->dt_logout = $dt_end;
                        try {

                        }catch(\Exception $exception){
                            $result [] = $exception->getMessage();
                        }
                        $usersLogin->save();
                        unset ($usersLogin);
                    }
                }
            }
            fclose($handle);
        }

        $result=json_encode($result);
        return $this->ret($result,$response);
    }

}