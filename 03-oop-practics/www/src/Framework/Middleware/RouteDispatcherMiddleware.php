<?php
declare(strict_types=1);

namespace Framework\Middleware;


use App\Framework\Middleware\CombinedMiddleware;
use Framework\Routing\Route\Route;
use GuzzleHttp\Psr7\Response;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

/**
 * Created by PhpStorm at 06.12.2023
 *
 * @RouteDispatcherMiddleware
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Framework\Middleware
 */
class RouteDispatcherMiddleware implements MiddlewareInterface
{


    /**
     * @var ContainerInterface
    */
    protected ContainerInterface $container;



    /**
     * @param ContainerInterface $container
    */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }


    /**
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     * @return ResponseInterface
     * @throws \Exception
    */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        /** @var Route $route */
        $route = $request->getAttribute(Route::class);

        if (is_null($route)) {
            return $handler->handle($request);
        }

        $middlewares   = $route->getMiddlewares();
        $middlewares[] = $route->getAction(); // L'action est pris en compte comme un middleware

        return (new CombinedMiddleware($this->container, $middlewares))->process($request, $handler);
    }
}