<?php
declare(strict_types=1);

namespace App\Entity\University;


/**
 * Created by PhpStorm at 25.11.2023
 *
 * @Classroom
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Entity\University
 */
class Level
{

    /**
     * @var string
    */
    protected string $title;



    /**
     * @var string
    */
    protected string $code;




    /**
     * @var Student[]
    */
    protected array $students = [];




    /**
     * @param string $title
     *
     * @param string $code
    */
    public function __construct(string $title, string $code)
    {
        $this->setTitle($title);
        $this->setCode($code);
    }




    /**
     * @param string $title
     *
     * @return $this
    */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }





    /**
     * @return string
    */
    public function getTitle(): string
    {
        return $this->title;
    }




    /**
     * @return string|null
    */
    public function getCode(): ?string
    {
        return $this->code;
    }




    /**
     * @param string|null $code
     *
     * @return $this
    */
    public function setCode(?string $code): self
    {
        $this->code = $code;

        return $this;
    }


    public function addStudent(Student $student): static
    {
        if (! in_array($student, $this->students)) {
            $student->setLevel($this);
            $this->students[] = $student;
        }

        return $this;
    }




    /**
     * @param Student[] $students
    */
    public function addStudents(array $students): static
    {
        foreach ($students as $student) {
            $this->addStudent($student);
        }

        return $this;
    }





    /**
     * @return Student[]
    */
    public function getStudents(): array
    {
        return $this->students;
    }



    public function __toString(): string
    {
        return "$this->title ($this->code)";
    }
}