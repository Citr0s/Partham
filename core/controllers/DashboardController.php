<?php namespace Partham\core\controllers;

use Partham\core\builds\BuildService;
use Partham\core\deploys\DeployService;
use Partham\core\repositories\LogRepository;
use Partham\core\services\DatabaseService;
use Partham\core\services\LogService;
use Partham\core\services\ServerService;

class DashboardController
{
    public static function deploys()
    {
        header('Content-Type: application/json');

        $deployService = new DeployService();
        echo json_encode($deployService->getAll());
    }

    public static function server()
    {
        header('Content-Type: application/json');

        $serverService = new ServerService();
        echo json_encode($serverService->info());
    }

    public static function builds()
    {
        header('Content-Type: application/json');

        $buildService = new BuildService();
        echo json_encode($buildService->getAll());
    }

    public static function logs()
    {
        header('Content-Type: application/json');

        $logService = new LogService(new LogRepository(new DatabaseService()));
        echo json_encode($logService->getAll());
    }
}