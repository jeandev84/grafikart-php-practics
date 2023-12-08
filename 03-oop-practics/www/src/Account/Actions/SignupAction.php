<?php
declare(strict_types=1);

namespace App\Account\Actions;


use App\Auth\Repository\UserRepository;
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
       * @param RendererInterface $renderer
       *
       * @param UserRepository $userRepository
      */
      public function __construct(
          RendererInterface $renderer,
          UserRepository $userRepository
      )
      {
          $this->renderer = $renderer;
          $this->userRepository = $userRepository;
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

           }

           $errors = $validator->getErrors();
           return $this->renderer->render('@account/signup', compact('errors'));
      }
}