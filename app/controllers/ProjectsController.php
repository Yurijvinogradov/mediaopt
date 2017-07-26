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
use common\models\Project as Project;

class ProjectsController extends BaseApiController
{

    public function getAll(Request $request, Response $response)
    {
        $projects = Project::all();
        if (is_array($projects)) {
            $result = $projects->toJson();
        } else {
            $result = json_encode(['Projects not found']);
        }

        return $this->ret($result, $response);
    }

    public function get(Request $request, Response $response)
    {
        $projectId = $request->getAttribute('id');
        $project = Project::where('id', $projectId)->first();
        if (!is_null($project)) {
            $result = $project->toJson();
        } else {
            $result = json_encode(['Project not found']);
        }

        return $this->ret($result, $response);
    }


    public function billableHours(Request $request, Response $response)
    {
        $projectId = $request->getAttribute('id');
        $project = Project::where('id', $projectId)->first();
        if (!is_null($project)) {
            $billableHours = $project->billableHours();
            $result = json_encode($billableHours);
        } else {
            $result = json_encode(['Project not found']);
        }
        return $this->ret($result, $response);
    }

    public function peakTimes(Request $request, Response $response)
    {

        $projectId = $request->getAttribute('id');
        $date = $request->getAttribute('date');
        $project = Project::where('id', $projectId)->first();
        if (!is_null($project)) {
            $peakTimes = $project->peakTimes($date);
            if (!is_array($peakTimes) || is_null($peakTimes[0])){
                $result = json_encode(['peakTimes not found']);
            }else{
                $result = json_encode($peakTimes);
            }

        } else {
            $result = json_encode(['Project not found']);
        }
        return $this->ret($result, $response);
    }
}