<?php
declare(strict_types=1);

namespace App\Entity\University;


/**
 * Created by PhpStorm at 25.11.2023
 *
 * @Subject
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Entity\University
 */
class Course
{
     protected string $name;

     protected string $level;



     public function __construct(string $name, string $level)
     {
         $this->name     = $name;
         $this->level    = $level;
     }


     /**
      * @return string
     */
     public function getName(): string
     {
         return $this->name;
     }


     /**
      * @return string
     */
     public function getLevel(): string
     {
        return $this->level;
     }
}