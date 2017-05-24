<?php namespace Partham\web\controllers;

use Partham\core\services\DeployService;

class DashboardController
{
    function __construct()
    {
        $this->deployService = new DeployService();
    }

    public function deploys()
    {
        return $this->deployService->getAll();
    }
}