<?php namespace Partham\core\repositories;

use Partham\core\interfaces\IDatabaseService;
use Partham\core\mappers\BuildMapper;

class BuildRepository
{
    private $database;

    function __construct(IDatabaseService $database)
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