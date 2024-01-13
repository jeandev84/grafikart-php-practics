<?php
declare(strict_types=1);

namespace Grafikart\Routing;


/**
 * Router
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package  Grafikart\Routing
 */
class Router
{

    /**
     * @var Route[]
    */
    protected array $routes = [];


    /**
     * @var Route[]
    */
    protected array $namedRoutes = [];





    /**
     * @param Route $route
     * @return Route
    */
    public function add(Route $route): Route
    {
        $this->routes[] = $route;

        if ($name = $route->getName()) {
            $this->namedRoutes[$name] = $route;
        }

        return $route;
    }




    /**
     * @param string $methods
     * @param string $path
     * @param callable|array $callback
     * @param string $name
     * @return Route
    */
    public function map(string $methods, string $path, callable|array $callback, string $name = ''): Route
    {
        $methods = explode('|', $methods);

        return $this->add(new Route($methods, $path, $callback, $name));
    }




    /**
     * @param string $path
     * @param callable|array $callback
     * @param string $name
     * @return Route
    */
    public function get(string $path, callable|array $callback, string $name = ''): Route
    {
        return $this->map('GET', $path, $callback, $name);
    }




    /**
     * @param string $path
     * @param callable|array $callback
     * @param string $name
     * @return Route
    */
    public function post(string $path, callable|array $callback, string $name = ''): Route
    {
        return $this->map('POST', $path, $callback, $name);
    }





    /**
     * @return Route[]
    */
    public function getRoutes(): array
    {
        return $this->routes;
    }


    /**
     * @param string $requestMethod
     * @param string $requestPath
     * @return Route|bool
    */
    public function match(string $requestMethod, string $requestPath): Route|bool
    {
         foreach ($this->routes as $route) {
             if ($route->match($requestMethod, $requestPath)) {
                 return $route;
             }
         }

         return false;
    }
}