<?php
declare(strict_types=1);

namespace Framework\Middleware\Contract;


use Psr\Http\Message\ServerRequestInterface;

/**
 * Created by PhpStorm at 06.12.2023
 *
 * @MiddlewareInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Framework\Middleware\Contract
 */
interface MiddlewareInterface
{

    /**
     * @param ServerRequestInterface $request
     *
     * @param callable $next
     *
     * @return mixed
    */
    public function __invoke(ServerRequestInterface $request, callable $next): mixed;
}