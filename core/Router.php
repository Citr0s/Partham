<?php namespace Partham\core;

class Router
{
    public static function start($request, $method)
    {
        if (!array_key_exists(0, $request)) {
            return header('Location: web');
        }

        if ($request[0] === 'deploy' && ($method === 'POST')) {
            unset($request[0]);
            $request = array_values($request);

            $deployer = new Deploy(file_get_contents('php://input'));
            $deployer->invoke($request[0]);
        }
    }
}