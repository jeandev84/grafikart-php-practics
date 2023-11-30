<?php
declare(strict_types=1);

namespace Grafikart\Http\Middleware;


use Grafikart\Http\Request\Request;

/**
 * Created by PhpStorm at 29.11.2023
 *
 * @Pipeline
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Grafikart\Http\Middleware
 */
class Pipeline
{
       private  $start;


       public function __construct()
       {
           $this->start = function (Request $request, callable $next) {};
       }


       public function pipe(MiddlewareInterface $middleware): self
       {
             return $this;
       }



       public function handle(Request $request): mixed
       {
             return '';
       }
}