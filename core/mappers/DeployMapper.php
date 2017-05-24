<?php namespace Partham\core\mappers;

use Partham\core\types\Deploy;

class DeployMapper
{

    public static function map($record)
    {
        $deploy = new Deploy();
        $deploy->log = $record['log'];
        $deploy->request = $record['request'];
        $deploy->status = $record['status'];
        $deploy->startTime = $record['startTime'];
        $deploy->endTime = $record['endTime'];
        $deploy->app = $record['app'];

        return $deploy;
    }
}