<?php
declare(strict_types=1);

namespace Framework\Middleware;


use Framework\Routing\Router;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Created by PhpStorm at 06.12.2023
 *
 * @RouterMiddleware
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Framework\Middleware
 */
class RouterMiddleware
{

    /**
     * @var Router
    */
    protected Router $router;



    /**
     * @param Router $router
    */
    public function __construct(Router $router)
    {
        $this->router = $router;
    }



    /**
     * @param ServerRequestInterface $request
     *
     * @param callable $next
     *
     * @return mixed
    */
    public function __invoke(ServerRequestInterface $request, callable $next)
    {
        $route = $this->router->match($request);

        // Si la route n' a pas ete trouve on passe au middleware suivant par example NotFoundMiddleware
        if (! $route) {
            return $next($request);
        }

        // Si on a trouve une route alors on ajoute des elements a ma requette et on passe au middleware suivant
        $params  = $route->getParams();
        $request = array_reduce(array_keys($params), function (ServerRequestInterface $request, $key) use ($params) {
            return $request->withAttribute($key, $params[$key]);
        }, $request);

        $request = $request->withAttribute(get_class($route), $route);

        return $next($request);
    }
}