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
    public function insertLogin(Request $request, Response $response){
        $json = $request->getBody();
        $data = json_decode($json, true);
        if (is_null($data) || (!isset($data['dt_login']) && !isset($data['dt_logout'])) || (!isset($data['id']))){
            $result=json_encode(['Empty data']);
            return $this->ret($result,$response);
        }
        $userId = $data['id'];
        $user = User::where('id', $userId)->first();

        if (is_null($user)){
            $result=json_encode(['User not found']);
            return $this->ret($result,$response);
        }

        $userLogins = new UsersLogin();
        $userLogins->userId = $userId;
        if (isset($data['dt_login']) && !isset($data['dt_logout'])) {
            $_userLogins = UsersLogin::where('userId', $userId)
                ->where('dt_logout',null)
                ->first();
            if (!is_null($_userLogins)){
                $result=json_encode(['User must logout before next login']);
                return $this->ret($result,$response);
            }else{
                $userLogins->dt_login = $data['dt_login'];
            }


        }elseif (isset($data['dt_logout']) && !isset($data['dt_login'])) {
            $_userLogins = UsersLogin::where('userId', $userId)
                ->where('dt_logout',null)
                ->whereNotNull('dt_login')
                ->first();
            if (!is_null($_userLogins)){
                $userLogins=$_userLogins;
                $userLogins->dt_logout = $data['dt_logout'];
            }else {
                $result=json_encode(['User must login before logout']);
                return $this->ret($result,$response);

            }
        }else{

        }
        try {
            $userLogins->save();
            $result=json_encode(['User login saved successfully']);
        }catch(Exception $e){
            $result=json_encode(['User login did not save-'.$e->getMessage()]);
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