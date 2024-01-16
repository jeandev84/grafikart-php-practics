<?php
declare(strict_types=1);

namespace App\Http;

use Grafikart\Container\Container;
use Grafikart\Http\Handlers\QueueRequestHandler;
use Grafikart\Http\Handlers\RequestHandlerInterface;
use Grafikart\Http\Request\ServerRequest;
use Grafikart\Http\Response\Response;

/**
 * Pipeline
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  App\Http
 */
class Pipeline
{
     /**
      * @var Container
     */
     protected Container $app;



     /**
      * @var QueueRequestHandler
     */
     protected QueueRequestHandler $queueRequestHandler;


     /**
      * @param Container $app
      * @param QueueRequestHandler $queueRequestHandler
     */
     public function __construct(Container $app, QueueRequestHandler $queueRequestHandler)
     {
         $this->app = $app;
         $this->queueRequestHandler = $queueRequestHandler;
     }



     /**
      * @param array $middlewares
      * @return $this
     */
     public function middlewares(array $middlewares): static
     {
         foreach ($middlewares as $middleware) {
             $this->queueRequestHandler->add(new $middleware($this->app));
         }

         return $this;
     }




     /**
      * @param ServerRequest $request
      * @return Response
     */
     public function then(ServerRequest $request): Response
     {
         return $this->queueRequestHandler->handle($request);
     }

}