<?php namespace Partham\core\services;


class LogService
{
    private $database;

    public function __construct()
    {
        $this->database = new DatabaseService();
    }

    public function invoke($severity, $logDetails)
    {
        $logDetails = json_decode($logDetails);
        $this->database->insert('logs', ['app', 'severity', 'message', 'exception', 'logged_at'], [$logDetails->app, $severity, $logDetails->message, $logDetails->exception, date("Y-m-d H:i:s")]);
    }
}