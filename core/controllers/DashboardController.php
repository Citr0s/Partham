<?php namespace Partham\core\controllers;

use Partham\core\services\DeployService;
use Partham\core\services\ServerService;

class DashboardController
{
    function __construct()
    {
        $this->deployService = new DeployService();
        $this->serverService = new ServerService();
    }

    public function deploys()
    {
        return $this->deployService->getAll();
    }

    public function server()
    {
        return $this->serverService->info();
    }
}