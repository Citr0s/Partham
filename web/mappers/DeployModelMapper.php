<?php namespace Partham\web\mappers;

use Partham\core\helpers\StringHelper;
use Partham\core\types\Deploy;
use Partham\web\types\DeployModel;

class DeployModelMapper
{

    public static function map(Deploy $deploy)
    {
        $deployModel = new DeployModel();
        $deployModel->appName = $deploy->app;

        $parsedRequest = json_decode($deploy->request, true);

        $deployModel->lastBuildDuration = self::mapDuration($parsedRequest['started_at'], $parsedRequest['finished_at']);
        $deployModel->lastBuildStatus = self::mapState($parsedRequest, $deploy->log);
        $deployModel->lastBuildStatusClass = self::mapBuildStateClass($parsedRequest);
        $deployModel->lastDeployDuration = self::mapDuration($deploy->startTime, $deploy->endTime);
        $deployModel->lastDeployStatus = $deploy->status;
        $deployModel->lastDeployStatusClass = self::mapDeployStateClass($deploy);

        return $deployModel;
    }

    private static function mapState($parsedRequest, $deployLog)
    {
        return is_null($parsedRequest) ? $deployLog : $parsedRequest['state'];
    }

    private static function mapDuration($timeOne, $timeTwo)
    {
        return (is_null($timeOne) || is_null($timeTwo)) ? "N/A" : (strtotime($timeTwo) - strtotime($timeOne)) . "s";
    }

    private static function mapBuildStateClass($state)
    {
        if (StringHelper::contains('passed', $state['state']))
            return 'success';

        return '';
    }

    private static function mapDeployStateClass($state)
    {
        if (StringHelper::contains('success', $state->status))
            return 'success';

        if (StringHelper::contains('started', $state->status))
            return 'started';

        if (StringHelper::contains('failed', $state->log))
            return 'failed';

        return '';
    }
}