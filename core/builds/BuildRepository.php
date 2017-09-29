<?php namespace Partham\core\builds;

use Partham\core\interfaces\IDatabaseService;

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

        $records = $this->database->getAll('builds', false, 15);

        foreach ($records as $record)
            $response[] = BuildMapper::map($record);

        return $response;
    }
}