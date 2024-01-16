<?php
declare(strict_types=1);

namespace Grafikart\Utils;

/**
 * Str
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Grafikart\Utils
 */
class Str
{

      /**
       * @param string $str
       * @param int $offset
       * @param int|null $length
       * @return string
     */
     public static function substr(string $str, int $offset, ?int $length): string
     {
         return mb_substr($str, $offset, $length);
     }
}