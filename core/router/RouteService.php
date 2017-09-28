<?php namespace Partham\core\router;

class RouteService
{
    private $routes;
    private $url;
    private $action;

    public function __construct($url, $action)
    {
        $this->routes = [];
        $this->url = $url;
        $this->action = $action;
    }

    public function subscribe($url, $action, $controller)
    {
        $route = new Route();
        $route->url = $url;
        $route->action = $action;
        $route->controller = $controller;

        array_push($this->routes, $route);
    }

    public function notify()
    {
        foreach ($this->routes as $route) {
            if ($route->url === implode('/', $this->url) && $route->action === $this->action) {
                $controllerInfo = explode('@', $route->controller);
                $class = "\Partham\core\controllers\\$controllerInfo[0]";
                $method = "{$controllerInfo[1]}";
                $newClass = new $class();

                return $newClass->$method();
            }
        }

        //TODO: uncomment below line after all routes have been moved to this new service
        //header("HTTP/1.0 404 Not Found");
    }
}