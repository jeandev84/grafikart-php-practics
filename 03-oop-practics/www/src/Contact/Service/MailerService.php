<?php
declare(strict_types=1);

namespace App\Contact\Service;


use Framework\Templating\Renderer\RendererInterface;
use Swift_Mailer;

/**
 * Created by PhpStorm at 08.12.2023
 *
 * @MailerService
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Contact\Service
 */
class MailerService
{

       protected Swift_Mailer $mailer;
       protected RendererInterface $renderer;
       protected string $to;



       /**
        * @param Swift_Mailer $mailer
        * @param RendererInterface $renderer
        * @param string $to
       */
       public function __construct(Swift_Mailer $mailer, RendererInterface $renderer, string $to)
       {
            $this->renderer = $renderer;
            $this->to  = $to;
       }




       /**
        * @param string $subject
        * @param string $template
        * @param array $params
        * @return int
      */
       public function send(string $subject, string $template, array $params = []): int
       {
           $message = new \Swift_Message($subject);
           $message->setBody($this->renderer->render($template.'.text', $params));
           $message->addPart($this->renderer->render($template. '.html', $params), 'text/html');
           $message->setTo($this->to);
           $message->setFrom($params['email']); // or setReplyTo()
           return $this->mailer->send($message);
       }
}