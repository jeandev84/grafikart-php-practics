<?php
declare(strict_types=1);

namespace App\Auth\Actions;


use App\Auth\Security\DatabaseAuth;
use Framework\Actions\RouterAwareAction;
use Framework\Http\Response\RedirectResponse;
use Framework\Routing\Router;
use Framework\Session\FlashService;
use Framework\Templating\Renderer\RendererInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Created by PhpStorm at 08.12.2023
 *
 * @LogoutAction
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Auth\Actions
 */
class LogoutAction
{

    /**
     * @var RendererInterface
     */
    protected RendererInterface $renderer;


    /**
     * @var DatabaseAuth
     */
    protected DatabaseAuth $auth;



    /**
     * @var FlashService
     */
    protected FlashService $flashService;



    /**
     * @param RendererInterface $renderer
     *
     * @param DatabaseAuth $auth
     * @param Router $router
     * @param FlashService $flashService
     */
    public function __construct(
        RendererInterface $renderer,
        DatabaseAuth $auth,
        FlashService $flashService
    )
    {
        $this->renderer     = $renderer;
        $this->auth         = $auth;
        $this->flashService = $flashService;
    }



    public function __invoke(ServerRequestInterface $request)
    {
         $this->auth->logout();
         $this->flashService->success("Vous etre maintenant deconnecte");
         return new RedirectResponse('/');
    }
}