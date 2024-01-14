<?php
declare(strict_types=1);

namespace App\Http\Middlewares;

use Grafikart\Container\Container;
use Grafikart\Http\Handlers\MiddlewareInterface;
use Grafikart\Http\Handlers\RequestHandlerInterface;
use Grafikart\Http\Request\ServerRequest;
use Grafikart\Http\Response\Response;
use Grafikart\Routing\Exception\RouteNotfoundException;
use Grafikart\Routing\Router;

/**
 * RouteDispatchedMiddleware
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  App\Http\Middlewares
 */
class RouteDispatchedMiddleware implements MiddlewareInterface
{


    /**
     * @var Container
    */
    protected Container $app;

    /**
     * @var Router
    */
    protected Router $router;


    /**
     * @param Container $app
    */
    public function __construct(Container $app)
    {
        $this->app    = $app;
        $this->router = $app[Router::class];
    }




    /**
     * @inheritDoc
    */
    public function process(ServerRequest $request, RequestHandlerInterface $handler): Response
    {
        $path      = $request->getPath();
        $method    = $request->getMethod();
        $route     = $this->router->match($method, $path);

        #dd($this->router->getRoutes());

        if (!$route) {
            return $handler->handle($request);
        }


        $request->withAttributes([
            '_route' => $route,
        ]);

        $callback    = $route->getAction();
        $middlewares = $route->getMiddlewares();

        if (is_array($callback)) {
            [$controller, $action] = $callback;
            $callback = [new $controller($this->app), $action];
            $request->withAttributes([
                '_controller' => "$controller::$action"
            ]);
        }

        # dump($route);

        return call_user_func_array($callback, [$request]);
    }
}