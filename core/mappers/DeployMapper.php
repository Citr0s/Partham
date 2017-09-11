<?php namespace Partham\core\mappers;

use Partham\core\types\DeployRecord;

class DeployMapper
{
    public static function map($record)
    {
        $deploy = new DeployRecord();
        $deploy->reference = $record['reference'];
        $deploy->app = $record['app_id'];
        $deploy->user = $record['user_id'];
        $deploy->state = $record['state'];
        $deploy->startTime = $record['start_time'];
        $deploy->endTime = $record['end_time'];

        return $deploy;
    }
}