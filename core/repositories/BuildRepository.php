<?php namespace Partham\core\repositories;

use Partham\core\mappers\BuildMapper;
use Partham\core\services\DatabaseService;

class BuildRepository
{
    private $database;

    function __construct(DatabaseService $database)
    {
        $this->database = $database;
    }

    public function getAll()
    {
        $response = [];

        $records = $this->database->getAll('builds');

        foreach ($records as $record)
            $response[] = BuildMapper::map($record);

        return $response;
    }
}