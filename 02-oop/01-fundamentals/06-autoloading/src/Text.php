<?php
declare(strict_types=1);


/**
 * Created by PhpStorm at 01.12.2023
 *
 * @Text
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 */
class Text
{
    private static $suffix = '€';

    const SUFFIX = '€';

    public static function withZero(int $number): string
    {
        return (string)($number < 10 ? "0$number " . self::SUFFIX : $number);
    }
}