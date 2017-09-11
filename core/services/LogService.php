<?php namespace Partham\core\services;

use Partham\core\mappers\LogModelMapper;
use Partham\core\repositories\LogRepository;

class LogService
{
    private $database;
    private $repository;

    public function __construct()
    {
        $this->database = new DatabaseService();
        $this->repository = new LogRepository($this->database);
    }

    public function invoke($severity, $logDetails)
    {
        $logDetails = json_decode($logDetails);
        $this->database->insert('logs', ['app', 'severity', 'message', 'exception', 'logged_at'], [$logDetails->app, $severity, $logDetails->message, $logDetails->exception, date("Y-m-d H:i:s")]);
    }

    public function getAll()
    {
        $response = [];

        $data = $this->repository->getAll();

        foreach ($data as $record)
            $response[] = LogModelMapper::map($record);

        return $response;
    }
}