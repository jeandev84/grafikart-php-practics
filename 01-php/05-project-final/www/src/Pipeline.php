<?php
declare(strict_types=1);

namespace Grafikart;


use Grafikart\Container\Container;
use Grafikart\Http\Middleware\MiddlewareInterface;
use Grafikart\Http\Request\Request;
use Grafikart\Http\Response\Response;
use Grafikart\Routing\Route;
use Grafikart\Routing\RouteNotfoundException;
use Grafikart\Routing\Router;
use Grafikart\Templating\Renderer;


/**
 * Created by PhpStorm at 29.11.2023
 *
 * @Pipeline
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Grafikart
 */
class Pipeline
{
       private  $start;


       protected Container $container;


       protected Router $router;

       public function __construct(Container $container, Router $router)
       {
           $this->container = $container;
           $this->router    = $router;
           $this->start = function () {};
       }


       public function middlewares(array $middlewares): self
       {
           foreach ($middlewares as $middleware) {
               $this->pipe(new $middleware($this->container));
           }

           return $this;
       }


       public function pipe(MiddlewareInterface $middleware): self
       {
             $next = $this->start;

             $this->start = function (Request $request) use ($middleware, $next) {
                  return $middleware->handle($request, $next);
             };

             return $this;
       }




       public function handle(Request $request): Response
       {
               if (! $match = $this->router->match()) {
                   throw new RouteNotfoundException($request->getPath());
               }

               $route = new Route(
                  $request->getMethod(),
                  $request->getPath(),
                  $match['target'],
                  $match['name']
               );

               $route->setParams($match['params']);
               $request->attributes->set('_route', $route);
               $request->attributes->merge($match['params']);

               call_user_func($this->start, $request);

               return $this->dispatchRoute($route, $request);
       }



       private function dispatchRoute(Route $route, Request $request): Response
       {
           $target = $route->getAction();
           if (is_callable($target)) {
                return call_user_func_array($target, [$request]);
           }

           if (! is_array($route->getAction())) {
               throw new \Exception("Invalid action");
           }

           [$controller, $action] = $route->getAction();
           return call_user_func_array([new $controller($this->container), $action], [$request]);
       }
}