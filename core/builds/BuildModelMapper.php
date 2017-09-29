<?php namespace Partham\core\builds;

use Partham\core\repositories\AppRepository;
use Partham\core\repositories\UserRepository;

class BuildModelMapper
{
    private $appRepository;
    private $userRepository;

    public function __construct(AppRepository $appRepository, UserRepository $userRepository)
    {
        $this->appRepository = $appRepository;
        $this->userRepository = $userRepository;
    }

    public function map(BuildRecord $record)
    {
        $buildModel = new BuildModel();
        $buildModel->appName = $this->appRepository->getById($record->app);
        $buildModel->userName = $this->userRepository->getById($record->user);
        $buildModel->startTime = strtotime($record->startTime);
        $buildModel->endTime = strtotime($record->endTime);
        $buildModel->state = $record->state;
        $buildModel->buildUrl = $record->buildUrl;

        return $buildModel;
    }
}