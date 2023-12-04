<?php
declare(strict_types=1);

namespace App\Middleware;


use Interop\Http\Server\MiddlewareInterface;
use Interop\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr7Middlewares\Middleware;
use Psr7Middlewares\Middleware\FormatNegotiator;

#use function GuzzleHttp\Psr7\stream_for;


/**
 * Created by PhpStorm at 04.12.2023
 *
 * @GoogleAnalyticMiddleware
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Middleware
 */
class GoogleAnalyticMiddleware implements MiddlewareInterface
{

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler)
    {
        $response = $handler->handle($request);
        $attribute = $request->getAttribute(Middleware::class);
        if (is_array($attribute) && $attribute[FormatNegotiator::KEY] === 'html') {
            $body     = (string)$response->getBody();
            $tag      = '<ga></ga>';
            $body     = str_replace('</body>', $tag . '</body>', $body);
            $body     = stream_for($body);

            return $response->withBody($body);
        }

        return $response;
    }
}