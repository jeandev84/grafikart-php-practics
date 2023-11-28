<?php
declare(strict_types=1);

namespace Grafikart\Html\Form;


/**
 * Created by PhpStorm at 28.11.2023
 *
 * @Form
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Grafikart\HTML\Form
 */
class Form
{

      protected $data;


      protected array $errors = [];


      /**
       * @param mixed $data
       * @param array $errors
      */
      public function __construct(mixed $data, array $errors)
      {
          $this->data   = $data;
          $this->errors = $errors;
      }



      public function input(string $key, string $label): string
      {
           $value = $this->getValue($key);

           return <<<HTML
               <div class="form-group">
                 <label for="field{$key}">$label</label>
                 <input type="text"  id="field{$key}" class="{$this->getInputClass($key)}" name="{$key}" value="{$value}">
                 {$this->getErrorFeedback($key)}
              </div>
HTML;

      }


      public function textarea(string $key, string $label): string
      {
          $value = $this->getValue($key);
          return <<<HTML
               <div class="form-group">
                 <label for="field{$key}">$label</label>
                 <textarea type="text"  id="field{$key}" class="{$this->getInputClass($key)}" name="{$key}">{$value}</textarea>
                 {$this->getErrorFeedback($key)}
              </div>
HTML;
      }



      private function getValue(string $key): mixed
      {
          if (is_array($this->data)) {
               return $this->data[$key] ?? null;
          }

          $method = 'get'. ucfirst($key);
          return $this->data->$method();
      }


      private function getInputClass(string $key): string
      {
          $inputClass  = "form-control";
          if (isset($this->errors[$key])) {
              $inputClass .= " is-invalid";
          }

          return $inputClass;
      }



      private function getErrorFeedback(string $key): string
      {
          if (! isset($this->errors[$key])) {
              return '';
          }
          return '<div class="invalid-feedback">'. join('<br>', $this->errors[$key]).'</div>';;
      }
}