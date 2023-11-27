<?php
declare(strict_types=1);

namespace Grafikart\Validation;


/**
 * Created by PhpStorm at 27.11.2023
 *
 * @Rule
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Grafikart\Validation
 */
abstract class Rule implements RuleInterface
{
    /**
     * @var string
    */
    protected string $fieldName;


    /**
     * @param string $fieldName
    */
    public function __construct(string $fieldName)
    {
        $this->fieldName = $fieldName;
    }



    public function fieldName(): string
    {
        return $this->fieldName;
    }
}