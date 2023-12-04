<?php
declare(strict_types=1);

namespace App\Entity\Contract;


/**
 * Created by PhpStorm at 02.12.2023
 *
 * @EntityInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Entity\Contract
 */
interface EntityInterface
{
      public static function getClassName(): string;
}