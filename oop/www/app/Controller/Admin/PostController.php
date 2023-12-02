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
     public function create(Request $request): Response
     {
         $postRepository = new PostRepository($this->getConnection());
         $categoryRepository = new CategoryRepository($this->getConnection());

         $lastId = 0;
         if ($request->isMethod('POST')) {
             $lastId = $postRepository->create([
                 'title'   => $request->requests->get('title'),
                 'content' => $request->requests->get('content'),
                 'category_id' => $request->requests->getInt('category_id')
             ]);

             return $this->redirect("/admin/post/{$lastId}/edit");
         }

         $form = new BootstrapForm($_POST);

         return $this->render('admin/posts/create', [
             'form' => $form,
             'categories' => $categoryRepository->extract('id', 'title'),
             'created' => $lastId
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
                'content' => $request->requests->get('content'),
                'category_id' => $request->requests->getInt('category_id')
            ], $postId);
        }

        $post = $postRepository->findWithCategory($postId);
        $form = new BootstrapForm($post);

        return $this->render('admin/posts/edit', [
            'post' => $post,
            'form' => $form,
            'categories' => $categoryRepository->extract('id', 'title'),
            'updated' => $updated
        ]);
    }





    public function delete(Request $request): RedirectResponse
    {
         if ($request->isMethod('POST')) {
             $repository = new PostRepository($this->getConnection());
             $repository->delete($request->requests->getInt('id'));
         }

         return $this->redirect('/admin');
    }
}