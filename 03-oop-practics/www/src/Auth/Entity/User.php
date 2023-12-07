<?php
declare(strict_types=1);

namespace App\Auth\Entity;


use Framework\Security\User\UserInterface;

/**
 * Created by PhpStorm at 08.12.2023
 *
 * @User
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Auth\Entity
 */
class User implements UserInterface
{


    /**
     * @var int|null
    */
    public ?int $id = null;



    /**
     * @var string|null
    */
    public ?string $username = null;


    /**
     * @var string|null
    */
    public ?string $email = null;


    /**
     * @var string|null
    */
    public ?string $password = null;



    /**
     * @inheritDoc
    */
    public function getUsername(): string
    {
        return $this->username;
    }





    /**
     * @return string|null
    */
    public function getPassword(): ?string
    {
        return $this->password;
    }



    /**
     * @inheritDoc
    */
    public function getRoles(): array
    {
        return [];
    }
}