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
     * @var string|null
    */
    public ?string $role = null;




    /**
     * @var string|null
    */
    public ?string $passwordReset = null;




    /**
     * @var \DateTime|null
    */
    public ?\DateTime $passwordResetAt = null;


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
    public function getEmail(): ?string
    {
        return $this->email;
    }




    /**
     * @return string|null
    */
    public function getPasswordReset(): ?string
    {
        return $this->passwordReset;
    }


    /**
     * @param \DateTime|string $date
     *
     * @return $this
     *
     * @throws \Exception
    */
    public function setPasswordResetAt(\DateTime|string $date): self
    {
         if (is_string($date)) {
             $date = new \DateTime($date);
         }

         $this->passwordResetAt = $date;

         return $this;
    }




    /**
     * @return \DateTime|null
    */
    public function getPasswordResetAt(): ?\DateTime
    {
        return $this->passwordResetAt;
    }


    /**
     * @param string $passwordReset
     *
     * @return $this
    */
    public function setPasswordReset(string $passwordReset): self
    {
        $this->passwordReset = $passwordReset;

        return $this;
    }


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
        return [$this->role];
    }


    /**
     * @param string $token
     * @return bool
    */
    public function matchPasswordToken(string $token): bool
    {
         return $this->passwordReset === $token;
    }




    /**
     * @return bool
    */
    public function expiredPasswordToken(): bool
    {
        return (time() - $this->getPasswordResetAt()?->getTimestamp() < 600);
    }
}