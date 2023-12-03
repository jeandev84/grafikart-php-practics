<?php
declare(strict_types=1);

namespace App\Middleware;


use Interop\Http\Server\MiddlewareInterface;
use Interop\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Created by PhpStorm at 04.12.2023
 *
 * @AppMiddleware
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Middleware
 */
class AppMiddleware implements MiddlewareInterface
{

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler)
    {
        $response = $handler->handle($request);

        $url = $request->getUri()->getPath();

        if ($url === '/blog') {
            $response->getBody()->write('Je suis sur le blog');
        } elseif ($url === '/contact') {
            $response->getBody()->write('Me contacter');
        } else {
            $response->getBody()->write('Not found');
            $response = $response->withStatus(404);
        }

        return $response;
    }
}