<?php
declare(strict_types=1);

namespace Grafikart\Http\Handlers;

use Grafikart\Http\Request\ServerRequest;
use Grafikart\Http\Response\Response;

/**
 * QueueRequestHandler
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Grafikart\Http\Handlers
 */
class QueueRequestHandler implements RequestHandlerInterface
{

      /**
        * Fallback handler
        *
        * @var RequestHandlerInterface
      */
      protected RequestHandlerInterface $fallbackHandler;




      /**
       * @var MiddlewareInterface[]
      */
      protected array $middlewares = [];


      /**
       * @param RequestHandlerInterface $fallbackHandler
      */
      public function __construct(RequestHandlerInterface $fallbackHandler)
      {
           $this->fallbackHandler = $fallbackHandler;
      }



      /**
       * @param MiddlewareInterface $middleware
       * @return $this
      */
      public function add(MiddlewareInterface $middleware): static
      {
          $this->middlewares[] = $middleware;

          return $this;
      }



      /**
       * @inheritDoc
      */
      public function handle(ServerRequest $request): Response
      {
          // Last middleware in the queue has called on the request handler.
          if (0 === count($this->middlewares)) {
              return $this->fallbackHandler->handle($request);
          }

          $middleware = array_shift($this->middlewares);
          return $middleware->process($request, $this);
      }
}