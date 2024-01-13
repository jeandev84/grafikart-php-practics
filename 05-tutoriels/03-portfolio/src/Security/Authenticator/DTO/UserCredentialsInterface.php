<?php
declare(strict_types=1);

namespace Grafikart\Security\Authenticator\DTO;


/**
 * UserCredentialsInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Grafikart\Security\Authenticator\DTO
 */
interface UserCredentialsInterface
{

      /**
       * @return string
      */
      public function getUsername(): string;


      /**
       * @return string
      */
      public function getPlainPassword(): string;



      /**
       * @return bool
      */
      public function isRememberMe(): bool;
}