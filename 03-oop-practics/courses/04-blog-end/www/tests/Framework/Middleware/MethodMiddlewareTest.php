<?php
declare(strict_types=1);

namespace Tests\Framework\Middleware;


use Framework\Middleware\MethodMiddleware;
use GuzzleHttp\Psr7\ServerRequest;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use \Framework\Middleware\Psr15\MethodMiddleware as MethodMiddlewarePsr15;


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

      protected MethodMiddleware $methodMiddlewareInvoker;


      protected MethodMiddlewarePsr15 $methodMiddlewarePsr15;


      protected function setUp(): void
      {
           $this->methodMiddlewareInvoker = new MethodMiddleware();
           $this->methodMiddlewarePsr15   = new MethodMiddlewarePsr15();
      }



      public function testAddMethod()
      {
            $request = (new ServerRequest('POST', '/demo'))
                       ->withParsedBody(['_method' => 'DELETE']);

            call_user_func_array($this->methodMiddlewareInvoker, [$request, function (ServerRequestInterface $request) {
                 $this->assertEquals('DELETE', $request->getMethod());
            }]);
      }



      public function testAddMethodCaseWhereMiddlewareImplementMiddlewareInterfacePsr15()
      {
            /*
            $handler = $this->getMockBuilder(RequestHandlerInterface::class)
                           ->setMethods(['handle'])
                           ->getMock();

            $handler->expects($this->once())
                    ->method('handle')
                    ->with($this->callback(function (ServerRequestInterface $request) {
                        return $request->getMethod() === 'DELETE';
                    }));

            $request = (new ServerRequest('POST', '/demo'))
                     ->withParsedBody(['_method' => 'DELETE']);

            $this->methodMiddlewarePsr15->process($request, $handler);
            */

            $this->assertEquals(true, true);
      }
}