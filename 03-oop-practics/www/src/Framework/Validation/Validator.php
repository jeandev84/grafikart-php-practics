<?php
declare(strict_types=1);

namespace Framework\Validation;


use Framework\Database\ORM\EntityRepository;

/**
 * Created by PhpStorm at 05.12.2023
 *
 * @Validator
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Framework\Validation
 */
class Validator
{
       /**
        * @var array
       */
       protected array $params = [];


       /**
        * @var array
       */
       protected array $errors = [];




       /**
        * @param array $params
       */
       public function __construct(array $params)
       {
           $this->params = $params;
       }




       /**
        * @param string ...$keys
        *
        * @return $this
       */
       public function required(string ...$keys): self
       {
           foreach ($keys as $key) {
               $value = $this->getValue($key);
               if (is_null($value)) {
                   $this->addError($key, 'required');
               }
           }

           return $this;
       }



       public function notEmpty(string ...$keys): self
       {
           foreach ($keys as $key) {
               $value = $this->getValue($key);
               if (empty($value)) {
                   $this->addError($key, 'empty');
               }
           }

           return $this;
       }



       /**
        * @param string $key
        *
        * @return $this
       */
       public function slug(string $key): self
       {
            $value   = $this->getValue($key);
            # $pattern = '/^([a-z0-9]+-?)+$/';
            $pattern = '/^[a-z0-9]+(-[a-z0-9]+)*$/';

            if (!is_null($value) && ! preg_match($pattern, $value)) {
                $this->addError($key, 'slug');
            }

            return $this;
       }



       public function length(string $key, ?int $min, ?int $max = null): self
       {
            $value  = $this->getValue($key);
            $length = mb_strlen($value);

            if (!is_null($min) && !is_null($max) && ($length < $min || $length > $max)) {
                $this->addError($key, 'betweenLength', [$min, $max]);
                return $this;
            }

            if (!is_null($min) && $length < $min) {
               $this->addError($key, 'minLength', [$min]);
               return $this;
            }


           if (!is_null($max) && $length > $max) {
               $this->addError($key, 'maxLength', [$max]);
               return $this;
           }

            return $this;
       }


       /**
        * @param string $key
        * @param string $format
        * @return $this
       */
       public function dateTime(string $key, string $format = 'Y-m-d H:i:s'): self
       {
            $value  = $this->getValue($key);
            $date   = \DateTime::createFromFormat($format, $value);  /* dump($date); */
            $errors = \DateTime::getLastErrors(); /* dump($errors); */

            if ($errors['error_count'] > 0 || $errors['warning_count'] > 0 || $date === false) {
                $this->addError($key, 'datetime', [$format]);
            }

            return $this;
       }




      /**
       * @param string $key
       *
       * @param string $id
       *
       * @param EntityRepository $repository
       *
       * @return $this
     */
     public function exists(string $key, EntityRepository $repository): self
     {
          $value = $this->getValue($key);

          if (! $repository->exists($value)) {
              $this->addError($key, 'exists', [$repository->getTable()]);
          }

          return $this;
     }





       public function isValid(): bool
       {
           return empty($this->errors);
       }







       /**
        * @return ValidationError[]
       */
       public function getErrors(): array
       {
            return $this->errors;
       }






       /**
        * @param string $key
        * @param string $rule
        * @param array $attributes
        * @return $this
       */
       protected function addError(string $key, string $rule, array $attributes = []): self
       {
            $this->errors[$key] = new ValidationError($key, $rule, $attributes);

            return $this;
       }




       /**
        * @param string $key
        *
        * @return mixed
       */
       protected function getValue(string $key): mixed
       {
           return $this->params[$key] ?? null;
       }




       protected function hasParam(string $key): bool
       {
           return array_key_exists($key, $this->params);
       }
}