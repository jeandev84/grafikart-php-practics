<?php
declare(strict_types=1);

namespace Grafikart\Http\Middleware;


use Grafikart\Http\Request\Request;

/**
 * Created by PhpStorm at 29.11.2023
 *
 * @MiddlewareInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Grafikart\Http\Middleware
 */
interface MiddlewareInterface
{
     public function handle(Request $request, callable $next): mixed;
}