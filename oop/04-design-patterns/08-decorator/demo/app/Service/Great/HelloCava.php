<?php
declare(strict_types=1);

namespace App\Service\Great;


/**
 * Created by PhpStorm at 03.12.2023
 *
 * @HelloCava
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Service
 */
class HelloCava extends Hello
{
       public function sayHello(): string
       {
           $content = parent::sayHello();
           return $content . ". Comment ca va?";
       }
}