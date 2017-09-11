<?php namespace Partham\core\repositories;

use Partham\core\interfaces\IDatabaseService;

class AppRepository
{
    private $database;

    public function __construct(IDatabaseService $database)
    {
        $this->database = $database;
    }

    public function getById($appId)
    {
        $record = $this->database->get(['name'], 'apps', ['id', $appId]);
        return $record['name'];
    }
}