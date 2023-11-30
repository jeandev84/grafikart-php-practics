<?php
declare(strict_types=1);

namespace App\Controller\Blog;



use Grafikart\AbstractController;
use Grafikart\Http\Request\Request;
use Grafikart\Http\Response\Response;

/**
 * Created by PhpStorm at 30.11.2023
 *
 * @PostController
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Controller\Blog
 */
class PostController extends AbstractController
{
      /**
       * @return Response
       * @throws \Exception
      */
      public function index(): Response
      {
           $connection = \App\Helpers\Connection::make();
           $postCategory = new \App\Repository\PostRepository($connection);
           [$posts, $pagination] = $postCategory->findPaginated();

           return $this->render("post/index", [
               'title' => 'Mon blog',
               'posts' => $posts,
               'pagination' => $pagination,
               'link' => $this->router->url('home')
           ]);
      }



      public function show(Request $request)
      {
           $id   = $request->attributes->getInt('id');
           $slug = $request->attributes->get('slug');
           $connection = \App\Helpers\Connection::make();
           $postRepository = new \App\Repository\PostRepository($connection);
           $post = $postRepository->find($id);
           $categoryRepository = new \App\Repository\CategoryRepository($connection);
           $categoryRepository->hydratePosts([$post]);

            if ($post->getSlug() !== $slug) {
               return $this->redirectToRoute('post', [
                   'slug' => $post->getSlug(), 'id' => $id
               ]);
            }

            return $this->render('post/show', [
                'post' => $post
            ]);
      }
}