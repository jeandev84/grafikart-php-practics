<?php
declare(strict_types=1);

namespace App\Service\Decorator;


use App\Service\Great\Hello;
use App\Service\Great\HelloInterface;

/**
 * Created by PhpStorm at 03.12.2023
 *
 * @CavaDecorator
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Service\Decorator
 */
class CavaDecorator implements HelloInterface
{
     protected HelloInterface $hello;

     public function __construct(HelloInterface $hello)
     {
         $this->hello = $hello;
     }


     public function sayHello(): string
     {
         return $this->hello->sayHello() . ". Comment ca va ?";
     }


     public function sayGoodBye(): string
     {
          return "Good bye";
     }
}