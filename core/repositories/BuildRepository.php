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

        $data = $this->database->getAll('builds');

        while ($record = mysqli_fetch_array($data)) {
            $response[] = BuildMapper::map($record);
        }

        return $response;
    }
}