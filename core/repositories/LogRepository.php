<?php namespace Partham\core\repositories;

use Partham\core\mappers\LogMapper;
use Partham\core\services\DatabaseService;

class LogRepository
{
    private $database;

    function __construct(DatabaseService $database)
    {
        $this->database = $database;
    }

    public function getAll()
    {
        $response = [];

        $data = $this->database->getAll('logs');

        while ($record = mysqli_fetch_array($data)) {
            $response[] = LogMapper::map($record);
        }

        return $response;
    }
}