<?php
declare(strict_types=1);

namespace App\Account\Entity;


use App\Auth\Entity\User;

/**
 * Created by PhpStorm at 09.12.2023
 *
 * @UserAccount
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Account\Enity
 */
class UserAccount extends User
{
      protected ?string $firstname = null;
      protected ?string $lastname = null;


    /**
     * @return string|null
     */
    public function getFirstname(): ?string
    {
        return $this->firstname;
    }


    /**
     * @param string|null $firstname
     *
     * @return $this
    */
    public function setFirstname(?string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }


    /**
     * @return string|null
    */
    public function getLastname(): ?string
    {
        return $this->lastname;
    }



    /**
     * @param string|null $lastname
     *
     * @return $this
    */
    public function setLastname(?string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }
}