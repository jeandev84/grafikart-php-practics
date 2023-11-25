<?php
declare(strict_types=1);

namespace App\Entity\University\ValueObject;


/**
 * Created by PhpStorm at 25.11.2023
 *
 * @Name
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Entity\University\ValueObject
 */
class FullName
{

     protected ?string $name;


     protected ?string $surname;


     protected ?string $patronymic;



     public function __construct(string $name, string $surname = '', string $patronymic = '')
     {
         $this->name       = $name;
         $this->surname    = $surname;
         $this->patronymic = $patronymic;
     }



     /**
      * @return string|null
     */
     public function getName(): ?string
     {
        return $this->name;
     }



     /**
      * @return string|null
     */
     public function getSurname(): ?string
     {
        return $this->surname;
     }


     /**
      * @return string|null
     */
     public function getPatronymic(): ?string
     {
         return $this->patronymic;
     }



     public function __toString(): string
     {
         return join(' ', array_filter([
             $this->surname,
             $this->name,
             $this->patronymic
         ]));
     }
}