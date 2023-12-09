<?php
declare(strict_types=1);

namespace App\Auth\Actions;


use App\Auth\Mailer\PasswordResetMailer;
use App\Auth\Repository\UserRepository;
use Framework\Database\ORM\Exceptions\NoRecordException;
use Framework\Http\Response\RedirectResponse;
use Framework\Templating\Renderer\RendererInterface;
use Framework\Validation\Validator;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Created by PhpStorm at 09.12.2023
 *
 * @PasswordForgetAction
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Auth\Actions
 */
class PasswordForgetAction
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
     * @var PasswordResetMailer
    */
    protected PasswordResetMailer $mailer;




    /**
     * @param RendererInterface $renderer
     *
     * @param UserRepository $userRepository
     *
     * @param PasswordResetMailer $mailer
     */
    public function __construct(
        RendererInterface $renderer,
        UserRepository $userRepository,
        PasswordResetMailer $mailer
    )
    {
        $this->renderer = $renderer;
        $this->userRepository = $userRepository;
        $this->mailer = $mailer;
    }




    /**
     * @param ServerRequestInterface $request
     *
     * @return mixed
    */
    public function __invoke(ServerRequestInterface $request): mixed
    {
         if ($request->getMethod() === 'GET') {
             return $this->renderer->render('@auth/password');
         }

         $params    = $request->getParsedBody();
         $validator = (new Validator($params))
                      ->notEmpty('email')
                      ->email('email');

         if ($validator->isValid()) {
             try {
                  $user  = $this->userRepository->findBy('email', $params['email']);
                  $token = $this->userRepository->resetPassword($user->id);
                  $this->mailer->send($user->email, [
                      'id'    => $user->id,
                      'token' => $token
                  ]);
                  return new RedirectResponse($request->getUri()->getPath());
             } catch (NoRecordException $e) {
                 $errors = ['email' => 'Aucun utilisateur ne correspond a cet email'];
             }
         }

         $errors = $validator->getErrors();

         return $this->renderer->render("@auth/password", [
             'errors' => $errors
         ]);
    }
}