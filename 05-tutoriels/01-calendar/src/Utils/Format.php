<?php
declare(strict_types=1);

namespace App\Utils;

use DateTime;
use Exception;

/**
 * Format
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  App\Utils
 */
class Format
{
      /**
       * @param string $format
       * @param string $datetime
       * @return DateTime
       * @throws Exception
      */
      public static function date(string $format, string $datetime): DateTime
      {
          if(! $date = DateTime::createFromFormat($format, $datetime)) {
              throw new Exception("Could not create datetime instance for [$format, $datetime]");
          }

          return $date;
      }


    /**
     * @param string $format
     * @param string $datetime
     * @return \DateTimeImmutable
     * @throws Exception
     */
    public static function dateImmutable(string $format, string $datetime): \DateTimeImmutable
    {
        if(! $date = \DateTimeImmutable::createFromFormat($format, $datetime)) {
            throw new Exception("Could not create datetime instance for [$format, $datetime]");
        }

        return $date;
    }
}