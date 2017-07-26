<?php
/**
 * Created by PhpStorm.
 * User: yav
 * Date: 25.07.17
 * Time: 13:53
 */


use common\models\UsersLogin as UsersLogin;


class s201707250920_UsersLogin
{
    function run()
    {

        $usersLogin = new UsersLogin();
        $usersLogin->userId = 1;
        $usersLogin->dt_login = "2017-07-23 02:07:12";
        $usersLogin->dt_logout = "2017-07-23 05:07:12";
        $usersLogin->save();
        unset($usersLogin);

        $usersLogin = new UsersLogin();
        $usersLogin->userId = 2;
        $usersLogin->dt_login = "2017-07-23 01:07:12";
        $usersLogin->dt_logout = "2017-07-23 02:17:12";
        $usersLogin->save();
        unset($usersLogin);

        $usersLogin = new UsersLogin();
        $usersLogin->userId = 4;
        $usersLogin->dt_login = "2017-07-23 02:08:12";
        $usersLogin->dt_logout = "2017-07-23 05:07:12";
        $usersLogin->save();
        unset($usersLogin);

        $usersLogin = new UsersLogin();
        $usersLogin->userId = 3;
        $usersLogin->dt_login = "2017-07-23 01:08:12";
        $usersLogin->dt_logout = "2017-07-23 02:17:12";
        $usersLogin->save();
        unset($usersLogin);

        $usersLogin = new UsersLogin();
        $usersLogin->userId = 5;
        $usersLogin->dt_login = "2017-07-23 03:07:12";
        $usersLogin->dt_logout = "2017-07-23 04:07:12";
        $usersLogin->save();
        unset($usersLogin);

        $usersLogin = new UsersLogin();
        $usersLogin->userId = 6;
        $usersLogin->dt_login = "2017-07-23 03:07:12";
        $usersLogin->dt_logout = "2017-07-23 04:07:12";
        $usersLogin->save();
        unset($usersLogin);

        $usersLogin = new UsersLogin();
        $usersLogin->userId =7;
        $usersLogin->dt_login = "2017-07-23 01:08:12";
        $usersLogin->dt_logout = "2017-07-23 12:07:12";
        $usersLogin->save();
        unset($usersLogin);


        $usersLogin = new UsersLogin();
        $usersLogin->userId = 7;
        $usersLogin->dt_login = "2017-07-23 03:08:12";
        $usersLogin->dt_logout = "2017-07-23 04:07:12";
        $usersLogin->save();
        unset($usersLogin);


        $usersLogin = new UsersLogin();
        $usersLogin->userId = 8;
        $usersLogin->dt_login = "2017-07-23 01:07:12";
        $usersLogin->dt_logout = "2017-07-23 12:07:12";
        $usersLogin->save();
        unset($usersLogin);

    }
}