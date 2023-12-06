<?php
declare(strict_types=1);

namespace Tests\Framework\Middleware;


use Framework\Middleware\MethodMiddleware;
use GuzzleHttp\Psr7\ServerRequest;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Created by PhpStorm at 06.12.2023
 *
 * @MethodMiddlewareTest
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Tests\Framework\Middleware
 */
class MethodMiddlewareTest extends TestCase
{

      protected $middleware;


      protected function setUp(): void
      {
           $this->middleware = new MethodMiddleware();
      }


      public function testAddMethod()
      {
            $request = (new ServerRequest('POST', '/demo'))
                       ->withParsedBody(['_method' => 'DELETE']);

            call_user_func_array($this->middleware, [$request, function (ServerRequestInterface $request) {
                 $this->assertEquals('DELETE', $request->getMethod());
            }]);
      }
}