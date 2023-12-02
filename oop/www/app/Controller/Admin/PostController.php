<?php
declare(strict_types=1);

namespace App\Controller\Admin;


use App\Repository\CategoryRepository;
use App\Repository\PostRepository;
use Grafikart\Container\Container;
use Grafikart\Controller;
use Grafikart\Database\ORM\Persistence\Repository\Exception\NotFoundException;
use Grafikart\HTML\BootstrapForm;
use Grafikart\Http\RedirectResponse;
use Grafikart\Http\Request;
use Grafikart\Http\Response;


/**
 * Created by PhpStorm at 02.12.2023
 *
 * @PostController
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Controller\Admin
 */
class PostController extends Controller
{


     public function index(): Response
     {
          // Middleware
          if (! $this->auth->logged()) {
              return $this->forbidden();
          }

          $postRepository = new PostRepository($this->getConnection());

          return $this->render('admin/posts/index', [
              'posts' => $postRepository->findAll()
          ]);
     }



     /**
      * @return Response
     */
     public function show(Request $request): Response
     {
         $postRepository = new PostRepository($this->getConnection());

         return $this->render('admin/posts/show', [
             'post' => $postRepository->find(1)
         ]);
     }




    /**
     * @param Request $request
     *
     * @return Response
     * @throws NotFoundException
     */
    public function edit(Request $request): Response
    {
        $postId         = $request->attributes->getInt('id');
        $postRepository = new PostRepository($this->getConnection());
        $categoryRepository = new CategoryRepository($this->getConnection());

        $updated = false;
        if ($request->isMethod('POST')) {
            $updated = $postRepository->update([
                'title'   => $request->requests->get('title'),
                'content' => $request->requests->get('content')
            ], $postId);
        }

        $post = $postRepository->find($postId);
        $form = new BootstrapForm($post);

        return $this->render('admin/posts/edit', [
            'post' => $post,
            'form' => $form,
            'categories' => $categoryRepository->extract('id', 'title'),
            'updated' => $updated
        ]);
    }





    public function delete($id): RedirectResponse
    {
         return $this->redirect('/admin');
    }
}