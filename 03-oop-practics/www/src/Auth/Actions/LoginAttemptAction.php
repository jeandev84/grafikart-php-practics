<?php
declare(strict_types=1);

namespace App\Auth\Actions;


use App\Auth\Security\DatabaseAuth;
use Framework\Actions\RouterAwareAction;
use Framework\Database\ORM\Exceptions\NoRecordException;
use Framework\Routing\Router;
use Framework\Session\FlashService;
use Framework\Templating\Renderer\RendererInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Created by PhpStorm at 08.12.2023
 *
 * @LoginAttemptAction
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Auth\Actions
 */
class LoginAttemptAction
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
     * @var Router
    */
    protected Router $router;


    /**
     * @var FlashService
    */
    protected FlashService $flashService;


    use RouterAwareAction;


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
        Router $router,
        FlashService $flashService
    )
    {
        $this->renderer     = $renderer;
        $this->auth         = $auth;
        $this->router       = $router;
        $this->flashService = $flashService;
    }




    /**
     * @param ServerRequestInterface $request
     *
     * @return mixed
     *
     * @throws NoRecordException
    */
    public function __invoke(ServerRequestInterface $request): mixed
    {
        $params = $request->getParsedBody();
        $user = $this->auth->login($params['username'], $params['password']);

        if ($user) {
            return $this->redirect('admin');
        }

        $this->flashService->error("Identifiant ou mot de passe incorrect");

        return $this->redirect('auth.login');
    }
}