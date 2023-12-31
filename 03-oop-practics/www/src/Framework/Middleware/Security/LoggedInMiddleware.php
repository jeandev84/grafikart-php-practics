<?php
declare(strict_types=1);

namespace Framework\Middleware\Security;


use Framework\Security\Auth;
use Framework\Security\Exceptions\ForbiddenException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

/**
 * Created by PhpStorm at 07.12.2023
 *
 * @LoggedInMiddleware
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Framework\Middleware\Security
 */
class LoggedInMiddleware implements MiddlewareInterface
{

    /**
     * @var Auth
    */
    protected Auth $auth;



    /**
     * @param Auth $auth
    */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }




    /**
     * @inheritDoc
    */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
          $user = $this->auth->getUser();

          if (is_null($user)) {
               throw new ForbiddenException();
          }

          return $handler->handle($request->withAttribute('user', $user));
    }
}