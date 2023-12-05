<?php
declare(strict_types=1);

namespace Framework\Validation;


/**
 * Created by PhpStorm at 05.12.2023
 *
 * @ValidationError
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Framework\Validation
 */
class ValidationError
{
      protected string $key;

      protected string $rule;


      /**
       *  @var array
      */
      protected array $messages = [
          'required' => 'Le champs %s est requis'
      ];



      public function __construct(string $key, string $rule)
      {
          $this->key = $key;
          $this->rule = $rule;
      }




      /**
       * @return string
      */
      public function __toString(): string
      {
           return sprintf($this->messages[$this->rule], $this->key);
      }
}