<?php namespace Partham\core\services;

use Partham\core\mappers\BuildModelMapper;
use Partham\core\repositories\BuildRepository;

class BuildService
{
    private $database;
    private $repository;

    public function __construct()
    {
        $this->database = new DatabaseService();
        $this->repository = new BuildRepository($this->database);
    }

    public function getAll()
    {
        $response = [];

        $data = $this->repository->getAll();

        foreach ($data as $record)
            $response[] = BuildModelMapper::map($record);

        return $response;
    }
}