<?php
declare(strict_types=1);

namespace Grafikart\Validation;


/**
 * Created by PhpStorm at 27.11.2023
 *
 * @ValidatorInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Grafikart\Validation
 */
interface ValidatorInterface
{

     /**
      * @return bool
     */
     public function validate(): bool;



     /**
      * @return RuleInterface[]
     */
     public function getRules(): array;


     public function getErrors(): array;
}