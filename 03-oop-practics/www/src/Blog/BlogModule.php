<?php
declare(strict_types=1);

namespace App\Blog;


use Admin\AdminModule;
use App\Blog\Actions\AdminBlogAction;
use App\Blog\Actions\BlogAction;
use Framework\Module;
use Framework\Routing\Router;
use Framework\Templating\Renderer\RendererInterface;
use Psr\Container\ContainerInterface;
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
     const MIGRATIONS = __DIR__.'/db/migrations';
     const SEEDS =  __DIR__.'/db/seeds';



     public function __construct(ContainerInterface $container)
     {
         # Renderer
         $container->get(RendererInterface::class)->addPath('blog', __DIR__.'/views');

         # Routing
         $router = $container->get(Router::class);
         $prefix = $container->get('blog.prefix');

         $router->get($prefix, BlogAction::class, 'blog.index');
         $router->get($prefix .'/{slug}-{id}', BlogAction::class, 'blog.show')
                 ->wheres(['slug' => '[a-z\-0-9]+', 'id' => '[0-9]+']);

         if ($container->has('admin.prefix')) {
             $prefix = $container->get('admin.prefix');
             $router->get("$prefix/posts", AdminBlogAction::class, 'blog.admin.index');
             $router->map("GET|POST", "$prefix/posts/{id}", AdminBlogAction::class, 'blog.admin.edit')
                    ->where('id', '\d+');
         }
     }

}