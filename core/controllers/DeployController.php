<?php namespace Partham\core\controllers;

use Partham\core\services\DeployService;

class DeployController
{
    public static function deploy($urlParameters, $requestBody)
    {
        $deployService = new DeployService();
        $deployService->invoke($urlParameters['appName'], $requestBody);

        header("HTTP/1.0 200 OK");
    }

    public static function commit($urlParameters, $requestBody)
    {
        $deployService = new DeployService();
        $deployService->handleCommit($requestBody);

        header("HTTP/1.0 200 OK");
    }
}