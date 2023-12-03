<?php
declare(strict_types=1);

namespace Grafikart;


/**
 * Created by PhpStorm at 02.12.2023
 *
 * @Rechargeable
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Grafikart
 */
trait Rechargeable
{
      public $energy = 100;


      public function recharger()
      {
          $this->energy = 100;
      }
}