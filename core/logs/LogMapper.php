<?php namespace Partham\core\logs;

class LogMapper
{
    public static function map($record): LogRecord
    {
        $deploy = new LogRecord();
        $deploy->app = $record['app'];
        $deploy->severity = $record['severity'];
        $deploy->message = $record['message'];
        $deploy->exception = $record['exception'];
        $deploy->loggedAt = $record['logged_at'];

        return $deploy;
    }
}