<?php
declare(strict_types=1);

namespace App\Middleware;


use Interop\Http\Server\MiddlewareInterface;
use Interop\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Created by PhpStorm at 04.12.2023
 *
 * @TrailingSlashMiddleware
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Middleware
 */
class TrailingSlashMiddleware implements MiddlewareInterface
{

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler)
    {
        $url = (string)$request->getUri();

        if (!empty($url) && $url[-1] === '/') {
            $response = new \GuzzleHttp\Psr7\Response();
            return $response->withHeader('Location', substr($url, 0, -1))
                ->withStatus(301);
        }

        return $handler->handle($request);
    }
}