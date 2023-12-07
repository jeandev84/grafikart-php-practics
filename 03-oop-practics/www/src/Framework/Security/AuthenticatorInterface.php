<?php
declare(strict_types=1);

namespace Framework\Security;


use Framework\Security\User\UserInterface;

/**
 * Created by PhpStorm at 07.12.2023
 *
 * @AuthenticatorInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Framework\Security
 */
interface AuthenticatorInterface
{

     /**
      * @return UserInterface|null
     */
     public function getUser(): ?UserInterface;
}