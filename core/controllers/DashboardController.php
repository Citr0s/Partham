<?php namespace Partham\core\controllers;

use Partham\core\services\DeployService;
use Partham\core\services\ServerService;

class DashboardController
{
    private $deployService;
    private $serverService;

    function __construct()
    {
        $this->deployService = new DeployService();
        $this->serverService = new ServerService();
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
}