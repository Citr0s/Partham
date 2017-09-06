<?php namespace Partham\core\mappers;

use Partham\core\repositories\AppRepository;
use Partham\core\types\BuildModel;

class BuildModelMapper
{
    private $appRepository;

    public function __construct(AppRepository $appRepository)
    {
        $this->appRepository = $appRepository;
    }

    public function map($record)
    {
        $buildModel = new BuildModel();
        $buildModel->appName = $this->appRepository->getById($record->app);
        $buildModel->startTime = strtotime($record->startTime);
        $buildModel->endTime = strtotime($record->endTime);

        return $buildModel;
    }
}