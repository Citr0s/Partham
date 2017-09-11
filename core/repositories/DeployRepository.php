<?php namespace Partham\core\repositories;

use Partham\core\interfaces\IDatabaseService;
use Partham\core\mappers\DeployMapper;

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