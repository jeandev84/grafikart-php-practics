<?php
declare(strict_types=1);

namespace Grafikart\Http\Request;


/**
 * Created by PhpStorm at 25.11.2023
 *
 * @Uri
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Grafikart\Http\Request
 */
class Uri
{

      protected string $target;

      public function __construct(string $target)
      {
          $this->target = $target;
      }



      public function __toString(): string
      {
           return $this->target;
      }
}