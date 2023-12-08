<?php
declare(strict_types=1);

namespace App\Auth\Middleware;


use Framework\Http\Response\RedirectResponse;
use Framework\Security\Exceptions\ForbiddenException;
use Framework\Session\FlashService;
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
 * @package App\Auth\Middleware
 */
class ForbiddenMiddleware implements MiddlewareInterface
{


    /**
     * @var string
    */
    protected string $loginPath;



    /**
     * @var FlashService
    */
    protected FlashService $flashService;



    /**
     * @param string $loginPath
     *
     * @param FlashService $flashService
    */
    public function __construct(string $loginPath, FlashService $flashService)
    {
        $this->loginPath    = $loginPath;
        $this->flashService = $flashService;
    }




    /**
     * @inheritDoc
    */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        try {
            return $handler->handle($request);
        } catch (ForbiddenException $exception) {
            $this->flashService->error("Vous devez posseder un compte pour acceder a cette page.");
        }
        return new RedirectResponse($this->loginPath);
    }
}