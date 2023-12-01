<?php
declare(strict_types=1);

namespace Grafikart\Security;


use Grafikart\Security\Encoder\UserPasswordEncoderInterface;
use Grafikart\Security\Provider\UserProviderInterface;
use Grafikart\Security\Token\UserTokenStorageInterface;

/**
 * Created by PhpStorm at 28.11.2023
 *
 * @Auth
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Grafikart\Security
 */
class Auth
{


    public function __construct(
        protected UserProviderInterface $provider,
        protected UserTokenStorageInterface $tokenStorage,
        protected UserPasswordEncoderInterface $encoder
    )
    {
    }



    public function attempt(string $username, string $password, bool $rememberMe = false): bool
    {
         $user = $this->provider->loadByUsername($username);

         if (!$user || !$this->encoder->isPasswordValid($user, $password)) {
              return false;
         }

         $this->tokenStorage->setToken($user);

         return true;
    }





     public function isGranted(array $roles)
     {

     }



     public function getUser(): ?UserInterface
     {
         return $this->tokenStorage->getToken()->getUser();
     }




     public function logout(): bool
     {
         if (! $this->tokenStorage->hasToken()) {
              return false;
         }

         return $this->tokenStorage->removeToken($this->getUser());
     }
}