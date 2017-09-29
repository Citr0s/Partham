<?php namespace Partham\core\services;

use Partham\core\controllers\DashboardController;
use Partham\core\repositories\LogRepository;

class RouterService
{
    public static function start($request, $method)
    {
        if (!array_key_exists(0, $request))
            return;

        if ($request[0] === 'commit' && ($method === 'POST')) {
            unset($request[0]);

            $logger = new DeployService();
            $logger->handleCommit(file_get_contents('php://input'));
            return;
        }

        if ($request[0] === 'api' && ($method === 'GET')) {
            unset($request[0]);
            $request = array_values($request);

            if ($request[0] === 'deploys') {
                $controller = new DashboardController();
                $controller->deploys();
                return;
            }

            if ($request[0] === 'builds') {
                $controller = new DashboardController();
                $controller->builds();
                return;
            }

            if ($request[0] === 'usage') {
                $controller = new DashboardController();
                $controller->server();
                return;
            }

            if ($request[0] === 'logs') {
                $controller = new DashboardController();
                $controller->logs();
                return;
            }
        }

        if ($request[0] === 'api' && ($method === 'POST')) {
            unset($request[0]);
            $request = array_values($request);

            if ($request[0] === 'log') {
                unset($request[0]);
                $request = array_values($request);

                $logger = new LogService(new LogRepository(new DatabaseService()));
                $logger->invoke($request[0], file_get_contents('php://input'));
                return;
            }
        }

        header("HTTP/1.0 404 Not Found");
    }
}