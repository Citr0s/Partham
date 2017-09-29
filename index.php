<?php

require __DIR__ . '/vendor/autoload.php';

use Partham\core\router\RouteService;

//TODO: extract the splitting of the url into a helper method so that it can be reused when using ->get() etc
//TODO: the method will be used to determine route names passed into the methods
$router = new RouteService(array_values(array_filter(explode('/', $_SERVER['REQUEST_URI']))), $_SERVER['REQUEST_METHOD']);

//TODO: change subscribe to ->get() and ->post() etc method in order to make the routes more readable
$router->subscribe('', 'GET', 'WebController@index');
$router->subscribe('logs', 'GET', 'WebController@logs');
$router->subscribe('deploy/{appName}', 'POST', 'DeployController@deploy');
$router->subscribe('commit', 'POST', 'DeployController@commit');
$router->subscribe('api/deploys', 'GET', 'DashboardController@deploys');
$router->subscribe('api/builds', 'GET', 'DashboardController@builds');
$router->subscribe('api/usage', 'GET', 'DashboardController@server');
$router->subscribe('api/logs', 'GET', 'DashboardController@logs');
$router->subscribe('api/log/{severity}', 'POST', 'LogController@save');

$data = $router->notify();

