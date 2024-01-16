<?php
declare(strict_types=1);

namespace App\Http\Middlewares;

use Grafikart\Http\Handlers\MiddlewareInterface;
use Grafikart\Http\Handlers\RequestHandlerInterface;
use Grafikart\Http\Request\ServerRequest;
use Grafikart\Http\Response\Response;

/**
 * SessionStartedMiddleware
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  App\Http\Middlewares
 */
class SessionStartedMiddleware implements MiddlewareInterface
{

    /**
     * @inheritDoc
    */
    public function process(ServerRequest $request, RequestHandlerInterface $handler): Response
    {

    }
}