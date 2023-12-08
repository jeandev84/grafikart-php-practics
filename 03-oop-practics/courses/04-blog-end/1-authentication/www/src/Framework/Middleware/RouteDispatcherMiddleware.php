<?php
declare(strict_types=1);

namespace Framework\Middleware;


use Framework\Routing\Route\Route;
use GuzzleHttp\Psr7\Response;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Created by PhpStorm at 06.12.2023
 *
 * @RouteDispatcherMiddleware
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Framework\Middleware
 */
class RouteDispatcherMiddleware
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
     *
     * @param callable $next
     *
     * @return mixed
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
    */
    public function __invoke(ServerRequestInterface $request, callable $next): mixed
    {
        $route = $request->getAttribute(Route::class);

        if (is_null($route)) {
            return $next($request);
        }

        $callback = $route->getAction();

        if (is_string($callback)) {
            $callback = $this->container->get($callback);
        }

        $response = call_user_func_array($callback, [$request]);

        if (is_string($response)) {
            return new Response(200, [], $response);
        } elseif ($response instanceof ResponseInterface) {
            return $response;
        } else {
            throw new \Exception("The response is not a string of an instance of ResponseInterface");
        }
    }
}