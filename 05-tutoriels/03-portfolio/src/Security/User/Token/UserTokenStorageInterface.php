<?php
declare(strict_types=1);

namespace Grafikart\Security\User\Token;


use Grafikart\Security\User\UserInterface;

/**
 * UserTokenStorageInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Grafikart\Security\User\Token
 */
interface UserTokenStorageInterface
{

      /**
       * @param UserInterface $user
       * @return UserTokenInterface
      */
      public function setToken(UserInterface $user): UserTokenInterface;



      /**
       * @return bool
      */
      public function hasToken(): bool;




      /**
       * @return UserTokenInterface
      */
      public function getToken(): UserTokenInterface;



      /**
       * @param UserInterface $user
       * @return mixed
      */
      public function removeToken(UserInterface $user): mixed;
}