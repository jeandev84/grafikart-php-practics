<?php
declare(strict_types=1);

namespace App\Validation;

/**
 * Validator
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  App\Validation
 */
class Validator implements ValidatorInterface
{
    /**
     * @var array
    */
    protected $data = [];


    /**
     * @var array
    */
    protected $errors = [];



    /**
     * @inheritDoc
    */
    public function validates(array $data)
    {
        $this->errors = [];
        $this->data = $data;
    }


    /**
     * @param string $field
     * @param string $method
     * @param ...$parameters
     * @return void
    */
    public function validate(string $field, string $method, ...$parameters)
    {
        if (!isset($this->data[$field])) {
           $this->addError($field, "Le champs $field n' est pas rempli");
        } else {
           call_user_func([$this, $method], $field, ...$parameters);
        }
    }




    /**
     * @param string $field
     * @param int $length
     * @return bool
    */
    public function minLength(string $field, int $length): bool
    {
        if (mb_strlen($this->data[$field]) < $length) {
            $this->addError($field, "Le champs doit avoir plus de $length caracteres");
            return false;
        }

        return true;
    }




    /**
     * @param string $field
     * @return bool
    */
    public function date(string $field): bool
    {
        if($this->format('Y-m-d', $field) === false) {
            $this->addError($field, "La date ne semble pas valide");
            return false;
        }

        return true;
    }



    /**
     * @param string $field
     * @return bool
    */
    public function time(string $field): bool
    {
        if($this->format('H:i', $field) === false) {
            $this->addError($field, "Le temps ne semble pas valide");
            return false;
        }

        return true;
    }




    /**
     * @param string $startField
     * @param string $endField
     * @return bool
    */
    public function beforeTime(string $startField, string $endField): bool
    {
         if ($this->time($startField) && $this->time($endField)) {
             $start = $this->format('H:i', $startField);
             $end   = $this->format('H:i', $endField);

             if ($start->getTimestamp() > $end->getTimestamp()) {
                 $this->addError($startField, "Le temps doit etre inferieur au temps de fin.");
                 return false;
             }

             return true;
         }


         return false;
    }




    /**
     * @param string $field
     * @param string $message
     * @return $this
    */
    public function addError(string $field, string $message): static
    {
        $this->errors[$field] = $message;

        return $this;
    }



    /**
     * @return array
    */
    public function getData(): array
    {
        return $this->data;
    }


    /**
     * @param string $name
     * @return bool
    */
    public function hasError(string $name): bool
    {
        return !empty($this->errors[$name]);
    }


    /**
     * @param string $name
     * @return string
    */
    public function getError(string $name): string
    {
        return $this->errors[$name] ?? '';
    }



    /**
     * @return bool
    */
    public function hasErrors(): bool
    {
        return !empty($this->errors);
    }



    /**
     * @param string $format
     * @param string $field
     * @return \DateTime|false
    */
    private function format(string $format, string $field): \DateTime|false
    {
       return \DateTime::createFromFormat($format, $this->data[$field]);
    }
}