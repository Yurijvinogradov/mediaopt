<?php

namespace common\models;

/**
 * Created by PhpStorm.
 * User: yav
 * Date: 25.07.17
 * Time: 13:31
 */
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Capsule\Manager as Capsule;

class Project extends Eloquent
{

    protected $table = 'projects';

    public $timestamps = false;

    public function users()
    {
        return $this->hasMany('common\models\ProjectsUser', 'projectId', 'id');
    }

    public function billableHours()
    {
        $sql = <<<EOT

SELECT SUM((strftime('%s',dt1.dt_logout)-strftime('%s',dt1.dt_login))/3600) as hours
FROM projects_users AS pu
LEFT JOIN users_logins AS dt1 ON pu.userId = dt1.userId
WHERE pu.projectId=$this->id

EOT;
        $hours = Capsule::select($sql);
        if (is_array($hours)){
            return $hours;
        }
        return [];
    }

    public function peakTimes($date)
    {
        $sql = <<<EOT
        
SELECT count(dt2.userId)+1 as countWorkers, (
    case when max(dt2.dt_login) > dt1.dt_login 
    then max(dt2.dt_login) 
    else dt1.dt_login END) as period_start, 
    (
    case when min(dt2.dt_logout) < dt1.dt_logout 
    then min(dt2.dt_logout) 
    else dt1.dt_logout END) as period_end    


FROM projects_users AS pu
LEFT JOIN users_logins AS dt1 ON pu.userId = dt1.userId and (dt1.dt_login like "$date%" or dt1.dt_logout like "$date%")
LEFT JOIN users_logins AS dt2 ON dt1.id > dt2.id and (dt2.dt_login like "$date%" or dt2.dt_logout like "$date%")

WHERE (dt1.dt_login BETWEEN dt2.dt_login and dt2.dt_logout
or dt1.dt_logout  BETWEEN dt2.dt_login and dt2.dt_logout)
and pu.projectId = $this->id

GROUP BY dt2.userId
ORDER BY countWorkers DESC
LIMIT 1

EOT;

        $peak = Capsule::select($sql);
        if (is_array($peak)){
            return array($peak[0]);
        }
        return [];


    }
}