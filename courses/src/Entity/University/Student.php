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
        return "Hello, {$this->name} you got {$this->getAverage()} on average.";
    }
}