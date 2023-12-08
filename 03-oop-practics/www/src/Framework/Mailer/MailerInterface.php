<?php
declare(strict_types=1);

namespace Framework\Mailer;


/**
 * Created by PhpStorm at 08.12.2023
 *
 * @MailerInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Framework\Mailer
 */
interface MailerInterface
{

      /**
       * @param MessageInterface $message
       *
       * @return mixed
      */
      public function send(MessageInterface $message): mixed;
}