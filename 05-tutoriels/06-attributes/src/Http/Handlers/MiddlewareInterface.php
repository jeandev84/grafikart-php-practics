<?php
declare(strict_types=1);

namespace Grafikart\Http\Handlers;


use Grafikart\Http\Request\ServerRequest;
use Grafikart\Http\Response\Response;

/**
 * MiddlewareInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Grafikart\Http\Handlers
 */
interface MiddlewareInterface
{
     /**
      * @param ServerRequest $request
      * @param RequestHandlerInterface $handler
      * @return Response
     */
     public function process(ServerRequest $request, RequestHandlerInterface $handler): Response;
}