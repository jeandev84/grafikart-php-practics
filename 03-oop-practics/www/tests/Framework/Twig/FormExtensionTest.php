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



      private function trim(string $string): string
      {
          $lines  = explode(PHP_EOL, $string);
          $lines  = array_map('trim', $lines);
          return implode('', $lines);
      }



      public function assertSimilar(string $expected, string $actual)
      {
          $this->assertEquals($this->trim($expected), $this->trim($actual));
      }


      public function testField()
      {
           $html = $this->formExtension->field([], "name", "demo", 'Titre');

           $this->assertSimilar($this->input('name', 'Titre', 'demo'), $html);
      }




    public function testTextarea()
    {
        $html = $this->formExtension->field([], "name", "demo", 'Titre', ['type' => 'textarea']);

        $this->assertSimilar($this->textarea('name', 'Titre', 'demo'), $html);
    }




    public function testFieldWithErrors()
    {
        $context = ['errors' => ['name' => 'erreur']];
        $html = $this->formExtension->field($context, "name", "demo", 'Titre');
        $this->assertSimilar($this->inputError('name', 'Titre', 'demo'), $html);
    }



    public function testFieldWithClass()
    {
        $html = $this->formExtension->field([],
            "name",
            "demo",
            'Titre',
            ['class' => 'demo']
        );
        $this->assertSimilar($this->input('name', 'Titre', 'demo', ['class' => 'demo']), $html);
    }



      private function input(string $key, string $label, ?string $value, array $options = []): string
      {
          $class = !empty($options['class']) ?  ' '. $options['class'] : '';
          return <<<HTML
             <div class="form-group">
                <label for="name">$label</label>
                <input type="text" class="form-control$class" name="$key" id="$key" value="$value">
            </div>
HTML;
      }



    private function inputError(string $key, string $label, ?string $value): string
    {
        return <<<HTML
             <div class="form-group has-danger">
                <label for="name">$label</label>
                <input type="text" class="form-control is-invalid" name="$key" id="$key" value="$value">
                <small class="form-text text-muted">erreur</small>
            </div>
HTML;
    }



    private function textarea(string $key, string $label, ?string $value): string
    {
        return <<<HTML
             <div class="form-group">
                <label for="name">$label</label>
                <textarea class="form-control" name="$key" id="$key">{$value}</textarea>
            </div>
HTML;
    }




    private function textareaError(string $key, string $label, ?string $value): string
    {
        return <<<HTML
             <div class="form-group has-danger">
                <label for="name">$label</label>
                <textarea class="form-control form-control-danger" name="$key" id="$key">{$value}</textarea>
                <small class="form-text text-muted">erreur</small>
            </div>
HTML;
    }
}