<?php namespace Partham\core\mappers;

use Partham\core\repositories\AppRepository;
use Partham\core\repositories\UserRepository;
use Partham\core\types\Build;
use Partham\core\types\BuildModel;

class BuildModelMapper
{
    private $appRepository;
    private $userRepository;

    public function __construct(AppRepository $appRepository, UserRepository $userRepository)
    {
        $this->appRepository = $appRepository;
        $this->userRepository = $userRepository;
    }

    public function map(Build $record)
    {
        $buildModel = new BuildModel();
        $buildModel->appName = $this->appRepository->getById($record->app);
        $buildModel->userName = $this->userRepository->getById($record->user);
        $buildModel->startTime = strtotime($record->startTime);
        $buildModel->endTime = strtotime($record->endTime);

        return $buildModel;
    }
}