<?php
declare(strict_types=1);

namespace App\Http\Controller\Admin;

use App\Http\Controller\AdminController;
use App\Repository\CategoryRepository;
use App\Security\Token\UserTokenStorage;
use Grafikart\Http\Request\ServerRequest;
use Grafikart\Http\Response\RedirectResponse;
use Grafikart\Http\Response\Response;

/**
 * CategoryController
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  App\Http\Controller\Admin
 */
class CategoryController extends AdminController
{
      public function index(ServerRequest $request): Response
      {
          $categoryRepository = new CategoryRepository($this->getConnection());

          return $this->render('admin/category/index', [
              'categories' => $categoryRepository->findAll()
          ]);
      }




      /**
       * @param ServerRequest $request
       * @return Response
      */
      public function create(ServerRequest $request): Response
      {
         return $this->render('admin/category/create');
      }





    /**
     * @param ServerRequest $request
     * @return Response
    */
    public function store(ServerRequest $request): Response
    {
        return $this->redirectTo($this->generatePath('admin.category.list'));
    }





      /**
       * @param ServerRequest $request
       * @return Response
      */
      public function edit(ServerRequest $request): Response
      {
        $id = (int)$request->getQueryParams()['id'] ?? 0;

        $categoryRepository = new CategoryRepository($this->getConnection());

        $category = $categoryRepository->find($id);

        return $this->render('admin/category/edit', [
            'category' => $category
        ]);
     }





     /**
      * @param ServerRequest $request
      * @return Response
     */
     public function update(ServerRequest $request): Response
     {
          return $this->redirectTo($this->generatePath('admin.category.edit'));
     }






    /**
     * @param ServerRequest $request
     * @return Response
    */
    public function delete(ServerRequest $request): Response
    {
        $id = (int)$request->getAttribute('id');

        // CsrfTokenMiddleware
        $token = $request->getParsedBody()['_csrf'] ?? '';

        #dump($request);

        if (!$this->csrfToken->isValidToken($token)) {
            return new Response("Invalid token $token");
        }
        // End CsrfTokenMiddleware

        $categoryRepository = new CategoryRepository($this->getConnection());

        $categoryRepository->delete($id);

        $this->addFlash('success', "La categorie id#$id a bien ete supprimer");

        return $this->redirectTo($this->generatePath('admin.category.list'));
    }
}