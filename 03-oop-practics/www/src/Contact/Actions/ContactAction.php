<?php
declare(strict_types=1);

namespace App\Contact\Actions;


use App\Contact\Service\MailerService;
use Framework\Http\Response\RedirectResponse;
use Framework\Session\FlashService;
use Framework\Templating\Renderer\RendererInterface;
use Framework\Validation\Validator;
use Psr\Http\Message\ServerRequestInterface;
use Swift_Mailer;

/**
 * Created by PhpStorm at 08.12.2023
 *
 * @ContactAction
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Contact\Actions
 */
class ContactAction
{

      protected string $to;
      protected RendererInterface $renderer;
      protected FlashService $flashService;
      protected Swift_Mailer $mailer;



      public function __construct(
          string            $to,
          RendererInterface $renderer,
          FlashService      $flashService,
          Swift_Mailer      $mailer
      )
      {
          $this->to = $to;
          $this->renderer = $renderer;
          $this->flashService = $flashService;
          $this->mailer  = $mailer;
      }



      /**
       * @param ServerRequestInterface $request
       *
       * @return mixed
      */
      public function __invoke(ServerRequestInterface $request): mixed
      {
           if ($request->getMethod() === 'GET') {
               return $this->renderer->render('@contact/contact');
           }

           $params    = $request->getParsedBody();
           $validator = (new Validator($params))
                        ->required('name', 'email', 'content')
                        ->length('name', 5)
                        ->email('email')
                        ->length('content', 15);

           if ($validator->isValid()) {

               $this->flashService->success('Merci pour votre email');

               $message = new \Swift_Message('Formulaire de contact');
               $message->setBody($this->renderer->render('@contact/email/contact.text', $params));
               $message->addPart($this->renderer->render('@contact/email/contact.html', $params), 'text/html');
               $message->setTo($this->to);
               $message->setFrom($params['email']); // or setReplyTo()
               $this->mailer->send($message);

               return new RedirectResponse((string)$request->getUri());

           } else {
               $errors = $validator->getErrors();
               return $this->renderer->render('@contact/contact', compact('errors'));
           }
      }
}