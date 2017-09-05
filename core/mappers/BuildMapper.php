<?php namespace Partham\core\mappers;

use Partham\core\types\Build;

class BuildMapper
{
    public static function map($record)
    {
        $build = new Build();
        $build->reference = $record['reference'];
        $build->startTime = $record['start_time'];
        $build->endTime = $record['end_time'];
        $build->app = $record['app_id'];
        $build->user = $record['user_id'];

        return $build;
    }
}