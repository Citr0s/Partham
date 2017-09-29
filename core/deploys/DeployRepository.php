<?php namespace Partham\core\deploys;

use Partham\core\interfaces\IDatabaseService;

class DeployRepository
{
    private $database;

    function __construct(IDatabaseService $database)
    {
        $this->database = $database;
    }

    public function getAll()
    {
        $response = [];

        $records = $this->database->getAll('deploys');

        foreach ($records as $record)
            $response[] = DeployMapper::map($record);

        return $response;
    }
}