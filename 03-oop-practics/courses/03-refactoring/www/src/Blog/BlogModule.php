<?php
declare(strict_types=1);

namespace App\Blog;


use App\Blog\Actions\CategoryCrudAction;
use App\Blog\Actions\CategoryShowAction;
use App\Blog\Actions\PostCrudAction;
use App\Blog\Actions\BlogAction;
use App\Blog\Actions\PostIndexAction;
use App\Blog\Actions\PostShowAction;
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

         $router->get($prefix, PostIndexAction::class, 'blog.index');
         $router->get($prefix .'/{slug}-{id}', PostShowAction::class, 'blog.show')
                ->wheres(['slug' => '[a-z\-0-9]+', 'id' => '[0-9]+']);
         $router->get($prefix .'/category/{slug}', CategoryShowAction::class, 'blog.category')
                ->wheres(['slug' => '[a-z\-0-9]+']);

         if ($container->has('admin.prefix')) {
             $prefix = $container->get('admin.prefix');
             $router->crud("$prefix/posts", PostCrudAction::class, 'blog.admin.post');
             $router->crud("$prefix/categories", CategoryCrudAction::class, 'blog.admin.category');
         }
     }

}