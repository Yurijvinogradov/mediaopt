<?php
/**
 * Created by PhpStorm.
 * User: yav
 * Date: 25.07.17
 * Time: 13:37
 */

namespace common\models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class ProjectsUser extends Eloquent
{
    protected $table = 'projects_users';

    public $timestamps = false;

    public function projects()
    {
        return $this->hasMany('common\models\Project','id' ,'projectId');
    }

    public function user()
    {
        return $this->hasMany('common\models\User','id','userId');
    }
}