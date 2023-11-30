<?php
declare(strict_types=1);

namespace App\Controller\Admin;


use Grafikart\AbstractController;
use Grafikart\Http\Request\Request;

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
               'link' => $this->generateRoute('admin.posts')
           ]);
       }
}