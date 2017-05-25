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
        $deployModel->lastBuildStatusClass = self::mapBuildStateClass($parsedRequest, $deploy->log);
        $deployModel->lastDeployDuration = self::mapDuration($deploy->startTime, $deploy->endTime);
        $deployModel->lastDeployStatus = is_null($deploy->endTime) ? "-" : $deploy->status;
        $deployModel->lastDeployStatusClass = is_null($deploy->endTime) ? "" : self::mapDeployStateClass($deploy);
        $deployModel->deployFinishTime = self::mapEndTime($deploy->endTime);

        return $deployModel;
    }

    private static function mapState($parsedRequest, $deployLog)
    {
        return is_null($parsedRequest) ? $deployLog : $parsedRequest['state'];
    }

    private static function mapDuration($timeOne, $timeTwo)
    {
        return (is_null($timeOne) || is_null($timeTwo)) ? "-" : (strtotime($timeTwo) - strtotime($timeOne)) . "s";
    }

    private static function mapBuildStateClass($state, $log)
    {
        if (StringHelper::contains('passed', $state['state']))
            return 'success';

        if (StringHelper::contains('failed', $log))
            return 'failed';

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

    private static function mapEndTime($endTime)
    {
        if (is_null($endTime))
            return '-';

        return date('G:i:s d-M-Y', strtotime($endTime));
    }
}