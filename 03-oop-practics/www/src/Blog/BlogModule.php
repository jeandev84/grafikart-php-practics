<?php
declare(strict_types=1);

namespace App\Blog;


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
     public function __construct(Router $router)
     {
         $router->get('/blog', [$this, 'index'], 'blog.index');
         $router->get('/blog/{slug}-{id}', [$this, 'show'], 'blog.show')
                ->wheres(['slug' => '[a-z0-9\-]+', 'id'   => '\d+']);
     }



     public function index(ServerRequestInterface $request): string
     {
         return '<h1>Bienvenue sur le blog</h1>';
     }


     public function show(ServerRequestInterface $request): string
     {
         $slug = $request->getAttribute('slug');

         return "<h1>Bienvenue sur l' article {$slug}</h1>";
     }
}