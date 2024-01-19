<?php
declare(strict_types=1);

namespace Grafikart\Utils;

use Grafikart\Utils\Encoder\EncoderType;
use RuntimeException;

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
     public static function sub(string $str, int $offset, ?int $length): string
     {
         return mb_substr($str, $offset, $length);
     }




    /**
     * @param string $str
     * @return false|int
    */
    public static function toTime(string $str): bool|int
    {
         return strtotime($str);
    }




    /**
     * @param string $str
     * @param string $charset
     * @return string
     * @throws RuntimeException
     */
     public static function encode(string $str, string $charset = EncoderType::UTF8): string
     {
          $func = $charset .'_encode';

          if (! function_exists($func)) {
              throw new RuntimeException("functions $func does not exist");
          }

          return call_user_func($func, $str);
     }



    /**
     * @param string $str
     * @param string $charset
     * @return mixed
     * @throws RuntimeException
     */
    public static function decode(string $str, string $charset = EncoderType::UTF8): mixed
    {
        $func = $charset .'_decode';

        if (! function_exists($func)) {
            throw new RuntimeException("functions $func does not exist");
        }

        return call_user_func($func, $str);
    }
}