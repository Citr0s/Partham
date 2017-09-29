<?php namespace Partham\core\builds;

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
        $build->buildUrl = $record['build_url'];

        return $build;
    }
}