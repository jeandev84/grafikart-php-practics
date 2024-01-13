<?php
declare(strict_types=1);

namespace Grafikart\Http\Kernel;


use Grafikart\Http\Request\ServerRequest;
use Grafikart\Http\Response\Response;

/**
 * HttpKernelInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Grafikart\Http\Kernel
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