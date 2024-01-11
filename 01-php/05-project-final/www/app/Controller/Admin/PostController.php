<?php
declare(strict_types=1);

namespace App\Controller\Admin;


use App\Controller\AdminController;
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
class PostController extends AdminController
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
           \App\Security\Auth::check();

           $connection = $this->getConnection();
           $errors  = [];
           $post    = new \App\Entity\Post();

           $categoryRepository = new \App\Repository\CategoryRepository($connection);
           $categories = $categoryRepository->list();
           $categoryRepository->hydratePosts([$post]);
           $post->setCreatedAt(date('Y-m-d H:i:s'));

           if ($request->isMethod('POST')) {

               $postRepository = new \App\Repository\PostRepository($connection);
               $data = $request->getParsedBodyWithFiles();
               $validator = new \App\Validators\PostValidator($data, $postRepository, $post->getId(), $categories);
               \Grafikart\Helpers\ObjectHelper::hydrate($post, $data, ['name', 'content', 'slug', 'created_at', 'image']);

               if ($validator->validate()) {
                   $pdo = $connection->getPdo();
                   $pdo->beginTransaction();
                   \App\Attachment\PostAttachment::upload($post);
                   $postRepository->createPost($post);
                   $postRepository->attachCategories($post->getId(), $request->request->get('category_ids'));
                   $pdo->commit();
                   return new RedirectResponse($this->router->url('admin.post', ['id' => $post->getId()]) . '?created=1');
               } else {
                   $errors = $validator->errors();
               }
            }

            $form = new \Grafikart\HTML\Form($post, $errors);

            return $this->render('admin/post/new', [
                'form'   => $form,
                'errors' => $errors,
                'post'   => $post,
                'categories' => $categories
            ]);
       }





       public function edit(Request $request)
       {
           \App\Security\Auth::check();

           $connection = $this->getConnection();
           $categoryRepository = new \App\Repository\CategoryRepository($connection);
           $categories         = $categoryRepository->list();
           $postRepository     = new \App\Repository\PostRepository($connection);
           /** @var \App\Entity\Post $post */
           $post = $postRepository->find($request->attributes->getInt('id'));
           $categoryRepository->hydratePosts([$post]);
           $success = false;
           $errors = [];

           if ($request->isMethod('POST')) {

               $data = $request->getParsedBodyWithFiles();
               $validator = new \App\Validators\PostValidator($data, $postRepository, $post->getId(), $categories);
               \Grafikart\Helpers\ObjectHelper::hydrate($post, $data, ['name', 'content', 'slug', 'created_at', 'image']);

               if ($validator->validate()) {
                   $pdo = $connection->getPdo();
                   $pdo->beginTransaction();
                   \App\Attachment\PostAttachment::upload($post);
                   $postRepository->updatePost($post);
                   $postRepository->attachCategories($post->getId(), $request->request->get('category_ids'));
                   $pdo->commit();
                   $categoryRepository->hydratePosts([$post]); // mise ajour
                   $success = true;
               } else {
                   $errors = $validator->errors();
               }
            }

            $form = new \Grafikart\HTML\Form($post, $errors);

            return $this->render('admin/post/edit', [
                'form'    => $form,
                'post'    => $post,
                'categories' => $categories,
                'success' => $success,
                'errors'  => $errors,
                'created' => $request->queries->has('created')
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