<?php
declare(strict_types=1);

namespace App\Middleware;


use Grafikart\Http\Middleware\MiddlewareInterface;
use Grafikart\Http\Request\Request;
use Grafikart\Routing\Router;

/**
 * Created by PhpStorm at 30.11.2023
 *
 * @AppMiddleware
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Middleware
 */
class AppMiddleware implements MiddlewareInterface
{

    public function __construct(Router $router)
    {
    }

    public function handle(Request $request, callable $next): mixed
    {
        // TODO: Implement handle() method.
    }
}