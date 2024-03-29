<?php
declare(strict_types=1);

namespace App\Http\Controller\Admin;

use App\Entity\Work;
use App\Http\Controller\AdminController;
use App\Repository\CategoryRepository;
use App\Repository\ImageRepository;
use App\Repository\WorkRepository;
use Exception;
use Grafikart\HTML\Form\Form;
use Grafikart\Http\Parameter;
use Grafikart\Http\Request\ServerRequest;
use Grafikart\Http\Response\Response;

/**
 * WorkController
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  App\Http\Controller\Admin
*/
class WorkController extends AdminController
{

    public function index(ServerRequest $request): Response
    {
        $workRepository = new WorkRepository($this->getConnection());

        return $this->render('admin/work/index', [
            'works' => $workRepository->findAll()
        ]);
    }




    /**
     * @param ServerRequest $request
     * @return Response
     */
    public function create(ServerRequest $request): Response
    {
        $form = new Form($this->session->get('admin.work.store', []));

        $categoryRepository = new CategoryRepository($this->getConnection());

        return $this->render('admin/work/create', [
            'form'       => $form,
            'categories' => $categoryRepository->getCategoryList()
        ]);
    }





    /**
     * @param ServerRequest $request
     * @return Response
     */
    public function store(ServerRequest $request): Response
    {
        $params     = new Parameter($request->getParsedBody());
        $slug       = $params->get('slug');
        $token      = $params->get('_csrf');

        if (!$this->csrfToken->isValidToken($token)) {
            return new Response("Invalid token $token");
        }

        $this->session->set('admin.work.store', $params->all());

        if (!preg_match("/^[a-z\-0-9]+$/", $slug)) {
            $this->addFlash('danger', "Le slug $slug n' est pas valide");
            return $this->redirectToRoute('admin.work.create');
        }

        $workRepository = new WorkRepository($this->getConnection());

        # Persist work
        $id = $workRepository->create([
            'name'       => $params->get('name'),
            'slug'       => $slug,
            'content'    => $params->get('content'),
            'category_id' => $params->get('category_id')
        ]);

        # Upload image

        $this->addFlash('success', "La realisation a bien ete ajoutee");
        $this->session->forget('admin.work.store');
        return $this->redirectToRoute('admin.work.list');
    }




    /**
     * @param ServerRequest $request
     * @return Response
     * @throws Exception
     */
    public function edit(ServerRequest $request): Response
    {
        $id = (int)$request->getAttribute('id');

        $workRepository = new WorkRepository($this->getConnection());

        /** @var Work $work */
        $work = $workRepository->find($id);

        if (! $work) {
            $this->addFlash('danger', "Categorie ID#$id n' exist pas");
            return $this->redirectToRoute('admin.work.list');
        }

        $categoryRepository = new CategoryRepository($this->getConnection());

        $form = new Form([
            'name'       => $work->getName(),
            'slug'       => $work->getSlug(),
            'content'    => $work->getContent(),
            'category_id' => $work->getCategory()
        ]);

        $imageRepository = new ImageRepository($this->getConnection());

        return $this->render('admin/work/edit', [
            'work'       => $work,
            'form'       => $form,
            'categories' => $categoryRepository->getCategoryList(),
            'images'     => $imageRepository->findWorkImages($work->getId()),
            'uploadDir'  => $this->app['uploadDir']
        ]);
    }


    /**
     * @param ServerRequest $request
     * @return Response
     * @throws Exception
     */
    public function update(ServerRequest $request): Response
    {
        $workRepository = new WorkRepository($this->getConnection(), $this->app['uploadDir']);
        $id     = (int)$request->getAttribute('id');
        $params = new Parameter($request->getParsedBody());
        $slug   = $params->get('slug');
        $token  = $params->get('_csrf');

        if (!$this->csrfToken->isValidToken($token)) {
            return new Response("Invalid token $token");
        }

        $this->session->set('admin.work.update', $params->all());

        if (!preg_match("/^[a-z\-0-9]+$/", $slug)) {
            $this->addFlash('danger', "Le slug $slug n' est pas valide");
            return $this->redirectToRoute('admin.work.edit', compact('id'));
        }

        # Persist work
        $workRepository->update([
            'name'       => $params->get('name'),
            'slug'       => $slug,
            'content'    => $params->get('content'),
            'category_id' => $params->get('category_id')
        ], $id);


        # Upload image
        $files  = new Parameter($request->getUploadedFiles());
        if($images = $files->get('images')) {
            foreach ($images as $image) {
                $workRepository->saveImage($image, $id);
            }
        }

        $this->addFlash('success', "La realisation ID#$id a bien ete modifiee");
        $this->session->forget('admin.work.update');
        # return $this->redirectTo($this->generatePath('admin.work.list'));
        return $this->redirectToRoute('admin.work.edit', compact('id'));
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

        $workRepository = new WorkRepository($this->getConnection());

        $workRepository->delete($id);

        $this->addFlash('success', "La realisation id#$id a bien ete supprimer");

        return $this->redirectToRoute('admin.work.list');
    }
}