<?php
declare(strict_types=1);

namespace App\Controller\Admin;


use App\Repository\CategoryRepository;
use App\Repository\PostRepository;
use Grafikart\Controller;
use Grafikart\Database\ORM\Persistence\Repository\Exception\NotFoundException;
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


    /**
     * @return Response
    */
    public function index(): Response
    {
        // Middleware
        if (! $this->auth->logged()) {
            return $this->forbidden();
        }

        $categoryRepository = new CategoryRepository($this->getConnection());

        return $this->render('admin/categories/index', [
            'categories' => $categoryRepository->findAll()
        ]);
    }




    /**
     * @param Request $request
     * @return Response
     * @throws NotFoundException
    */
    public function show(Request $request): Response
    {
        $postRepository = new PostRepository($this->getConnection());

        return $this->render('admin/categories/show', [
            'category' => $postRepository->find(1)
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
        $postRepository = new PostRepository($this->getConnection());

        return $this->render('admin/categories/edit', [
            'post' => $postRepository->find(1)
        ]);
    }




    /**
     * @param $id
     *
     * @return RedirectResponse
    */
    public function delete($id): RedirectResponse
    {
        return $this->redirect('/admin/category');
    }
}