<?php
declare(strict_types=1);

namespace App\Entity\University;


/**
 * Created by PhpStorm at 25.11.2023
 *
 * @Student
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Entity\University
*/
class Student
{


     /**
      * Name of student
      *
      * @var string
     */
     protected string $name;





     /**
      * Class of student
      *
      * @var Level|null $level
     */
     protected ?Level $level = null;



     /**
      * Notes or points of student
      *
      * @var array<float|int>
     */
     protected array $notes = [];




    /**
     * @param string $name
     *
     * @param array<float|int> $notes
    */
    public function __construct(string $name, array $notes = [])
    {
        $this->name  = $name;
        $this->notes = $notes;
    }





    public function getName(): string
    {
        return $this->name;
    }


    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }


    public function getLevel(): ?Level
    {
        return $this->level;
    }


    public function setLevel(?Level $level): self
    {
        $this->level = $level;

        return $this;
    }


    public function getNotes(): array
    {
        return $this->notes;
    }



    public function setNotes(array $notes): self
    {
        $this->notes = $notes;

        return $this;
    }



    public function getCountOfNotes(): int
    {
         return count($this->notes);
    }



    public function getSumOfNotes(): float
    {
        return array_sum($this->notes);
    }



    public function getAverage(): float
    {
         return ($this->getSumOfNotes() / $this->getCountOfNotes());
    }



    public function __toString(): string
    {
        return "The average of {$this->name} is : {$this->getAverage()}\n";
    }
}