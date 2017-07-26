<?php

/**
 * Created by PhpStorm.
 * User: yav
 * Date: 25.07.17
 * Time: 13:29
 */

use common\models\User;

class s201707250910_Users {
    function run()
    {
        for ($i=10;$i>0;$i--){
            $user = new User;
            $user->username = "Test".$i;
            $user->save();
            unset($user);

        }
    }
}