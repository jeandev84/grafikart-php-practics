<?php
declare(strict_types=1);

namespace App\Middleware;


use Grafikart\Http\Middleware\MiddlewareInterface;
use Grafikart\Http\Request\Request;

/**
 * Created by PhpStorm at 30.11.2023
 *
 * @Authenticated
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Middleware
 */
class Authenticated implements MiddlewareInterface
{

    public function handle(Request $request, callable $next): mixed
    {
        return $next($next);
    }
}