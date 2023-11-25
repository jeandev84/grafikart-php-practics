<?php
declare(strict_types=1);

namespace App\Entity;


/**
 * Created by PhpStorm at 25.11.2023
 *
 * @Person
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Entity
 */
class Person
{

     /**
      * Surname of person
      *
      * @var string
     */
     protected string $surname;


     /**
      * Name of person
      *
      * @var string
     */
     protected string $name;



     /**
      * Patronymic of person
      *
      * @var string
     */
     protected string $patronymic;



     /**
      * @param string $surname
      *
      * @param string $name
      *
      * @param string|null $patronymic
     */
    public function __construct(string $surname, string $name, string $patronymic = null)
    {
        $this->surname    = $surname;
        $this->name       = $name;
        $this->patronymic = $patronymic;
    }




    /**
     * @return string
    */
    public function getName(): string
    {
        return $this->name;
    }





    /**
     * @param string $name
     *
     * @return $this
    */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }





    /**
     * @return string
    */
    public function getSurname(): string
    {
        return $this->surname;
    }




    /**
     * @param string $surname
     *
     * @return $this
    */
    public function setSurname(string $surname): self
    {
        $this->surname = $surname;

        return $this;
    }





    /**
     * @param string|null $patronymic
     *
     * @return $this
    */
    public function setPatronymic(?string $patronymic): self
    {
        $this->patronymic = $patronymic;

        return $this;
    }




    /**
     * @return string
    */
    public function getPatronymic(): string
    {
        return $this->patronymic;
    }





    public function getFullName(): string
    {
        return join(' ', array_filter([
            $this->surname,
            $this->name,
            $this->patronymic
        ]));
    }
}