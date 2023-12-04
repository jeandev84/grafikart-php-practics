<?php
declare(strict_types=1);

namespace Tests\Framework\Templating;


use Framework\Templating\Renderer;
use PHPUnit\Framework\TestCase;

/**
 * Created by PhpStorm at 04.12.2023
 *
 * @RendererTest
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Tests\Framework\Templating
 *
 * ./vendor/bin/phpunit tests/Framework/Templating/RendererTest.php --colors
 */
class RendererTest extends TestCase
{

       protected Renderer $renderer;

       protected function setUp(): void
       {
           $this->renderer = new Renderer();
           $this->renderer->addPath(__DIR__.'/views');
       }


       public function testRenderTheRightPath()
       {
           $content = $this->renderer->render('@blog/demo');
           $this->assertEquals('Salut les gens', $content);
       }



     public function testRenderTheDefaultPath()
     {
         $content = $this->renderer->render('demo');
         $this->assertEquals('Salut les gens', $content);
     }




    public function testRenderWithParams()
    {
        $content = $this->renderer->render('demoparams', [
            'name' => 'Marc'
        ]);
        $this->assertEquals('Salut Marc', $content);
    }




    public function testGlobalParameters()
    {
        $this->renderer->addGlobal('name', 'Marc');
        $content = $this->renderer->render('demoparams');
        $this->assertEquals('Salut Marc', $content);
    }
}