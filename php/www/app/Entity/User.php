<?php
declare(strict_types=1);

namespace App\Entity;


/**
 * Created by PhpStorm at 29.11.2023
 *
 * @User
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Entity
 */
class User
{

     protected ?int $id = null;
     protected ?string $username = null;
     protected ?string $password = null;


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
}