<?php
declare(strict_types=1);

namespace App\Auth\Actions;


use App\Auth\Entity\User;
use App\Auth\Mailer\PasswordResetMailer;
use App\Auth\Repository\UserRepository;
use Framework\Http\Response\RedirectResponse;
use Framework\Routing\Router;
use Framework\Session\FlashService;
use Framework\Templating\Renderer\RendererInterface;
use Framework\Validation\Validator;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Created by PhpStorm at 10.12.2023
 *
 * @PasswordResetAction
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Auth\Actions
 */
class PasswordResetAction
{


    /**
     * @var RendererInterface
     */
    protected RendererInterface $renderer;


    /**
     * @var UserRepository
     */
    protected UserRepository $userRepository;



    /**
     * @var FlashService
    */
    protected FlashService $flashService;



    /**
     * @var Router
    */
    protected Router $router;



    /**
     * @param RendererInterface $renderer
     *
     * @param UserRepository $userRepository
     *
     * @param FlashService $flashService
     *
     * @param Router $router
     */
    public function __construct(
        RendererInterface $renderer,
        UserRepository $userRepository,
        FlashService $flashService,
        Router $router
    )
    {
        $this->renderer = $renderer;
        $this->userRepository = $userRepository;
        $this->flashService = $flashService;
        $this->router = $router;
    }




    /**
     * @param ServerRequestInterface $request
     *
     * @return mixed
    */
    public function __invoke(ServerRequestInterface $request): mixed
    {
         /** @var User $user */
         $user = $this->userRepository->find((int)$request->getAttribute('id'));

         if (
             $user->getPasswordReset() === $request->getAttribute('token') &&
             time() - $user->getPasswordResetAt()->getTimestamp() < 600
         ) {
              if ($request->getMethod() === 'GET') {
                  return $this->renderer->render("@auth/password/reset");
              }

              $params    = $request->getParsedBody();
              $validator = (new Validator($params))
                           ->length('password', 4)
                           ->confirm('password');

              if ($validator->isValid()) {

              } else {
                  return $this->renderer->render("@auth/password/reset", [
                      'errors' => $validator->getErrors()
                  ]);
              }
         }

         $this->flashService->error('Token invalid');
         return new RedirectResponse($this->router->generateUri('auth.password.forgot'));
    }
}