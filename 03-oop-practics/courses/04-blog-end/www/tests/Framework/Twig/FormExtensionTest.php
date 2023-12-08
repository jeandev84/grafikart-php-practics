<?php
declare(strict_types=1);

namespace Tests\Framework\Twig;


use Framework\Twig\FormExtension;
use PHPUnit\Framework\TestCase;
use Tests\Framework\Twig\Traits\InputHelpersTrait;

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

      use InputHelpersTrait;


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




    public function testSelect()
    {
          $html = $this->formExtension->field(
              [],
              'name',
              2,
              'Titre',
              ['options' => [1 => 'Demo', '2' => 'Demo2']]
          );

          $this->assertSimilar($this->select(), $html);
    }
}