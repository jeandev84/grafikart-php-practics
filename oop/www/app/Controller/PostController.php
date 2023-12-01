<?php
declare(strict_types=1);

namespace App\Controller;


use App\Repository\PostRepository;
use Grafikart\Controller;
use Grafikart\Database\ORM\Persistence\Repository\Exception\NotFoundException;
use Grafikart\Http\Request;
use Grafikart\Http\Response;


/**
 * Created by PhpStorm at 02.12.2023
 *
 * @PostController
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Controller
 */
class PostController extends Controller
{

    public function index(): Response
    {
        $connection = $this->getConnection();
        $repository = new PostRepository($connection);

        $posts = $repository->findAll();

        return $this->render('posts/index', [
            'posts' => $posts
        ]);
    }


     /**
      * @param Request $request
      * @return Response
      * @throws NotFoundException
    */
    public function show(Request $request): Response
    {
          $repository = new PostRepository($this->getConnection());
          $post       = $repository->find($request->attributes->getInt('id'));

          return $this->render('posts/show', [
              'post' => $post
          ]);
    }
}