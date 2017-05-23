<?php namespace Partham\Core;

class Router
{
    public static function start($request, $method)
    {
        if (!array_key_exists(0, $request)) {
            return header('Location: web');
        }

        if ($request[0] === 'deploy' && $method === 'GET') {
            unset($request[0]);
            $request = array_values($request);

            Deploy::invoke($request[0]);
        }
    }
}