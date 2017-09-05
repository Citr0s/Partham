<?php namespace Partham\core\mappers;

use Partham\core\types\BuildModel;

class BuildModelMapper
{
    public static function map($record)
    {
        $buildModel = new BuildModel();
        $buildModel->appName = $record->app;
        $buildModel->startTime = strtotime($record->startTime);
        $buildModel->endTime = strtotime($record->endTime);

        return $buildModel;
    }
}