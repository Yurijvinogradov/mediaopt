<?php
namespace common\models;

/**
 * Created by PhpStorm.
 * User: yav
 * Date: 25.07.17
 * Time: 13:31
 */
use Illuminate\Database\Eloquent\Model as Eloquent;

class UsersLogin extends Eloquent
{

    protected $table = 'users_logins';

    public $timestamps = false;

}