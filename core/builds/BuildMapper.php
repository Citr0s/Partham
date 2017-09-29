<?php namespace Partham\core\builds;

use Partham\core\types\BuildRecord;

class BuildMapper
{
    public static function map($record)
    {
        $build = new BuildRecord();
        $build->reference = $record['reference'];
        $build->startTime = $record['start_time'];
        $build->endTime = $record['end_time'];
        $build->app = $record['app_id'];
        $build->user = $record['user_id'];
        $build->state = $record['state'];

        return $build;
    }
}