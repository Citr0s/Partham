<?php namespace Partham\core\mappers;

use Partham\core\types\Deploy;

class DeployMapper
{
    public static function map($record)
    {
        $deploy = new Deploy();
        $deploy->app = $record['app'];
        $deploy->state = $record['state'];
        $deploy->startTime = $record['start_time'];
        $deploy->endTime = $record['end_time'];

        return $deploy;
    }
}