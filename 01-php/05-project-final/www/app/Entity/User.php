<?php
declare(strict_types=1);

namespace App\Entity;


use Grafikart\Security\UserInterface;

/**
 * Created by PhpStorm at 29.11.2023
 *
 * @User
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Entity
 */
class User implements UserInterface
{

     protected ?int $id = null;
     protected ?string $username = null;
     protected ?string $password = null;
     protected array $roles = [];

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }


    /**
     * @return string|null
     */
    public function getUsername(): ?string
    {
        return $this->username;
    }


    /**
     * @param string|null $username
     *
     * @return $this
    */
    public function setUsername(?string $username): self
    {
        $this->username = $username;

        return $this;
    }



    /**
     * @return string|null
    */
    public function getPassword(): ?string
    {
        return $this->password;
    }




    /**
     * @param string|null $password
     *
     * @return $this
    */
    public function setPassword(?string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getRoles(): array
    {
         return $this->roles;
    }

    public function getIdentifier(): mixed
    {
        return $this->username;
    }

    public function getSalt(): string
    {
         return '';
    }
}