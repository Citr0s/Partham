<?php namespace Partham\core\mappers;

use Partham\core\types\LogModel;
use Partham\core\types\LogRecord;

class LogModelMapper
{
    public static function map(LogRecord $record): LogModel
    {
        $buildModel = new LogModel();
        $buildModel->appName = $record->app;
        $buildModel->severity = $record->severity;
        $buildModel->message = $record->message;
        $buildModel->exception = $record->exception;
        $buildModel->loggedAt = $record->loggedAt;

        return $buildModel;
    }
}