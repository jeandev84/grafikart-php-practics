<?php
declare(strict_types=1);

namespace App\Controller;



use Grafikart\AbstractController;
use Grafikart\Http\Response\Response;

/**
 * Created by PhpStorm at 30.11.2023
 *
 * @PostController
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Controller
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
}