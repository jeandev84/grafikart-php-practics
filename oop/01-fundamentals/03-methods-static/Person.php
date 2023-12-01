<?php
declare(strict_types=1);


/**
 * Created by PhpStorm at 30.11.2023
 *
 * @Person
 *
 * @author Jean-Claude <jeanyao@ymail.com>
*/
class Person
{

       const MAX_VIE = 100;


      /**
       * @var int
      */
      protected int $life = 80;


      /**
       * @var int
      */
      protected int $attack = 20;



      /**
       * @var string
      */
      protected ?string $name;


      public function __construct(string $name)
      {
          $this->name = $name;
      }

      public function regenerate($life = null): void
      {
           $this->life = self::MAX_VIE;

           if ($life) {
               $this->life += $life;
           }
      }



      public function killed(): bool
      {
          return $this->life <= 0;
      }




      public function attack(Person $target): void
      {
           $target->life -= $this->attack;
      }



      /**
       * @return string|null
      */
     public function getName(): ?string
     {
         return $this->name;
     }




     /**
      * @param string|null $name
      *
      * @return $this
     */
     public function setName(?string $name): self
     {
        $this->name = $name;

        return $this;
     }




    /**
     * @param int $life
     *
     * @return $this
    */
    public function setLife(int $life): self
    {
        $this->life = $life;

        return $this;
    }



    /**
     * @return int
    */
    public function getLife(): int
    {
        return $this->life;
    }
}