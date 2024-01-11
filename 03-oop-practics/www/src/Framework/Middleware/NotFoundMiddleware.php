<?php
declare(strict_types=1);

namespace Framework\Middleware;

use Psr\Http\Message\ServerRequestInterface;
use GuzzleHttp\Psr7\Response;


/**
 * Created by PhpStorm at 06.12.2023
 *
 * @NotFoundMiddleware
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Framework\Middleware
 *
 * On va le mettre en fin de chaine
 * comme cela si un middleware n'est appele on tombera sur ce middleware
*/
class NotFoundMiddleware
{

    /**
     * @param ServerRequestInterface $request
     *
     * @param callable $next
     *
     * @return mixed
     */
    public function __invoke(ServerRequestInterface $request, callable $next)
    {
        return new Response(404, [], 'Error 404');
    }
}