<?php
declare(strict_types=1);

namespace App\Auth\Security\Middleware;


use Framework\Http\Response\RedirectResponse;
use Framework\Security\Exceptions\ForbiddenException;
use Framework\Security\User\UserInterface;
use Framework\Session\FlashService;
use Framework\Session\SessionInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

/**
 * Created by PhpStorm at 08.12.2023
 *
 * @ForbiddenMiddleware
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Auth\Security\Middleware
 */
class ForbiddenMiddleware implements MiddlewareInterface
{

    /**
     * @var string
    */
    protected string $loginPath;



    /**
     * @var SessionInterface
    */
    protected SessionInterface $session;



    /**
     * @param string $loginPath
     *
     * @param SessionInterface $session
    */
    public function __construct(string $loginPath, SessionInterface $session)
    {
        $this->loginPath = $loginPath;
        $this->session   = $session;
    }





    /**
     * @inheritDoc
    */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        try {
            return $handler->handle($request);
        } catch (ForbiddenException $exception) {
            return $this->redirectLogin($request);
        } catch (\TypeError $error) {
            if (stripos($error->getMessage(), UserInterface::class)) {
                return $this->redirectLogin($request);
            }
        }
        return $this->redirectLogin($request);
    }



    private function redirectLogin(ServerRequestInterface $request): RedirectResponse
    {
        $this->session->set('auth.redirect', $request->getUri()->getPath());
        (new FlashService($this->session))->error("Vous devez posseder un compte pour acceder a cette page.");
        return new RedirectResponse($this->loginPath);
    }
}