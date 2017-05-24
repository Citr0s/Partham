<?php namespace Partham\web\mappers;

use Partham\core\types\Deploy;
use Partham\web\types\DeployModel;

class DeployModelMapper
{

    public static function map(Deploy $deploy)
    {
        $deployModel = new DeployModel();
        $deployModel->appName = $deploy->app;

        $parsedRequest = json_decode($deploy->request, true);
        $deployModel->lastBuildDuration = strtotime($parsedRequest['finished_at']) - strtotime($parsedRequest['started_at']);
        $deployModel->lastDeployDuration = strtotime($deploy->endTime) - strtotime($deploy->startTime);
        $deployModel->lastDeployStatus = $deploy->status;

        return $deployModel;
    }
}