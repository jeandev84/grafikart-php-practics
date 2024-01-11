<?php
declare(strict_types=1);

namespace Framework\Middleware;


use Psr\Http\Message\ServerRequestInterface;

/**
 * Created by PhpStorm at 06.12.2023
 *
 * @MethodMiddleware
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Framework\Middleware
 */
class MethodMiddleware
{

      private string $methodKey = '_method';



      /**
       * @param ServerRequestInterface $request
       *
       * @param callable $next
       *
       * @return mixed
      */
      public function __invoke(ServerRequestInterface $request, callable $next)
      {
            $parsedBody  = $request->getParsedBody();

            // will be moved to the middleware
            if ($this->hasMethod($parsedBody)) {
                $request = $request->withMethod($parsedBody[$this->methodKey]);
            }

            return $next($request);
      }




      /**
       * @param array $parsedBody
       * @return bool
     */
      private function hasMethod(array $parsedBody): bool
      {
          return $this->existMethodParamInBody($parsedBody) && $this->isAllowedMethods($parsedBody[$this->methodKey]);
      }




      /**
       * @param array $parsedBody
       *
       * @return bool
      */
      private function existMethodParamInBody(array $parsedBody): bool
      {
          return array_key_exists($this->methodKey, $parsedBody);
      }




      /**
       * @param string $method
       *
       * @return bool
      */
      private function isAllowedMethods(string $method): bool
      {
          return in_array($method, ['DELETE', 'PUT', 'PATCH']);
      }
}