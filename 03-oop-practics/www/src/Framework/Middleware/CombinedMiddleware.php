<?php
declare(strict_types=1);

namespace App\Framework\Middleware;


use App\Framework\Middleware\Pipeline\CombinedMiddlewareHandler;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

/**
 * Created by PhpStorm at 09.12.2023
 *
 * @CombinedMiddleware
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Framework\Middleware
 */
class CombinedMiddleware implements MiddlewareInterface
{


    /**
     * @var ContainerInterface
    */
    protected ContainerInterface $container;


    /**
     * @var array
    */
    protected array $middlewares = [];


    /**
     * @param ContainerInterface $container
     * @param array $middlewares
    */
    public function __construct(ContainerInterface $container, array $middlewares)
    {
        $this->container = $container;
        $this->middlewares = $middlewares;
    }


    /**
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     * @return ResponseInterface
     * @throws \Exception
    */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
         $handler = new CombinedMiddlewareHandler($this->container, $this->middlewares, $handler);
         return $handler->handle($request);
    }
}