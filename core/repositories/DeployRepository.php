<?php namespace Partham\core\repositories;

use Partham\Core\DatabaseService;

class DeployRepository
{
    function __construct()
    {
        $this->database = new DatabaseService();
    }

    public function getAll()
    {
        $response = new Deploy[];
        $databaseResponse = $this->database->getAll('deploys');
    }
}