<?php namespace Partham\core\services;

use Partham\core\interfaces\ILogRepository;
use Partham\core\mappers\LogModelMapper;

class LogService
{
    private $repository;

    public function __construct(ILogRepository $repository)
    {
        $this->repository = $repository;
    }

    public function invoke($severity, $logDetails)
    {
        $this->repository->save($severity, $logDetails);
    }

    public function getAll()
    {
        $response = [];

        $data = $this->repository->getAll();

        foreach ($data as $record)
            $response[] = LogModelMapper::map($record);

        return $response;
    }
}