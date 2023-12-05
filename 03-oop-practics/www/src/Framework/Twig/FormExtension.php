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



     public function field(string $key, $value, string $label, array $options = [])
     {
         return <<<HTML
             <div class="form-group">
                <label for="name">$label</label>
                <input type="text" class="form-control" name="$key" id="$key" value="$value">
            </div>
HTML;
     }
}