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

               call_user_func($this->start, $request);

               return $this->dispatchRoute($route);
       }



       private function dispatchRoute(Route $route): Response
       {

           $view = $this->container['view'];

           dd($view);
       }
}