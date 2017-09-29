<?php namespace Partham\core\logs;

use Partham\core\interfaces\IDatabaseService;

class LogRepository implements ILogRepository
{
    private $database;

    function __construct(IDatabaseService $database)
    {
        $this->database = $database;
    }

    public function getAll(): array
    {
        $response = [];

        $records = $this->database->getAll('logs');

        foreach ($records as $record)
            $response[] = LogMapper::map($record);

        return $response;
    }

    public function save($severity, $logDetails): bool
    {
        $logDetails = json_decode($logDetails);
        $this->database->insert('logs', ['app', 'severity', 'message', 'exception', 'logged_at'], [$logDetails->app, $severity, $logDetails->message, $logDetails->exception, date("Y-m-d H:i:s")]);

        return true;
    }
}