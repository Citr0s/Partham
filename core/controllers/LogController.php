<?php namespace Partham\core\controllers;

use Partham\core\repositories\LogRepository;
use Partham\core\services\DatabaseService;
use Partham\core\services\LogService;

class LogController
{
    public static function save($urlParameters, $requestBody)
    {
        header('Content-Type: application/json');

        $logService = new LogService(new LogRepository(new DatabaseService()));
        $logService->invoke($urlParameters['severity'], $requestBody);
    }
}