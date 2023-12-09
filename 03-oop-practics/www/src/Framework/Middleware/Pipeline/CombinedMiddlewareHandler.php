<?php
declare(strict_types=1);

namespace App\Framework\Middleware\Pipeline;


use GuzzleHttp\Psr7\Response;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

/**
 * Created by PhpStorm at 09.12.2023
 *
 * @CombinedMiddlewareHandler
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Framework\Middleware\Pipeline
 */
class CombinedMiddlewareHandler implements RequestHandlerInterface
{

    /**
     * @var array
    */
    protected array $middlewares = [];


    /**
     * @var int
    */
    protected int $index = 0;


    /**
     * @var ContainerInterface
    */
    protected ContainerInterface $container;



    /**
     * @var RequestHandlerInterface
    */
    protected RequestHandlerInterface $handler;


    /**
     * @param ContainerInterface $container
     *
     * @param array $middlewares
     *
     * @param RequestHandlerInterface $handler
    */
    public function __construct(
        ContainerInterface $container,
        array $middlewares,
        RequestHandlerInterface $handler
    )
    {
        $this->container   = $container;
        $this->middlewares = $middlewares;
        $this->handler     = $handler;
    }





    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     * @throws \Exception
    */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $middleware = $this->getMiddleware();

        if (is_callable($middleware)) {
            $response =  call_user_func_array($middleware, [$request, [$this, 'handle']]);
            if (is_string($response)) {
                return new Response(200, [], $response);
            }
            return $response;
        } elseif ($middleware instanceof MiddlewareInterface) {
            return $middleware->process($request, $this);
        }
        return $this->handler->handle($request);
    }



    private function getMiddleware(): mixed
    {
        if (array_key_exists($this->index, $this->middlewares)) {
            $middleware = $this->middlewares[$this->index];
            if (is_string($this->middlewares[$this->index])) {
                $middleware =  $this->container->get($this->middlewares[$this->index]);
            }
            $this->index++;
            return $middleware;
        }

        return null;
    }
}