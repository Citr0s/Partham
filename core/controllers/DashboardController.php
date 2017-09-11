<?php namespace Partham\core\controllers;

use Partham\core\services\DeployService;
use Partham\core\services\BuildService;
use Partham\core\services\LogService;
use Partham\core\services\ServerService;

class DashboardController
{
    private $deployService;
    private $serverService;
    private $buildService;
    private $logService;

    function __construct()
    {
        $this->deployService = new DeployService();
        $this->buildService = new BuildService();
        $this->serverService = new ServerService();
        $this->logService = new LogService();
    }

    public function deploys()
    {
        header('Content-Type: application/json');
        echo json_encode($this->deployService->getAll());
    }

    public function server()
    {
        header('Content-Type: application/json');
        echo json_encode($this->serverService->info());
    }

    public function builds()
    {
        header('Content-Type: application/json');
        echo json_encode($this->buildService->getAll());
    }

    public function logs()
    {
        header('Content-Type: application/json');
        echo json_encode($this->logService->getAll());
    }
}