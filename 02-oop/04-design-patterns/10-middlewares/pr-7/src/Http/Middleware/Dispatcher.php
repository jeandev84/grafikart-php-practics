<?php
declare(strict_types=1);


namespace Grafikart\Http\Middleware;



use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Created by PhpStorm at 03.12.2023
 *
 * @Dispatcher
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Grafikart\Http\Middleware
 */
class Dispatcher
{

      private array $middlewares = [];


      private int $index = 0;


      /**
       * Permet d' enregister un middleware
       *
       * @param callable $middleware
       * @return void
      */
      public function pipe(callable $middleware)
      {
          $this->middlewares[] = $middleware;
      }


      /**
       * Permet d'executer un middleware
       *
       * @param ServerRequestInterface $request
       * @param ResponseInterface $response
       * @return ResponseInterface
      */
      public function process(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
      {
           $middleware = $this->getMiddleware();
           $this->index++;

           if (is_null($middleware)) {
               return $response;
           }

           return $middleware($request, $response, [$this, 'process']);
      }





      private function getMiddleware(): mixed
      {
          if(isset($this->middlewares[$this->index])) {
               return $this->middlewares[$this->index];
          }

          return null;
      }
}