<?php
declare(strict_types=1);

namespace Grafikart\Http\Handlers;


use Grafikart\Http\Request\ServerRequest;
use Grafikart\Http\Response\Response;

/**
 * RequestHandlerInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Grafikart\Http\Handlers
 */
interface RequestHandlerInterface
{
       /**
        * @param ServerRequest $request
        * @return Response
       */
       public function handle(ServerRequest $request): Response;
}