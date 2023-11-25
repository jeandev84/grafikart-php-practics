<?php
declare(strict_types=1);

namespace App\Entity;


use App\Entity\University\ValueObject\FullName;

/**
 * Created by PhpStorm at 25.11.2023
 *
 * @Person
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Entity
 */
class Person
{
     /**
      * Name of person
      *
      * @var FullName
     */
     protected FullName $fullName;


    /**
     * @param FullName $fullName
    */
    public function __construct(FullName $fullName)
    {
        $this->fullName = $fullName;
    }




    /**
     * @return FullName
    */
    public function getFullName(): FullName
    {
        return $this->fullName;
    }
}