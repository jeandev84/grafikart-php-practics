<?php
declare(strict_types=1);

namespace App\Framework\Middleware\Security;


use Framework\Security\Auth;
use Framework\Security\Exceptions\ForbiddenException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

/**
 * Created by PhpStorm at 09.12.2023
 *
 * @RoleMiddleware
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Framework\Middleware\Security
 */
class RoleMiddleware implements MiddlewareInterface
{


    /**
     * @var Auth
    */
    protected Auth $auth;


    protected string $role;

    public function __construct(
        Auth $auth,
        string $role
    )
    {
        $this->auth = $auth;
        $this->role = $role;
    }

    /**
     * @param ServerRequestInterface $request
     *
     * @param RequestHandlerInterface $handler
     *
     * @return ResponseInterface
     *
     * @throws ForbiddenException
    */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
         $user = $this->auth->getUser();
         if ($user === null || !in_array($this->role, $user->getRoles())) {
              throw new ForbiddenException();
         }
         return $handler->handle($request);
    }
}