<?php
declare(strict_types=1);

namespace App\Account\Actions;


use App\Auth\Repository\UserRepository;
use Framework\Http\Response\RedirectResponse;
use Framework\Routing\Router;
use Framework\Security\Hash\PasswordHash;
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
       * @param RendererInterface $renderer
       *
       * @param UserRepository $userRepository
      */
      public function __construct(
          RendererInterface $renderer,
          UserRepository $userRepository,
          Router $router
      )
      {
          $this->renderer = $renderer;
          $this->userRepository = $userRepository;
          $this->router = $router;
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
               $this->userRepository->insert([
                   'name'     => $params['username'],
                   'email'    => $params['email'],
                   'password' => PasswordHash::hash($params['password']),
               ]);
               return new RedirectResponse($this->router->generateUri('account.profile'));
           }

           $errors = $validator->getErrors();
           return $this->renderer->render('@account/signup', compact('errors'));
      }
}