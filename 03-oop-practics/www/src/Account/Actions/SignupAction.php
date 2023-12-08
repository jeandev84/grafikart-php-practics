<?php
declare(strict_types=1);

namespace App\Account\Actions;


use App\Auth\Entity\User;
use App\Auth\Repository\UserRepository;
use App\Auth\Security\DatabaseAuth;
use Framework\Database\Hydrator;
use Framework\Http\Response\RedirectResponse;
use Framework\Routing\Router;
use Framework\Security\Hash\PasswordHash;
use Framework\Session\FlashService;
use Framework\Templating\Renderer\RendererInterface;
use Framework\Validation\Validator;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Created by PhpStorm at 08.12.2023
 *
 * @SignupAction
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Account\Actions
 */
class SignupAction
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
       * @var Router
      */
      protected Router $router;


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
       * @param UserRepository $userRepository
       * @param Router $router
       * @param DatabaseAuth $auth
       * @param FlashService $flashService
      */
      public function __construct(
          RendererInterface $renderer,
          UserRepository $userRepository,
          Router $router,
          DatabaseAuth $auth,
          FlashService $flashService
      )
      {
          $this->renderer = $renderer;
          $this->userRepository = $userRepository;
          $this->router = $router;
          $this->auth   = $auth;
          $this->flashService = $flashService;
      }



      /**
       * @param ServerRequestInterface $request
       *
       * @return mixed
      */
      public function __invoke(ServerRequestInterface $request): mixed
      {
          if ($request->getMethod() === 'GET') {
              return $this->renderer->render('@account/signup');
          }

          $params    = $request->getParsedBody();
          $validator = (new Validator($params))
                       ->required('username', 'email', 'password', 'password_confirm')
                       ->length('username', 5)
                       ->email('email')
                       ->confirm('password')
                       ->unique('username', $this->userRepository)
                       ->unique('username', $this->userRepository);

           if ($validator->isValid()) {
               $userParams = [
                   'name'     => $params['username'],
                   'email'    => $params['email'],
                   'password' => PasswordHash::hash($params['password']),
               ];

               $this->userRepository->insert($userParams);
               $user = Hydrator::hydrate($userParams, new User());
               $user->id = (int)$this->userRepository->getPdo()->lastInsertId();
               $this->auth->setUser($user);
               $this->flashService->success("Votre compte a bien ete cree");
               return new RedirectResponse($this->router->generateUri('account.profile'));
           }

           $errors = $validator->getErrors();
           return $this->renderer->render('@account/signup', compact('errors'));
      }
}