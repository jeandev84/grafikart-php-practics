<?php
declare(strict_types=1);

namespace App\Service\Great;


/**
 * Created by PhpStorm at 03.12.2023
 *
 * @Hello
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Service
*/
class Hello implements HelloInterface
{
     public function sayHello(): string
     {
        return "Bonjour";
     }
}