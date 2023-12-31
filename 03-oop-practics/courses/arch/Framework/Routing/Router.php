<?php
declare(strict_types=1);

namespace ZFramework\Routing;


use Psr\Http\Message\ServerRequestInterface;
use Zend\Expressive\Router\FastRouteRouter;
use Zend\Expressive\Router\Route as ZendRoute;


/**
 * Created by PhpStorm at 04.12.2023
 *
 * @Router
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package ZFramework\Routing
 */
class Router
{


      public function __construct()
      {
          $this->router = new FastRouteRouter();
      }



      /**
       * @param string $path
       *
       * @param callable $callable
       *
       * @param string $name
       *
       * @return void
      */
      public function get(string $path, callable $callable, string $name): void
      {
           $this->router->addRoute(new ZendRoute($path, $callable, ['GET'], $name));
      }




      /**
       * @param ServerRequestInterface $request
       *
       * @return Route|null
       */
      public function match(ServerRequestInterface $request): ?Route
      {
           $route = $this->router->match($request);

           if ($route->isSuccess()) {
               return new Route(
                   $route->getMatchedRouteName(),
                   $route->getMatchedMiddleware(),
                   $route->getMatchedParams()
               );
           }

           return null;
      }




      public function generateUri(string $name, array $parameters): ?string
      {
          return $this->router->generateUri($name, $parameters);
      }
}