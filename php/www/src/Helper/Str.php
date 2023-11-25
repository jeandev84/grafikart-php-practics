<?php
declare(strict_types=1);

namespace App\Helper;


/**
 * Created by PhpStorm at 26.11.2023
 *
 * @Str
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Helper
 */
class Str
{
      public static function escape(string $string): string
      {
          return htmlentities($string);
      }
}