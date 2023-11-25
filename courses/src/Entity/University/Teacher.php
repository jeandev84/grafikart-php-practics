<?php
declare(strict_types=1);

namespace App\Entity\University;


use App\Entity\Person;
use App\Entity\University\ValueObject\FullName;

/**
 * Created by PhpStorm at 25.11.2023
 *
 * @Teacher
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Entity\University
 */
class Teacher extends Person
{

     /**
      * @var Course
     */
     protected Course $course;



    public function __construct(FullName $fullName, Course $course)
    {
        parent::__construct($fullName);
        $this->course = $course;
    }




    /**
     * @return Course
    */
    public function getCourse(): Course
    {
        return $this->course;
    }
}