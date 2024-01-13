<?php
declare(strict_types=1);

namespace App\Entity;

use Grafikart\Security\User\UserInterface;

/**
 * User
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  App\Entity
 */
class User implements UserInterface
{
    const ROLE_USER = 'ROLE_USER';

    protected ?int $id;
    protected ?string $username;
    protected ?string $password;

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(?string $username): User
    {
        $this->username = $username;
        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): User
    {
        $this->password = $password;
        return $this;
    }



    /**
     * @inheritDoc
    */
    public function getIdentifier(): string
    {
       return $this->getUsername();
    }




    /**
     * @inheritDoc
    */
    public function getRoles(): array
    {
        return [self::ROLE_USER];
    }




    /**
     * @inheritDoc
    */
    public function getSalt(): ?string
    {
        return '';
    }



    /**
     * @inheritDoc
    */
    public function eraseCredentials(): void
    {

    }
}