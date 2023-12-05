<?php
declare(strict_types=1);

namespace Framework\Twig;


use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

/**
 * Created by PhpStorm at 05.12.2023
 *
 * @FormExtension
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Framework\Twig
 */
class FormExtension extends AbstractExtension
{

     public function getFunctions()
     {
         return [
             new TwigFunction('field', [$this, 'field'], [
                 'is_safe' => ['html'],
                 'needs_context' => true
             ])
         ];
     }



     public function field(array $context, string $key, $value, string $label, array $options = []): string
     {
         $type  = $options['type'] ?? 'text';
         $error = $this->getErrorHtml($context, $key);
         $class = 'form-group';
         $attributes = [
             'class' => 'form-control',
             'name'  => $key,
             'id'    => $key
         ];
         if ($error) {
             $class .= ' has-danger';
             $attributes['class'] .= ' form-control-danger';
         }

         if ($type === 'textarea') {
             $input = $this->textarea($value, $attributes);
         } else {
             $input  = $this->input($value, $attributes);
         }

         return <<<FIELD
                 <div class="$class">
                    <label for="name">$label</label>
                    {$input}
                    {$error} 
                </div>
FIELD;
     }



     /**
      * @param array $context
      *
      * @param string $key
      *
      * @return string
     */
     private function getErrorHtml(array $context, string $key): string
     {
          $error = $context['errors'][$key] ?? false;
          if ($error) {
              return sprintf('<small class="form-text text-muted">%s</small>', $error);
          }
          return "";
     }


    /**
     * @param string|null $value
     * @param array $attributes
     * @return string
     */
    public function input(?string $value, array $attributes): string
    {
        $attr = $this->getHtmlFromArray($attributes);
        return <<<INPUT
          <input type="text" {$attr} value="$value">
INPUT;

    }


     /**
      * @param string|null $value
      * @param array $attributes
      * @return string
     */
     public function textarea(?string $value, array $attributes): string
     {
         $attr = $this->getHtmlFromArray($attributes);

         return <<<TEXTAREA
             <textarea {$attr}>{$value}</textarea>
TEXTAREA;

     }



     private function getHtmlFromArray(array $attributes): string
     {
          return implode(' ', array_map(function ($key, $value) {
               return sprintf('%s="%s"', $key, $value);
          }, array_keys($attributes), $attributes));
     }
}