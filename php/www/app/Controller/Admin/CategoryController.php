<?php
declare(strict_types=1);

namespace App\Controller\Admin;


use Grafikart\AbstractController;
use Grafikart\Http\Request\Request;
use Grafikart\Http\Response\Response;

/**
 * Created by PhpStorm at 30.11.2023
 *
 * @CategoryController
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Controller\Admin
 */
class CategoryController extends AbstractController
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



    public function create(Request $request): Response
    {
        return $this->render('admin/category/new');
    }





    public function edit(Request $request)
    {
        return $this->render('admin/category/edit', [

        ]);
    }




    public function delete(Request $request)
    {
        $this->redirectToRoute('');
    }
}