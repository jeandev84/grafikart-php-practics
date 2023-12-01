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


     public function get(string $path, $target): self
     {
         return $this->map('GET', $path, $target);
     }



     public function post(string $path, $target): self
     {
         return $this->map('POST', $path, $target);
     }


     private function map(string $method, string $path, $target): self
     {
         $path = trim($path, '/');

         $this->routes[$method][$path] = $target;

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
}