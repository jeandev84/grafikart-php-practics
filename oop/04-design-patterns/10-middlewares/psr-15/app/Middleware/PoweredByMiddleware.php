<?php
declare(strict_types=1);

namespace App\Middleware;


use Interop\Http\Server\MiddlewareInterface;
use Interop\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Created by PhpStorm at 03.12.2023
 *
 * @PoweredByMiddleware
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Middleware
 */
class PoweredByMiddleware implements MiddlewareInterface
{

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler)
    {
         $response = $handler->handle($request);
         return $response->withHeader('X-Powered-By', 'Grafikart');
    }
}