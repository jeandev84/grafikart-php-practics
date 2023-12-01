<?php
declare(strict_types=1);

namespace App\Controller;


use App\Repository\PostRepository;
use Grafikart\Controller;
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
}