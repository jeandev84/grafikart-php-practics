<?php
declare(strict_types=1);

namespace App\Controller\Admin;


use Grafikart\AbstractController;
use Grafikart\Http\Request\Request;
use Grafikart\Http\Response\RedirectResponse;
use Grafikart\Http\Response\Response;

/**
 * Created by PhpStorm at 30.11.2023
 *
 * @PostController
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Controller\Admin
 */
class PostController extends AbstractController
{

       public function index(Request $request)
       {
           # Middleware
           \App\Security\Auth::check();

           $repository = new \App\Repository\PostRepository($this->getConnection());
           [$items, $pagination] = $repository->findPaginated();

           return $this->render('admin/post/index', [
               'title' => 'Administration',
               'items' => $items,
               'pagination' => $pagination,
               'link' => $this->generateRoute('admin.posts'),
               'delete' => $request->queries->has('delete')
           ]);
       }



       public function create(Request $request): Response
       {
            return $this->render('admin/post/new', [

            ]);
       }





       public function edit(Request $request)
       {
            return $this->render('admin/post/edit', [

            ]);
       }




       public function delete(Request $request): RedirectResponse
       {
            \App\Security\Auth::check();

            $postId = $request->attributes->getInt('id');

            $repository = new \App\Repository\PostRepository($this->getConnection());

            if($post = $repository->find($postId)) {
               \App\Attachment\PostAttachment::detach($post);
            }

            $repository->delete($postId);

            return new RedirectResponse($this->router->url('admin.posts') . "?delete=1");
       }
}