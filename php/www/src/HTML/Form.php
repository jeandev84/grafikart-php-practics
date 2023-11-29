<?php
declare(strict_types=1);

namespace Grafikart\HTML;


/**
 * Created by PhpStorm at 28.11.2023
 *
 * @Form
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Grafikart\HTML
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




      public function select(string $key, string $label, array $options = []): string
      {
          $value = $this->getValue($key);
          $optionHTML = $this->generateOptionsHTML($options, $value);
          return <<<HTML
               <div class="form-group">
                 <label for="field{$key}">$label</label>
                 <select id="field{$key}" class="{$this->getInputClass($key)}" name="{$key}" required multiple>
                     $optionHTML
                 </select>
                 {$this->getErrorFeedback($key)}
              </div>
HTML;
      }



      private function generateOptionsHTML(array $options, array $values = []): string
      {
          $optionsHTML = [];
          foreach ($options as $key => $value) {
              $selected      = in_array($key, $values) ? ' selected': '';
              $optionsHTML[] = sprintf('<option value="%s"%s>%s</option>', $key, $selected, $value);
          }

          return implode($optionsHTML);
      }



      private function getValue(string $key): mixed
      {
          if (is_array($this->data)) {
               return $this->data[$key] ?? null;
          }

          $method = 'get'. str_replace(' ', '', ucwords(str_replace('_', ' ', $key)));
          $value = $this->data->$method();
          if ($value instanceof \DateTimeInterface) {
                return $value->format('Y-m-d H:i:s');
          }
          return $value;
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