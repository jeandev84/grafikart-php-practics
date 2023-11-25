<?php
declare(strict_types=1);

namespace App\Entity\University;


use App\Entity\Person;
use App\Entity\University\ValueObject\FullName;

/**
 * Created by PhpStorm at 25.11.2023
 *
 * @Student
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Entity\University
*/
class Student extends Person
{
     /**
      * @var Faculty|null
     */
     protected ?Faculty $faculty = null;



     /**
      * @var Course[]
     */
     protected array $courses = [];




     /**
      * Notes or points of student
      *
      * @var array<float|int>
     */
     protected array $notes = [];




     public function __construct(FullName $fullName, array $notes = [])
     {
         parent::__construct($fullName);
         $this->setNotes($notes);
     }






    /**
     * @param Faculty|null $faculty
     *
     * @return $this
    */
    public function setFaculty(?Faculty $faculty): self
    {
        $this->faculty = $faculty;

        return $this;
    }



    /**
     * @return Faculty|null
    */
    public function getFaculty(): ?Faculty
    {
        return $this->faculty;
    }




    public function getNotes(): array
    {
        return $this->notes;
    }



    public function getNote(string $position): float|int
    {
        return $this->notes[$position] ?? 0;
    }




    public function setNotes(array $notes): self
    {
        $this->notes = $notes;

        return $this;
    }




    public function addCourse(Course $course): self
    {
        $this->courses[] = $course;

        return $this;
    }


    /**
     * @return array
    */
    public function getCourses(): array
    {
        return $this->courses;
    }



    public function getCountOfNotes(): int
    {
         return count($this->notes);
    }



    public function getSumOfNotes(): float
    {
        return array_sum($this->notes);
    }




    /**
     * Returns notes average
     *
     * @return float
    */
    public function getAverage(): float
    {
         return ($this->getSumOfNotes() / $this->getCountOfNotes());
    }



    public function __toString(): string
    {
        return "Hello, {$this->fullName} you got {$this->getAverage()} on average.";
    }
}