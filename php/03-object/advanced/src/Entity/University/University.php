<?php
declare(strict_types=1);

namespace App\Entity\University;


/**
 * Created by PhpStorm at 25.11.2023
 *
 * @University
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Entity\University
 */
class University
{


    protected string $name;



    /**
     * @var Faculty[]
    */
    protected array $faculties = [];



    /**
     * @param Faculty[] $faculties
    */
    public function __construct(array $faculties)
    {
    }




    /**
     * @return Faculty[]
    */
    public function getFaculties(): array
    {
        return $this->faculties;
    }



    /**
     * @param Faculty $faculty
     *
     * @return $this
    */
    public function addFaculty(Faculty $faculty): self
    {
        $this->faculties[] = $faculty;

        return $this;
    }




    /**
     * @param Faculty[] $faculties
     *
     * @return $this
    */
    public function addFaculties(array $faculties): self
    {
        foreach ($faculties as $faculty) {
            $this->addFaculty($faculty);
        }

        return $this;
    }
}