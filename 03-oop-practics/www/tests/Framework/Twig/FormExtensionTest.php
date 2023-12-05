<?php
declare(strict_types=1);

namespace Tests\Framework\Twig;


use Framework\Twig\FormExtension;
use PHPUnit\Framework\TestCase;

/**
 * Created by PhpStorm at 05.12.2023
 *
 * @FormExtensionTest
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Tests\Framework\Twig
 */
class FormExtensionTest extends TestCase
{


      protected FormExtension $formExtension;


      public function setUp(): void
      {
         $this->formExtension = new FormExtension();
      }




      public function testField()
      {
           $html = $this->formExtension->field("name", "demo", 'Titre');

           $this->assertEquals($this->inputFormat('name', 'Titre', 'demo'), $html);
      }



      private function inputFormat(string $key, string $label, $value)
      {
          return <<<HTML
             <div class="form-group">
                <label for="name">$label</label>
                <input type="text" class="form-control" name="$key" id="$key" value="$value">
            </div>
HTML;

      }
}