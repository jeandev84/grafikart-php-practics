<?php
declare(strict_types=1);

namespace App\Blog;


use App\Blog\Actions\BlogAction;
use Framework\Module;
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
class BlogModule extends Module
{

     const DEFINITIONS = __DIR__.'/config.php';


     public function __construct(string $prefix, Router $router, RendererInterface $renderer)
     {
         # Renderer
         $renderer->addPath('blog', __DIR__.'/views');

         # Routing
         $router->get($prefix, BlogAction::class, 'blog.index');
         $router->get($prefix .'/{slug}', BlogAction::class, 'blog.show')
                ->wheres(['slug' => '[a-z\-0-9]+']);
     }

}