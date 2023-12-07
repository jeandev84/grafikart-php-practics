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


    /**
     * @param array $context
     * @param string $key
     * @param $value
     * @param string $label
     * @param array $options
     * @return string
     */
     public function field(array $context, string $key, $value, string $label, array $options = []): string
     {
         $type  = $options['type'] ?? 'text';
         $error = $this->getErrorHtml($context, $key);
         $class = 'form-group';
         $value = $this->convertValue($value);
         $attributes = [
             'class' => trim('form-control '. ($options['class'] ?? '')),
             'name'  => $key,
             'id'    => $key
         ];
         if ($error) {
             $class .= ' has-danger';
             $attributes['class'] .= ' is-invalid';
         }

         if ($type === 'textarea') {
             $input = $this->textarea($value, $attributes);
         } elseif ($type === 'file') {
             $input = $this->file($attributes);
         } elseif ($type === 'checkbox') {
             $input = $this->checkbox($value, $attributes);
         } elseif (array_key_exists('options', $options)) {
             $input  = $this->select($value, $options['options'], $attributes);
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
          if (!$error) {
              return '';
          }
         return sprintf('<small class="form-text text-muted">%s</small>', $error);
     }





    /**
     * @param string|null $value
     * @param array $attributes
     * @return string
     */
    public function input(?string $value, array $attributes): string
    {
        return sprintf('<input type="text" %s value="%s">', $this->getHtmlFromArray($attributes), $value);
    }




    /**
     * @param string|null $value
     * @param array $attributes
     * @return string
     */
    public function checkbox(?string $value, array $attributes): string
    {
        $html = sprintf('<input type="hidden" name="%s" value="0">',  $attributes['name']);
        if ($value) { $attributes['checked'] = true; }
        return sprintf('%s<input type="checkbox" %s value="1">', $html, $this->getHtmlFromArray($attributes));
    }





    /***
     * @param array $attributes
     * @return string
    */
    public function file(array $attributes): string
    {
        return sprintf('<input type="file" %s>', $this->getHtmlFromArray($attributes));
    }




     /**
      * @param string|null $value
      * @param array $attributes
      * @return string
     */
     public function textarea(?string $value, array $attributes): string
     {
         return sprintf('<textarea %s>%s</textarea>', $this->getHtmlFromArray($attributes), $value);
     }





    /**
     * @param string|null $value
     * @param array $options
     * @param array $attributes
     * @return string
     */
     public function select(?string $value, array $options, array $attributes): string
     {
         $htmlOptions = array_reduce(array_keys($options), function (string $html, string $key) use ($options, $value) {
                $params = ['value' => $key, 'selected' => ($key === $value)];
                return $html . '<option '. $this->getHtmlFromArray($params) .'>'. $options[$key] .'</option>';
         }, "");

         return sprintf('<select %s>%s</select>', $this->getHtmlFromArray($attributes), $htmlOptions);
     }



     private function convertValue($value): string
     {
          if ($value instanceof \DateTime) {
              return $value->format('Y-m-d H:i:s');
          }

          return (string)$value;
     }



     private function getHtmlFromArray(array $attributes): string
     {
         $htmlParts = [];
         foreach ($attributes as $key => $value) {
             if ($value === true) {
                 $htmlParts[] = (string)$key;
             } elseif ($value !== false) {
                 $htmlParts[] = sprintf('%s="%s"', $key, $value);
             }
         }
         return implode(' ', $htmlParts);
     }
}