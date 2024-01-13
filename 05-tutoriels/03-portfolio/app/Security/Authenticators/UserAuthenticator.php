<?php
declare(strict_types=1);

namespace App\Security\Authenticators;

use App\Entity\User;
use Grafikart\Security\Authenticator\Contract\AuthenticatorInterface;
use Grafikart\Security\Authenticator\DTO\UserCredentialsInterface;
use Grafikart\Security\User\Provider\UserProviderInterface;
use Grafikart\Security\User\UserInterface;

/**
 * UserAuthenticator
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  App\Security\Authenticators
 */
class UserAuthenticator implements AuthenticatorInterface
{


    /**
     * @param UserProviderInterface $userProvider
    */
    public function __construct(
        protected UserProviderInterface $userProvider
    )
    {
    }


    /**
     * @inheritDoc
    */
    public function authenticate(UserCredentialsInterface $payload): bool
    {
         $username = $payload->getUsername();
         $password = $payload->getPlainPassword();

         $user = $this->userProvider->loadBy([
             'username' => $username,
             'password' => sha1($password)
         ]);

         dd($user);

         return false;
    }



    /**
     * @inheritDoc
    */
    public function getUser(): UserInterface
    {
         return new User();
    }




    /**
     * @inheritDoc
    */
    public function logout(): bool
    {
         return true;
    }




    /**
     * @inheritDoc
    */
    public function isGranted(array $roles): bool
    {
        return ! empty(array_intersect($roles, $this->getUser()->getRoles()));
    }
}