<?php namespace Partham\core\mappers;

use Partham\core\types\Deploy;
use Partham\core\types\DeployModel;

class DeployModelMapper
{

    public static function map(Deploy $deploy)
    {
        $deployModel = new DeployModel();
        $deployModel->appName = $deploy->app;
        $deployModel->state = $deploy->state;
        $deployModel->startTime = $deploy->startTime;
        $deployModel->endTime = $deploy->endTime;

        return $deployModel;
    }
}