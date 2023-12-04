<?php
declare(strict_types=1);

namespace App\Service\Great;


/**
 * Created by PhpStorm at 03.12.2023
 *
 * @HelloInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Service\Great
 */
interface HelloInterface
{
      public function sayHello(): string;
}