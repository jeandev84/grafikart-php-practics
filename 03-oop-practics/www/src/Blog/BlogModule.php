<?php
declare(strict_types=1);

namespace App\Blog;


use Framework\Templating\Renderer;
use Psr\Http\Message\ServerRequestInterface;
use Framework\Routing\Router;

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

     private Renderer $renderer;


     public function __construct(Router $router, Renderer $renderer)
     {
         # Renderer
         $this->renderer = $renderer;
         $this->renderer->addPath('blog', __DIR__.'/views');

         # Routing
         $router->get('/blog', [$this, 'index'], 'blog.index');
         $router->get('/blog/{slug}', [$this, 'show'], 'blog.show')
                ->wheres(['slug' => '[a-z0-9\-]+']);
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