<?php

/**
 * Created by PhpStorm.
 * User: yav
 * Date: 25.07.17
 * Time: 14:24
 */
use common\models\User as User;
use common\models\Project as Project;
use common\models\ProjectsUser as ProjectsUser;

class s201707250940_ProjectsUser
{
    function run()
    {
        $projects = Project::all();
        $users = User::all();

        foreach ($projects as $project) {
            foreach ($users as $user){
                $projectsUser = new ProjectsUser();
                $projectsUser->projectId = $project->id;
                $projectsUser->userId = $user->id;
                $projectsUser->save();
                unset($projectsUser);
            }
            break;

        }
    }
}