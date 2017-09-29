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

    private function subscribe($url, $action, $controller)
    {
        $route = new Route();
        $route->url = $url;
        $route->action = $action;
        $route->controller = $controller;

        array_push($this->routes, $route);
    }

    public function get($url, $controller)
    {
        $this->subscribe($url, 'GET', $controller);
    }

    public function post($url, $controller)
    {
        $this->subscribe($url, 'POST', $controller);
    }

    public function notify()
    {
        foreach ($this->routes as $route) {
            $routeUrlArray = explode('/', $route->url);
            $urlParams = [];

            for ($i = 0; $i < sizeof($routeUrlArray); $i++) {
                if (strpos($routeUrlArray[$i], '{') !== false && strpos($routeUrlArray[$i], '}') !== false) {
                    $varName = ltrim($routeUrlArray[$i], '{');
                    $varName = rtrim($varName, '}');

                    if (array_key_exists($i, $this->url)) {
                        $urlParams[$varName] = $this->url[$i];
                        $routeUrlArray[$i] = $this->url[$i];
                        $route->url = implode('/', $routeUrlArray);
                    }
                }
            }

            if ($route->url === implode('/', $this->url) && $route->action === $this->action) {
                $controllerInfo = explode('@', $route->controller);
                $class = "\Partham\core\controllers\\$controllerInfo[0]";
                $method = "{$controllerInfo[1]}";
                $newClass = new $class();

                return $newClass->$method($urlParams, file_get_contents('php://input'));
            }
        }

        //TODO: uncomment below line after all routes have been moved to this new service
        //header("HTTP/1.0 404 Not Found");
    }
}