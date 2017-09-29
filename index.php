<?php

require __DIR__ . '/vendor/autoload.php';

use Partham\core\router\RouteService;

//TODO: extract the splitting of the url into a helper method so that it can be reused when using ->get() etc
//TODO: the method will be used to determine route names passed into the methods
$router = new RouteService(array_values(array_filter(explode('/', $_SERVER['REQUEST_URI']))), $_SERVER['REQUEST_METHOD']);

$router->get('', 'WebController@index');
$router->get('logs', 'WebController@logs');

$router->post('deploy/{appName}', 'DeployController@deploy');
$router->post('commit', 'DeployController@commit');

$router->get('api/deploys', 'DashboardController@deploys');
$router->get('api/builds', 'DashboardController@builds');
$router->get('api/usage', 'DashboardController@server');

$router->get('api/logs', 'DashboardController@logs');
$router->post('api/log/{severity}', 'LogController@save');

$data = $router->notify();

