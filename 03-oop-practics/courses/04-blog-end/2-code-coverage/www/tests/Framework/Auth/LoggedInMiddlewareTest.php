<?php
namespace Tests\Framework\Auth;

use App\Auth\Security\Middleware\ForbiddenMiddleware;
use Framework\Middleware\Security\LoggedInMiddleware;
use Framework\Security\Auth;
use Framework\Middleware\TrailingSlashMiddleware;
use Framework\Security\User\UserInterface;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\ServerRequest;
use Psr\Http\Message\ServerRequestInterface;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\RequestHandlerInterface;

class LoggedInMiddlewareTest extends TestCase
{

    public function makeMiddleware($user)
    {
        $auth = $this->getMockBuilder(Auth::class)->getMock();
        $auth->method('getUser')->willReturn($user);
        return new LoggedInMiddleware($auth);
    }

    public function makeDelegate($calls)
    {
        $delegate = $this->getMockBuilder(RequestHandlerInterface::class)->getMock();
        $response = $this->getMockBuilder(ResponseInterface::class)->getMock();
        $delegate->expects($calls)->method('process')->willReturn($response);
        return $delegate;
    }

    public function testThrowIfNoUser()
    {
        $request = (new ServerRequest('GET', '/demo/'));
        $this->expectException(ForbiddenMiddleware::class);
        $this->makeMiddleware(null)->process(
            $request,
            $this->makeDelegate($this->never())
        );
    }

    public function testNextIfUser()
    {
        $user = $this->getMockBuilder(UserInterface::class)->getMock();
        $request = (new ServerRequest('GET', '/demo/'));
        $this->makeMiddleware($user)->process(
            $request,
            $this->makeDelegate($this->once())
        );
    }
}
