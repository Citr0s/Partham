<?php namespace Partham\core\services;

use Partham\core\controllers\DashboardController;
use Partham\core\controllers\WebController;

class RouterService
{
    public static function start($request, $method)
    {
        if (!array_key_exists(0, $request) || ($request[0] === 'web' && ($method === 'GET'))) {
            unset($request[0]);
            $request = array_values($request);

            WebController::index();
            return;
        }

        if ($request[0] === 'deploy' && ($method === 'POST')) {
            unset($request[0]);
            $request = array_values($request);

            $deployer = new DeployService();
            $deployer->invoke($request[0], file_get_contents('php://input'));
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

            if ($request[0] === 'usage') {
                $controller = new DashboardController();
                $controller->server();
                return;
            }
        }

        header("HTTP/1.0 404 Not Found");
    }
}