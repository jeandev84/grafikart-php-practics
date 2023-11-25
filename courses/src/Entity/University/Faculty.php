<?php
declare(strict_types=1);

namespace App\Entity\University;


/**
 * Created by PhpStorm at 25.11.2023
 *
 * @Faculty
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Entity\University
 */
class Faculty
{

     protected string $name;


     /**
      * @var Level[]
     */
     protected array $levels = [];



     /**
      * @param string $name
      *
      * @param Level[] $levels
     */
     public function __construct(string $name, array $levels)
     {
          $this->setName($name);
          $this->addLevels($levels);
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
     */
     public function setName(string $name): void
     {
         $this->name = $name;
     }




     public function addLevel(Level $level): self
     {
         $this->levels[] = $level;

         return $this;
     }




     /**
      * @param Level[] $levels
      *
      * @return $this
     */
     public function addLevels(array $levels): self
     {
         foreach ($levels as $level) {
             $this->addLevel($level);
         }

         return $this;
     }



    /**
     * @return Level[]
    */
    public function getLevels(): array
    {
        return $this->levels;
    }
}