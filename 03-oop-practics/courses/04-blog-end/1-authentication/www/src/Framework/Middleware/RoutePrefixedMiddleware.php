<?php
declare(strict_types=1);

namespace Framework\Middleware;


use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

/**
 * Created by PhpStorm at 08.12.2023
 *
 * @RoutePrefixedMiddleware
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Framework\Middleware
 */
class RoutePrefixedMiddleware implements MiddlewareInterface
{


    protected ContainerInterface $container;

    protected string $prefix;

    protected string $middleware;


    public function __construct(
        ContainerInterface $container,
        string $prefix,
        string $middleware
    )
    {
        $this->container   = $container;
        $this->prefix      = $prefix;
        $this->middleware  = $middleware;
    }



    /**
     * @inheritDoc
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
          $path = $request->getUri()->getPath();

          if (stripos($path, $this->prefix) === 0) {
              return $this->container->get($this->middleware)->process($request, $handler);
          }

          return $handler->handle($request);
    }
}