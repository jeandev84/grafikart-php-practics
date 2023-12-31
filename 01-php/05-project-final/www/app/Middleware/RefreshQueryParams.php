<?php
declare(strict_types=1);

namespace App\Middleware;


use Grafikart\Http\Middleware\MiddlewareInterface;
use Grafikart\Http\Request\Request;
use Grafikart\Http\Response\RedirectResponse;

/**
 * Created by PhpStorm at 29.11.2023
 *
 * @RefreshQueryParams
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Middleware
 */
class RefreshQueryParams implements MiddlewareInterface
{

       public function handle(Request $request, callable $next): mixed
       {
            if ($request->queries->equalTo('page', '1')) {
             // Reecrire l' url sans le parametre ?page
             # Example if URL : http://localhost:8000/blog/tutoriels?page=1&param2=2
             # will be redirect to http://localhost:8000/blog/tutoriels?param2=2
              $request->queries->remove('page');
              $uri = $request->uri($request->queries->all());
              return new RedirectResponse($uri, 301);
           }

          return $next($request);
       }
}