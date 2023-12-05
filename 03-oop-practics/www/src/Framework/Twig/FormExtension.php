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
             new TwigFunction('field', [$this, 'field'])
         ];
     }



     public function field(string $key, $value, string $label, array $options = []): string
     {
         $type = $options['type'] ?? 'text';

         if ($type === 'textarea') {
             $input = $this->textarea($key, $value);
         } else {
             $input  = $this->input($key, $value);
         }

         return <<<FIELD
                 <div class="form-group">
                    <label for="name">$label</label>
                    $input 
                </div>
FIELD;
     }





    /**
     * @param string $key
     *
     * @param $value
     *
     * @return string
    */
    public function input(string $key, $value): string
    {
        return <<<INPUT
          <input type="text" class="form-control" name="$key" id="$key" value="$value">
INPUT;

    }




     /**
      * @param string $key
      *
      * @param $value
      *
      * @return string
     */
     public function textarea(string $key, $value): string
     {
         return <<<TEXTAREA
             <textarea class="form-control" name="$key" id="$key">{$value}</textarea>
TEXTAREA;

     }
}