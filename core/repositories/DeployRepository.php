<?php namespace Partham\core\repositories;

use Partham\core\mappers\DeployMapper;
use Partham\core\services\DatabaseService;

class DeployRepository
{
    private $database;

    function __construct(DatabaseService $database)
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