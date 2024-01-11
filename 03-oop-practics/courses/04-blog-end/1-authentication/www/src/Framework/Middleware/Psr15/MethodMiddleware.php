<?php
declare(strict_types=1);

namespace Framework\Middleware\Psr15;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

/**
 * Created by PhpStorm at 06.12.2023
 *
 * @MethodMiddleware
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Framework\Middleware\Psr15
 */
class MethodMiddleware implements MiddlewareInterface
{


    private string $methodKey = '_method';


    /**
     * @inheritDoc
    */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $parsedBody  = $request->getParsedBody();

        // will be moved to the middleware
        if ($this->hasMethod($parsedBody)) {
            $request = $request->withMethod($parsedBody[$this->methodKey]);
        }

        return $handler->handle($request);
    }





    /**
     * @param array $parsedBody
     * @return bool
     */
    private function hasMethod(array $parsedBody): bool
    {
        return $this->existMethodParamInBody($parsedBody) && $this->isAllowedMethods($parsedBody[$this->methodKey]);
    }




    /**
     * @param array $parsedBody
     *
     * @return bool
     */
    private function existMethodParamInBody(array $parsedBody): bool
    {
        return array_key_exists($this->methodKey, $parsedBody);
    }




    /**
     * @param string $method
     *
     * @return bool
     */
    private function isAllowedMethods(string $method): bool
    {
        return in_array($method, ['DELETE', 'PUT', 'PATCH']);
    }
}