<?php
declare(strict_types=1);

namespace App;

use App\Http\Response;
use App\Http\ServerRequest;

/**
 * Kernel
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  App
 */
class Kernel
{

       /**
        * @var App
       */
       protected App $app;


       /**
        * @param App $app
       */
       public function __construct(App $app)
       {
           $this->app = $app;
       }



       /**
        * @param ServerRequest $request
        *
        * @return Response
       */
       public function handle(ServerRequest $request): Response
       {
           try {

               // may be dispatch middlewares
               $response = $this->dispatchRoute($request);

           } catch (\Throwable $e) {
               $response = $this->exceptionResponse($e);
           }

           return $response;
       }


       /**
        * @param ServerRequest $request
        * @return Response
        * @throws \Exception
       */
       private function dispatchRoute(ServerRequest $request): Response
       {
           $path      = $request->getPath();
           $method    = $request->getMethod();
           $callback  = $this->routes[$method][$path] ?? false;

           if (!$callback) {
               throw new \Exception("Route {$path} not found.");
           }

           if (is_array($callback)) {
               [$controller, $action] = $callback;
               $callback = [new $controller($this->app), $action];
           }

           return call_user_func_array($callback, [$request]);
       }





       /**
        * @param ServerRequest $request
        * @param Response $response
        * @return void
       */
       public function terminate(ServerRequest $request, Response $response): void
       {
           $response->withProtocolVersion($request->getProtocolVersion());
           echo $response->getBody();
       }



       /**
        * @param \Throwable $e
        * @return Response
       */
       private function exceptionResponse(\Throwable $e): Response
       {
           return new Response($e->getMessage());
       }
}