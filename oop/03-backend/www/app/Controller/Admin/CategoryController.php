<?php
declare(strict_types=1);

namespace App\Controller\Admin;


use App\Repository\CategoryRepository;
use App\Repository\PostRepository;
use Grafikart\Controller;
use Grafikart\Database\ORM\Persistence\Repository\Exception\NotFoundException;
use Grafikart\HTML\BootstrapForm;
use Grafikart\Http\RedirectResponse;
use Grafikart\Http\Request;
use Grafikart\Http\Response;

/**
 * Created by PhpStorm at 02.12.2023
 *
 * @CategoryController
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Controller\Admin
 */
class CategoryController extends Controller
{



    public function index(): Response
    {
        // Middleware
        if (! $this->auth->logged()) {
            return $this->forbidden();
        }

        $repository = new CategoryRepository($this->getConnection());

        return $this->render('admin/categories/index', [
            'categories' => $repository->findAll()
        ]);
    }



    /**
     * @return Response
     */
    public function create(Request $request): Response
    {
        $categoryRepository = new CategoryRepository($this->getConnection());

        $lastId = 0;
        if ($request->isMethod('POST')) {
            $lastId = $categoryRepository->create([
                'title'   => $request->requests->get('title')
            ]);

            return $this->redirect("/admin/categories");
        }

        $form = new BootstrapForm($_POST);

        return $this->render('admin/posts/create', [
            'form' => $form,
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
        $categoryId         = $request->attributes->getInt('id');
        $categoryRepository = new CategoryRepository($this->getConnection());

        $updated = false;
        if ($request->isMethod('POST')) {
            $updated = $categoryRepository->update([
                'title'   => $request->requests->get('title')
            ], $categoryId);
        }

        $category = $categoryRepository->find($categoryId);
        $form = new BootstrapForm($category);

        return $this->render('admin/categories/edit', [
            'category' => $category,
            'form' => $form,
            'updated' => $updated
        ]);
    }





    public function delete(Request $request): RedirectResponse
    {
        if ($request->isMethod('POST')) {
            $repository = new CategoryRepository($this->getConnection());
            $repository->delete($request->requests->getInt('id'));
        }

        return $this->redirect('/admin/categories');
    }
}