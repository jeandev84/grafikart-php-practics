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

     protected array $routes = [];

     protected array $namedRoutes = [];



     public function get(string $path, $target, string $name): self
     {
         return $this->map('GET', $path, $target, $name);
     }



     public function post(string $path, $target, string $name): self
     {
         return $this->map('POST', $path, $target, $name);
     }


     private function map(string $method, string $path, $target, string $name): self
     {
         $path = trim($path, '/');

         $this->routes[$method][$path] = $target;

         $this->namedRoutes[$name] = "/$path";

         return $this;
     }




     /**
      * @param string $requestMethod
      *
      * @param string $requestPath
      *
      * @return mixed
     */
     public function match(string $requestMethod, string $requestPath): mixed
     {
           $requestPath = trim($requestPath, '/');

           if (! isset($this->routes[$requestMethod][$requestPath])) {
                return false;
           }

           return $this->routes[$requestMethod][$requestPath];
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