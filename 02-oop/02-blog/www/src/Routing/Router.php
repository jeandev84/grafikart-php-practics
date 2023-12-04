<?php
declare(strict_types=1);

namespace Grafikart\Routing;


/**
 * Created by PhpStorm at 01.12.2023
 *
 * @Router
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Grafikart\Routing
 */
class Router
{


     protected string $domain = '';


     /**
      * @var Route[]
     */
     protected array $routes = [];



     /**
      * @var Route[]
     */
     protected array $namedRoutes = [];





     public function __construct(string $domain = '')
     {
         $this->domain = $domain;
     }



    /**
     * @param string $path
     *
     * @param $target
     *
     * @param string $name
     *
     * @return Route
     *
     * @throws \Exception
     */
     public function get(string $path, $target, string $name): Route
     {
         return $this->map('GET', $path, $target, $name);
     }




     /**
      * @param string $path
      * @param $target
      * @param string $name
      * @return Route
      * @throws \Exception
     */
     public function post(string $path, $target, string $name): Route
     {
         return $this->map('POST', $path, $target, $name);
     }




    /**
     * @param string $methods
     *
     * @param string $path
     *
     * @param $target
     *
     * @param string $name
     *
     * @return Route
     */
     public function map(string $methods, string $path, $target, string $name): Route
     {
         $route   = new Route($this->domain, $methods, $path, $target, $name);
         $this->routes[$path] = $route;
         $this->namedRoutes[$name] = $route;

         return $route;
     }






     /**
      * @param string $requestMethod
      *
      * @param string $requestPath
      *
      * @return Route|false
     */
     public function match(string $requestMethod, string $requestPath): Route|false
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
      *
      * @param array $params
      *
      * @return string|null
     */
     public function generate(string $name, array $params = []): ?string
     {
          if (! isset($this->namedRoutes[$name])) {
               return null;
          }

          $path = $this->namedRoutes[$name];
          return http_build_query(array_merge(['p' => $path], $params));
     }
}