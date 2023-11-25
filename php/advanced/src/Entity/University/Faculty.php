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

     protected string $title;


     protected string $code;


     /**
      * @var Student[]
     */
     protected array $students = [];




     /**
      * @param string $title
      *
      * @param string $code
      *
      * @param Student[] $students
     */
     public function __construct(string $title, string $code, array $students)
     {
         $this->title = $title;
         $this->code  = $code;
         $this->addStudents($students);
     }




     /**
      * @param Student $student
      *
      * @return $this
     */
     public function addStudent(Student $student): self
     {
          if (! in_array($student, $this->students)) {
              $this->students[] = $student;
          }

          return $this;
     }





     /**
      * @param Student[] $students
      *
      * @return $this
     */
     public function addStudents(array $students): self
     {
          foreach ($students as $student) {
              $this->addStudent($student);
          }

          return $this;
     }
}