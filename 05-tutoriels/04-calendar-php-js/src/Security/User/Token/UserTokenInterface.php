<?php
declare(strict_types=1);

namespace Grafikart\Security\User\Token;


use Grafikart\Security\User\UserInterface;

/**
 * UserTokenInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Grafikart\Security\User\Token
 */
interface UserTokenInterface
{
      /**
       * @return UserInterface
     */
     public function getUser(): UserInterface;
}