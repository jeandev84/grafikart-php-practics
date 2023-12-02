<?php
declare(strict_types=1);

namespace App\Security;


use Grafikart\Security\Token\UserToken;
use Grafikart\Security\Token\UserTokenInterface;
use Grafikart\Security\Token\UserTokenStorageInterface;
use Grafikart\Security\UserInterface;

/**
 * Created by PhpStorm at 29.11.2023
 *
 * @UserTokenStorage
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Security\Token
 */
class UserTokenStorage implements UserTokenStorageInterface
{

    const SECURITY_KEY = 'security.key';


    public function setToken(UserInterface $user): UserTokenInterface
    {
        $token = new UserToken($user);

        $_SESSION[self::SECURITY_KEY] = serialize($token);

        return $token;
    }



    public function getToken(): UserTokenInterface
    {
        return unserialize($_SESSION[self::SECURITY_KEY]);
    }




    public function hasToken(): bool
    {
        return isset($_SESSION[self::SECURITY_KEY]);
    }



    public function setRememberMeToken(UserInterface $user)
    {

    }


    public function removeToken(UserInterface $user): bool
    {
         if ($this->hasToken()) {
              unset($_SESSION[self::SECURITY_KEY]);
         }

         return $this->hasToken();
    }



    public function removeRememberMeToken(UserInterface $user)
    {

    }
}