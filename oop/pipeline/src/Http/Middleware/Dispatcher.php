<?php
declare(strict_types=1);


namespace Grafikart\Http\Middleware;



use GuzzleHttp\Psr7\Response;
use Interop\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Interop\Http\Server\MiddlewareInterface;



/**
 * Created by PhpStorm at 03.12.2023
 *
 * @Dispatcher
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Grafikart\Http\Middleware
 */
class Dispatcher implements RequestHandlerInterface
{

      private array $middlewares = [];


      private int $index = 0;


      private $response;



      public function __construct()
      {
      }

      /**
       * Permet d' enregister un middleware
       *
       * @param callable|MiddlewareInterface $middleware
       * @return void
      */
      public function pipe(callable|MiddlewareInterface $middleware)
      {
          $this->middlewares[] = $middleware;
          $this->response      = new Response();
      }





      private function getMiddleware(): mixed
      {
          if(isset($this->middlewares[$this->index])) {
               return $this->middlewares[$this->index];
          }

          return null;
      }




    /**
     * Permet d'executer un middleware
     *
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
     public function handle(ServerRequestInterface $request)
     {
         $middleware = $this->getMiddleware();
         $this->index++;

         if (is_null($middleware)) {
             return $this->response;
         }

         if ($middleware instanceof \Interop\Http\Server\MiddlewareInterface) {
             return $middleware->process($request, $this);
         }

         return $middleware($request, $this->response, [$this, 'handle']);
     }
}