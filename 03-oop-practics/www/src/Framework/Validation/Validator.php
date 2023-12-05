<?php
declare(strict_types=1);

namespace Framework\Validation;


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
               if (! array_key_exists($key, $this->params)) {
                   $this->errors[$key] = "Le champs $key est vide";
               }
           }

           return $this;
       }


       /**
        * @return array
       */
       public function getErrors(): array
       {
            return $this->errors;
       }
}