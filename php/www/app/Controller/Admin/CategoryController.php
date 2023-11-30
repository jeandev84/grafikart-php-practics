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
 * @CategoryController
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Controller\Admin
 */
class CategoryController extends AdminController
{

    public function index(Request $request)
    {
        # Middleware
        \App\Security\Auth::check();

        $title = "Gestion des categories";
        $connection = \App\Helpers\Connection::make();
        $request    = \Grafikart\Http\Request\Request::createFromGlobals();
        $repository = new \App\Repository\CategoryRepository($connection);
        $categories  = $repository->findAll();

        return $this->render('admin/category/index', [
            'title' => 'Administration',
            'categories' => $categories,
            'delete' => $request->queries->has('delete')
        ]);
    }



    public function create(Request $request): Response
    {
        \App\Security\Auth::check();

        $errors  = [];
        $category    = new \App\Entity\Category();
        $fields = ['name', 'slug'];

        if ($request->isMethod('POST')) {
            $repository = new \App\Repository\CategoryRepository($this->getConnection());
            $validator = new \App\Validators\CategoryValidator($request->request->all(), $repository);
            \Grafikart\Helpers\ObjectHelper::hydrate($category, $request->request->all(), $fields);

            if ($validator->validate()) {
                $repository->create([
                    'name' => $category->getName(),
                    'slug' => $category->getSlug()
                ]);
                return new RedirectResponse($this->router->url('admin.categories') . '?created=1');
            } else {
                $errors = $validator->errors();
            }
        }

        $form = new \Grafikart\HTML\Form($category, $errors);

        return $this->render('admin/category/new', [
            'form'     => $form,
            'errors'   => $errors,
            'category' => $category
        ]);
    }





    public function edit(Request $request): Response
    {
        \App\Security\Auth::check();

        $repository = new \App\Repository\CategoryRepository($this->getConnection());
        $category = $repository->find($request->attributes->getInt('id'));

        $success = false;
        $errors = [];
        $fields = ['name', 'slug'];

        if ($request->isMethod('POST')) {

            $data = $request->request->all();
            $validator = new \App\Validators\CategoryValidator($data, $repository, $category->getId());
            \Grafikart\Helpers\ObjectHelper::hydrate($category, $data, $fields);

            if ($validator->validate()) {
                $repository->update([
                    'name' => $category->getName(),
                    'slug' => $category->getSlug()
                ], $category->getId());
                $success = true;
            } else {
                $errors = $validator->errors();
            }
        }

        $form = new \Grafikart\HTML\Form($category, $errors);

        return $this->render('admin/category/edit', [
             'success' => $success,
             'form'    => $form,
             'errors'  => $errors,
             'category'    => $category,
             'created' => $request->queries->has('created')
        ]);
    }




    public function delete(Request $request): RedirectResponse
    {
        \App\Security\Auth::check();

        $repository = new \App\Repository\CategoryRepository($this->getConnection());
        $repository->delete($request->attributes->getInt('id'));

        return new RedirectResponse($this->router->url('admin.categories') . "?delete=1");
    }
}