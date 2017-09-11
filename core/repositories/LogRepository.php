<?php namespace Partham\core\repositories;

use Partham\core\interfaces\IDatabaseService;
use Partham\core\mappers\LogMapper;

class LogRepository
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
}