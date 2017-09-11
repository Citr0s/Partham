<?php namespace Partham\core\mappers;

use Partham\core\repositories\AppRepository;
use Partham\core\types\DeployRecord;
use Partham\core\types\DeployModel;

class DeployModelMapper
{
    private $appRepository;

    public function __construct(AppRepository $appRepository)
    {
        $this->appRepository = $appRepository;
    }

    public function map(DeployRecord $record)
    {
        $deployModel = new DeployModel();
        $deployModel->appName = $this->appRepository->getById($record->app);
        $deployModel->state = $record->state;
        $deployModel->startTime = $record->startTime;
        $deployModel->endTime = $record->endTime;

        return $deployModel;
    }
}