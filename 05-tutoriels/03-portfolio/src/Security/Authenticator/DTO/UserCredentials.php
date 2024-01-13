<?php
declare(strict_types=1);

namespace Grafikart\Security\Authenticator\DTO;

/**
 * UserCredentials
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Grafikart\Security\Authenticator\DTO
 */
class UserCredentials implements UserCredentialsInterface
{

    /**
     * @param string $username
     * @param string $password
     * @param bool $rememberMe
    */
    public function __construct(
        protected string $username,
        protected string $password,
        protected bool  $rememberMe = false
    )
    {
    }




    /**
     * @inheritDoc
    */
    public function getUsername(): string
    {
        return $this->username;
    }



    /**
     * @inheritDoc
    */
    public function getPlainPassword(): string
    {
        return $this->password;
    }




    /**
     * @inheritDoc
    */
    public function isRememberMe(): bool
    {
        return $this->rememberMe;
    }
}