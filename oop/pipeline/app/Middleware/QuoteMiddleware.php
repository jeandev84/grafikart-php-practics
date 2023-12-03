<?php
declare(strict_types=1);

namespace App\Middleware;


use Interop\Http\Server\MiddlewareInterface;
use Interop\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ServerRequestInterface;
#use function GuzzleHttp\Psr7\stream_for;

/**
 * Created by PhpStorm at 04.12.2023
 *
 * @QuoteMiddleware
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Middleware
 */
class QuoteMiddleware implements MiddlewareInterface
{

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler)
    {
        $response = $handler->handle($request);
        $body = stream_for('"'. ((string)$response->getBody()) . '"');
        return $response->withBody($body);
    }
}