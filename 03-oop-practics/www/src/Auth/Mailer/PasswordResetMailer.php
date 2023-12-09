<?php
declare(strict_types=1);

namespace App\Auth\Mailer;


use Framework\Templating\Renderer\RendererInterface;

/**
 * Created by PhpStorm at 09.12.2023
 *
 * @PasswordResetMailer
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Auth\Mailer
 */
class PasswordResetMailer
{

       /**
        * @var \Swift_Mailer
       */
       protected \Swift_Mailer $mailer;


       /**
        * @var RendererInterface
       */
       protected RendererInterface $renderer;



       /**
        * @var string
       */
       protected string $from;


       /**
         * @param \Swift_Mailer $mailer
         * @param RendererInterface $renderer
         * @param string $from
       */
       public function __construct(
           \Swift_Mailer $mailer,
           RendererInterface $renderer,
           string $from
       )
       {
           $this->mailer   = $mailer;
           $this->renderer = $renderer;
           $this->from     = $from;
       }


       /**
        * @param string $to
        *
        * @param array $params
        *
        * @return int
       */
       public function send(string $to, array $params): int
       {
           $message = new \Swift_Message("Reinitialisation de votre mot de passe", $this->renderer->render("@auth/email/password.text", $params));
           $message->addPart($this->renderer->render("@auth/email/password.html", $params), 'text/html');
           $message->setTo($to);
           $message->setFrom($this->from);
           return $this->mailer->send($message);
       }
}