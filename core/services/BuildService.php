<?php namespace Partham\core\services;

use Partham\core\mappers\BuildModelMapper;
use Partham\core\repositories\AppRepository;
use Partham\core\repositories\BuildRepository;
use Partham\core\repositories\UserRepository;

class BuildService
{
    private $database;
    private $repository;
    private $appRepository;
    private $userRepository;

    public function __construct()
    {
        $this->database = new DatabaseService();
        $this->repository = new BuildRepository($this->database);
        $this->appRepository = new AppRepository($this->database);
        $this->userRepository = new UserRepository($this->database);
    }

    public function getAll()
    {
        $response = [];
        $mapper = new BuildModelMapper($this->appRepository, $this->userRepository);

        $data = $this->repository->getAll();

        foreach ($data as $record)
            $response[] = $mapper->map($record);

        return $response;
    }
}