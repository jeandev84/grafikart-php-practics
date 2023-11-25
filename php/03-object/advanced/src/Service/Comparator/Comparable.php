<?php
declare(strict_types=1);

namespace App\Service\Comparator;


/**
 * Created by PhpStorm at 25.11.2023
 *
 * @Comparable
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Service\Comparator
 *
 * From @vascowhite: http://stackoverflow.com/a/17008682/697370
 * https://stackoverflow.com/questions/39229157/how-php-compare-entities
 */
interface Comparable
{
    /**
     * @param Comparable $other
     * @param String $comparison any of ==, <, >, =<, >=, etc
     * @return Bool true | false depending on result of comparison
     */
    public function compareTo(Comparable $other, $comparison);
}