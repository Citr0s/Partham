<?php use Partham\core\services\RouterService;

require __DIR__ . '/vendor/autoload.php';

RouterService::start(array_values(array_filter(explode('/', $_SERVER['REQUEST_URI']))), $_SERVER['REQUEST_METHOD']);