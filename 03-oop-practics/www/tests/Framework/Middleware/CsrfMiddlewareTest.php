<?php
declare(strict_types=1);

namespace Tests\Framework\Middleware;


use Framework\Middleware\CsrfMiddleware;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\ServerRequest;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;


/**
 * Created by PhpStorm at 06.12.2023
 *
 * @CsrfMiddlewareTest
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Tests\Framework\Middleware
 */
class CsrfMiddlewareTest extends TestCase
{
     protected $session;

     protected CsrfMiddleware $middleware;

     public function setUp(): void
     {
         $this->session    = [];
         $this->middleware = new CsrfMiddleware($this->session);
     }



    public function testLetGetRequestPass()
    {
        $handler = $this->getMockBuilder(RequestHandlerInterface::class)
                       ->setMethods(['handle'])
                       ->getMock();

        // Je m' attends a ce que la method "handle" soit appele une seune fois (once)
        $handler->expects($this->once())
                ->method('handle')
                ->willReturn(new Response())
        ;

        $request = (new ServerRequest('GET', '/demo'));

        $this->middleware->process($request, $handler);
    }




    public function testBlockPostRequestWithoutCsrf()
    {
        $handler = $this->getMockBuilder(RequestHandlerInterface::class)
            ->setMethods(['handle'])
            ->getMock();

        // Je m' attends a ce que la method "handle" ne soit jamais appele  (never)
        $handler->expects($this->never())->method('handle')->willReturn(new Response());
        $request = (new ServerRequest('POST', '/demo'));
        $this->expectException(\Exception::class);
        $this->middleware->process($request, $handler);
    }





    public function testBlockPostRequestWithInvalidCsrf()
    {
        $handler = $this->getMockBuilder(RequestHandlerInterface::class)
            ->setMethods(['handle'])
            ->getMock();

        // Je m' attends a ce que la method "handle" ne soit jamais appele  (never)
        $handler->expects($this->never())->method('handle')->willReturn(new Response());
        $this->middleware->generateToken();
        $request = (new ServerRequest('POST', '/demo'));
        $request = $request->withParsedBody(['_csrf' => 'azeaz']);
        $this->expectException(\Exception::class);
        $this->middleware->process($request, $handler);
    }



    public function testLetPostWithTokenPass()
    {
        $handler = $this->getMockBuilder(RequestHandlerInterface::class)
                        ->setMethods(['handle'])
                        ->getMock();

        // Je m' attends a ce que la method "handle" soit appele une seune fois (once)
        $handler->expects($this->once())->method('handle')->willReturn(new Response());

        $request = (new ServerRequest('POST', '/demo'));
        $token   = $this->middleware->generateToken();
        $request = $request->withParsedBody(['_csrf' => $token]);
        $this->middleware->process($request, $handler);
    }





    public function testLetPostWithTokenPassOnce()
    {
        $handler = $this->getMockBuilder(RequestHandlerInterface::class)
                        ->setMethods(['handle'])
                        ->getMock();

        // Je m' attends a ce que la method "handle" soit appele une seune fois (once)
        $handler->expects($this->once())->method('handle')->willReturn(new Response());

        $request = (new ServerRequest('POST', '/demo'));
        $token   = $this->middleware->generateToken();
        $request = $request->withParsedBody(['_csrf' => $token]);
        $this->middleware->process($request, $handler);
        $this->expectException(\Exception::class);
        $this->middleware->process($request, $handler);
    }



    public function testLimitTheTokenNumber()
    {
        $token = '';
        for ($i = 0; $i < 100; ++$i) {
            $token = $this->middleware->generateToken();
        }

        $this->assertCount(50, $this->session['csrf']);
        $this->assertEquals($token, $this->session['csrf'][49]);
    }
}