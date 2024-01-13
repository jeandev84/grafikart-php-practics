<?php
declare(strict_types=1);

namespace Grafikart\Http;


/**
 * HttpKernelInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Grafikart\Http
 */
interface HttpKernelInterface
{
    /**
     * @param ServerRequest $request
     *
     * @return Response
    */
    public function handle(ServerRequest $request): Response;
}