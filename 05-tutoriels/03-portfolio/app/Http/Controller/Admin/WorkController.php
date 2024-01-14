<?php
declare(strict_types=1);

namespace App\Http\Controller\Admin;

use App\Http\Controller\AdminController;
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

        return $this->render('admin/work/create', [
            'form' => $form
        ]);
    }





    /**
     * @param ServerRequest $request
     * @return Response
     */
    public function store(ServerRequest $request): Response
    {
        $params = new Parameter($request->getParsedBody());
        $name   = $params->get('name');
        $slug   = $params->get('slug');
        $token  = $params->get('_csrf');

        if (!$this->csrfToken->isValidToken($token)) {
            return new Response("Invalid token $token");
        }

        if (!preg_match("/^[a-z\-0-9]+$/", $slug)) {
            $this->addFlash('danger', "Le slug $slug n' est pas valide");
            $this->session->set('admin.work.store', $params->all());
            return $this->redirectTo($this->generatePath('admin.work.create'));
        }

        $workRepository = new WorkRepository($this->getConnection());
        $workRepository->create([
            'name' => $name,
            'slug' => $slug
        ]);
        $this->addFlash('success', "La realisation a bien ete ajoutee");
        $this->session->forget('admin.work.store');
        return $this->redirectTo($this->generatePath('admin.work.list'));
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

        $work = $workRepository->find($id);

        if (! $work) {
            $this->addFlash('danger', "Categorie ID#$id n' exist pas");
            return $this->redirectTo($this->generatePath('admin.work.list'));
        }

        $form = new Form([
            'name' => $work->getName(),
            'slug' => $work->getSlug()
        ]);

        return $this->render('admin/work/edit', [
            'work' => $work,
            'form'     => $form
        ]);
    }


    /**
     * @param ServerRequest $request
     * @return Response
     * @throws Exception
     */
    public function update(ServerRequest $request): Response
    {
        $workRepository = new WorkRepository($this->getConnection());
        $id     = (int)$request->getAttribute('id');
        $params = new Parameter($request->getParsedBody());
        $name   = $params->get('name');
        $slug   = $params->get('slug');
        $token  = $params->get('_csrf');

        if (!$this->csrfToken->isValidToken($token)) {
            return new Response("Invalid token $token");
        }

        if (!preg_match("/^[a-z\-0-9]+$/", $slug)) {
            $this->addFlash('danger', "Le slug $slug n' est pas valide");
            return $this->redirectTo($this->generatePath('admin.work.edit', compact('id')));
        }

        $workRepository->update([
            'name' => $name,
            'slug' => $slug
        ], $id);

        $this->addFlash('success', "La realisation ID#$id a bien ete modifiee");
        $this->session->forget('admin.work.update');
        return $this->redirectTo($this->generatePath('admin.work.list'));

        # return $this->redirectTo($this->generatePath('admin.work.edit', compact('id')));
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

        return $this->redirectTo($this->generatePath('admin.work.list'));
    }
}