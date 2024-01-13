<?php
declare(strict_types=1);

namespace App\Security\Token;

use Grafikart\Http\Session\Session;
use Grafikart\Http\Session\SessionInterface;
use Grafikart\Security\User\Token\UserToken;
use Grafikart\Security\User\Token\UserTokenInterface;
use Grafikart\Security\User\Token\UserTokenStorageInterface;
use Grafikart\Security\User\UserInterface;

/**
 * UserTokenStorage
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package  App\Security\Token
 */
class UserTokenStorage implements UserTokenStorageInterface
{

    const KEY = 'security.user';


    /**
     * @var SessionInterface
    */
    protected SessionInterface $session;


    /**
     * @param SessionInterface $session
    */
    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }




    /**
     * @inheritDoc
    */
    public function setToken(UserInterface $user): UserTokenInterface
    {
        $token = new UserToken($user);
        $this->session->set(self::KEY, $token->serialize());
        return $token;
    }




    /**
     * @inheritDoc
    */
    public function hasToken(): bool
    {
        return $this->session->has(self::KEY);
    }



    /**
     * @inheritDoc
    */
    public function getToken(): UserTokenInterface
    {
        if (! $this->hasToken()) {
            throw new \Exception("Could not provide user token.");
        }

        $token = $this->session->get(self::KEY);

        return unserialize($token);
    }




    /**
     * @inheritDoc
     */
    public function removeToken(UserInterface $user): bool
    {
         $this->session->destroy();

         return true;
    }
}