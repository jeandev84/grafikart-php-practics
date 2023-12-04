<?php
declare(strict_types=1);

namespace App\Blog;


use Framework\Routing\Router;
use Framework\Templating\Renderer\RendererInterface;
use Psr\Http\Message\ServerRequestInterface;


/**
 * Created by PhpStorm at 04.12.2023
 *
 * @BlogModule
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Blog
 */
class BlogModule
{

     private RendererInterface $renderer;


     public function __construct(Router $router, RendererInterface $renderer)
     {
         # Renderer
         $this->renderer = $renderer;
         $this->renderer->addPath('blog', __DIR__.'/views');

         # Routing
         $router->get('/blog', [$this, 'index'], 'blog.index');
         $router->get('/blog/{slug}', [$this, 'show'], 'blog.show')
                ->wheres(['slug' => '[a-z\-0-9]+']);
     }




     public function index(ServerRequestInterface $request): string
     {
         return $this->renderer->render('@blog/index');
     }


     public function show(ServerRequestInterface $request): string
     {
         return $this->renderer->render('@blog/show', [
             'slug' => $request->getAttribute('slug')
         ]);
     }
}