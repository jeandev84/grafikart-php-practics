<?php
declare(strict_types=1);

namespace App\Security\Token;

use Grafikart\Http\Session\Session;
use Grafikart\Http\Session\SessionInterface;
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
        // TODO: Implement setToken() method.
    }

    /**
     * @inheritDoc
     */
    public function hasToken(): bool
    {
        // TODO: Implement hasToken() method.
    }

    /**
     * @inheritDoc
     */
    public function getToken(): UserTokenInterface
    {
        // TODO: Implement getToken() method.
    }

    /**
     * @inheritDoc
     */
    public function removeToken(UserInterface $user): mixed
    {
        // TODO: Implement removeToken() method.
    }
}