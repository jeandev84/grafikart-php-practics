<?php
declare(strict_types=1);

namespace Grafikart\Validation;


/**
 * Created by PhpStorm at 27.11.2023
 *
 * @RuleInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Grafikart\Validation
 */
interface RuleInterface
{
    public function fieldName(): string;
    public function getValue(): mixed;
    public function getMessage(): string;
    public function validate(): bool;
}