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
     * @param string $path
     * @param callable|array $callback
     * @param string $name
     * @return Route
     */
    public function put(string $path, callable|array $callback, string $name = ''): Route
    {
        return $this->map('PUT', $path, $callback, $name);
    }





    /**
     * @param string $path
     * @param callable|array $callback
     * @param string $name
     * @return Route
     */
    public function delete(string $path, callable|array $callback, string $name = ''): Route
    {
        return $this->map('DELETE', $path, $callback, $name);
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


    
    /**
     * @param string $name
     * @param array $params
     * @return string
    */
    public function generate(string $name, array $params = []): string
    {
         if (! isset($this->namedRoutes[$name])) {
              throw new \InvalidArgumentException("Could not resolve named route $name");
         }
         
         return $this->namedRoutes[$name]->generate($params);
    }
    
    


    /**
     * @return Route[]
     */
    public function getRoutes(): array
    {
        return $this->routes;
    }




    /**
     * @return array
    */
    public function getNamedRoutes(): array
    {
        return $this->namedRoutes;
    }
}