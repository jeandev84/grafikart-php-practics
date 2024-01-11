<?php
declare(strict_types=1);

namespace Framework\Middleware;


use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Created by PhpStorm at 06.12.2023
 *
 * @TrailingSlashMiddleware
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Framework\Middleware
 */
class TrailingSlashMiddleware
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
          $uri = $request->getUri()->getPath();

          if (!empty($uri) && $uri[-1] === "/") {
              return (new Response())
                  ->withStatus(301)
                  ->withHeader('Location', substr($uri, 0, -1));
          }

          return $next($request);
      }
}