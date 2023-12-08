<?php
declare(strict_types=1);

namespace Framework\Mailer;


use Psr\Container\ContainerInterface;


/**
 * Created by PhpStorm at 08.12.2023
 *
 * @SwiftMailerFactory
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Framework\Mailer
 */
class SwiftMailerFactory
{

      public function __invoke(ContainerInterface $container): \Swift_Mailer
      {
           if ($container->get('env') === 'production') {
                $transport = new \Swift_SendmailTransport();
           } else {
               $transport = new \Swift_SmtpTransport('localhost', 1025);
           }
           return new \Swift_Mailer($transport);
      }
}