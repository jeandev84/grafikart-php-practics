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
       }


       public function testRenderTheRightPath()
       {
           $this->renderer->addPath('blog', __DIR__.'/views');
           $content = $this->renderer->render('@blog/demo');
           $this->assertEquals('Salut les gens', $content);
       }



     public function testRenderTheDefaultPath()
     {
         $this->renderer->addPath(__DIR__.'/views');
         $content = $this->renderer->render('demo');
         $this->assertEquals('Salut les gens', $content);
     }
}