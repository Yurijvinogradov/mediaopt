<?php
namespace common\models;
/**
 * Created by PhpStorm.
 * User: yav
 * Date: 25.07.17
 * Time: 13:30
 */

use Illuminate\Database\Eloquent\Model as Eloquent;

class User extends Eloquent {

    protected $table = 'users';

    public $timestamps = false;

    public function logins()
    {
        return $this->hasMany('common\models\UsersLogin');
    }
    public function projects()
    {
        return $this->hasMany('common\models\ProjectsUser');
    }
}