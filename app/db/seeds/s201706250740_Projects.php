<?php

/**
 * Created by PhpStorm.
 * User: yav
 * Date: 25.07.17
 * Time: 13:44
 */

use common\models\Project as Project;

class s201706250740_Projects
{
    function run()
    {
        for ($i=3;$i>0;$i--){
            $project = new Project();
            $project->projectname = "Project-".$i;
            $project->save();
            unset($project);

        }
    }

}