<?php
declare(strict_types=1);

namespace App\Http\Handlers;

use Grafikart\Http\Handlers\RequestHandlerInterface;
use Grafikart\Http\Request\ServerRequest;
use Grafikart\Http\Response\Response;

/**
 * NotFoundHandler
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  App\Http\Handlers
 */
class NotFoundHandler implements RequestHandlerInterface
{

    /**
     * @inheritDoc
    */
    public function handle(ServerRequest $request): Response
    {
         return new Response(__METHOD__);
    }
}