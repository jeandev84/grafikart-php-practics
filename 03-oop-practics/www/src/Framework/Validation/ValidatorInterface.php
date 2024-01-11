<?php
declare(strict_types=1);

namespace Framework\Validation;


/**
 * Created by PhpStorm at 05.12.2023
 *
 * @ValidatorInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Framework\Validation
 */
interface ValidatorInterface
{
     /**
      * @return array
     */
     public function getErrors(): array;
}