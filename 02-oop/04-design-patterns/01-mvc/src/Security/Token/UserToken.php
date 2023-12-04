<?php
declare(strict_types=1);

namespace Grafikart\Security\Token;


use Grafikart\Security\UserInterface;

/**
 * Created by PhpStorm at 02.12.2023
 *
 * @UserToken
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Grafikart\Security\Token
 */
class UserToken implements UserTokenInterface
{
     protected UserInterface $user;

     public function __construct(UserInterface $user)
     {
         $this->user = $user;
     }

    public function getUser(): UserInterface
    {
        return $this->user;
    }
}