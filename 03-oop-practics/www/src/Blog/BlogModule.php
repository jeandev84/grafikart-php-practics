<?php
declare(strict_types=1);

namespace App\Blog;


use Framework\Routing\Router;
use Psr\Http\Message\ResponseInterface;
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
     public function __construct(Router $router)
     {
         $router->get('/blog', [$this, 'index'], 'blog.index');
         $router->get('/blog/{slug:[a-z0-9\-]+}-{id:\d+}', [$this, 'show'], 'blog.show');
     }


     public function index(ServerRequestInterface $request): string
     {
         return '<h1>Bienvenue sur le blog</h1>';
     }


     public function show(ServerRequestInterface $request): ResponseInterface
     {
         $slug = $request->getAttribute('slug');

         return "<h1>Bienvenue sur l' article {$slug}</h1>";
     }
}