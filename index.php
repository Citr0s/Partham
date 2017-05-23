<?php namespace Partham;

require_once __DIR__ . '/vendor/autoload.php';

use Partham\Core\Router;

echo Router::start(array_values(array_filter(explode('/', $_SERVER['REQUEST_URI']))), $_SERVER['REQUEST_METHOD']);