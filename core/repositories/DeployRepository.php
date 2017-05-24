<?php namespace Partham\core\repositories;

use Partham\core\mappers\DeployMapper;
use Partham\core\services\DatabaseService;

class DeployRepository
{
    function __construct(DatabaseService $database)
    {
        $this->database = $database;
    }

    public function getAll()
    {
        $response = [];

        $data = $this->database->getAll('deploys');

        while ($record = mysqli_fetch_array($data)) {
            $response[] = DeployMapper::map($record);
        }

        return $response;
    }
}