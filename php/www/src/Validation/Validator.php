<?php
declare(strict_types=1);

namespace Grafikart\Validation;


/**
 * Created by PhpStorm at 27.11.2023
 *
 * @Validator
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Grafikart\Validation
 *
 * //TODO refactoring and code reviews
 */
class Validator implements ValidatorInterface
{

      /**
       * @var string
      */
      protected string $locale;


      /**
       * @var RuleInterface[]
      */
      protected array $rules = [];



      /**
       * @var array
      */
      protected array $errors = [];



      public function __construct(string $locale = 'en_EN')
      {
          $this->locale = $locale;
      }


      public function addRule(RuleInterface $rule): self
      {
          $this->rules[$rule->fieldName()][] = $rule;

          return $this;
      }





      /**
       * @param RuleInterface[] $rules
       *
       * @return $this
      */
      public function addRules(array $rules): self
      {
          foreach ($rules as $rule) {
              $this->addRule($rule);
          }

          return $this;
      }

    public function validate(): bool
    {
        foreach ($this->rules as $rule) {
            if (! $rule->validate()) {
                $this->addError($rule->fieldName(), $rule->getMessage());
            }
        }

        return empty($this->errors);
    }



    public function addError(string $name, string $message): self
    {
        $this->errors[$name][] = $message;

        return $this;
    }



    public function getRules(): array
    {
        return $this->rules;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}