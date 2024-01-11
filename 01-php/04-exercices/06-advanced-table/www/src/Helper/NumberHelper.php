<?php
declare(strict_types=1);

namespace App\Helper;


/**
 * Created by PhpStorm at 25.11.2023
 *
 * @NumberHelper
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Helper
 */
class NumberHelper
{
    public static function price(float $number, string $currency = "€"): string
    {
        $format = number_format($number, 0, '', ' ');

        return sprintf('%s %s', $format, $currency);
    }
}