<?php
declare(strict_types=1);

namespace App\Service\Comparator;


/**
 * Created by PhpStorm at 25.11.2023
 *
 * @ComparatorInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Service\Comparator
 */
interface ComparatorInterface
{

      public function match(): bool;

      public function greaterOrEqualTo($value): bool;

      public function greaterThan($value): bool;

      public function equalTo($value): bool;

      public function lessOrEqualThan($value): bool;

      public function lessThan($value): bool;
}