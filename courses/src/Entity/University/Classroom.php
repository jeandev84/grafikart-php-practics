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
class Classroom
{

     /**
      * @var Teacher[]
     */
     protected array $teachers = [];



     /**
      * @var Student[]
     */
     protected array $students = [];
}