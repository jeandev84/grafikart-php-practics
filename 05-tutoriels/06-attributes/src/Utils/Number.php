<?php
declare(strict_types=1);

namespace Grafikart\Utils;

/**
 * Number
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Grafikart\Utils
 */
class Number
{

    /**
     * @param float $number
     * @param int $decimals
     * @param string|null $separator
     * @param string|null $thousandsSeparator
     * @return mixed
     *
     * number_format(2500.4567, 2, ",") = 2500,45
     * number_format(2500.4567, 3, ",") = 2500,457
     * number_format(2500.4567, 1, ",") = 2500,4
     */
      public static function format(
          float $number,
          int $decimals = 0,
          ?string $separator = '.',
          ?string $thousandsSeparator = ','
      ): string
      {
          return number_format($number, $decimals, $separator, $thousandsSeparator);
      }
}