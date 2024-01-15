<?php
declare(strict_types=1);

namespace App\Http\Controller\Admin;

use App\Http\Controller\AdminController;
use App\Repository\ImageRepository;
use App\Repository\WorkRepository;
use Grafikart\Http\Request\ServerRequest;
use Grafikart\Http\Response\RedirectResponse;
use Grafikart\Http\Response\Response;

/**
 * WorkImageController
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  App\Http\Controller\Admin
 */
class WorkImageController extends AdminController
{

      /**
       * Supprimer une image
       *
       * @param ServerRequest $request
       * @return Response
      */
      public function deleteImage(ServerRequest $request): Response
      {
          $token  = $request->getAttribute('csrf', '');
          $workId = (int)$request->getAttribute('work', 0);

          if (!$this->csrfToken->isValidToken($token)) {
              return new Response("Invalid token $token");
          }

          $imageId = (int)$request->getAttribute('id', 0);

          $workRepository = new WorkRepository($this->getConnection(), $this->app['uploadDir']);

          $workRepository->removeImage($imageId);

          $this->addFlash('success', "L' image id#$imageId a bien ete supprimer");

          return $this->redirectToRoute('admin.work.edit', ['id' => $workId]);
      }





      /**
       * Mettre une image a la une
       *
       * @param ServerRequest $request
       *
       * @return RedirectResponse
      */
      public function highlightImage(ServerRequest $request): RedirectResponse
      {
          $token  = $request->getAttribute('csrf', '');
          $workId = (int)$request->getAttribute('work', 0);

          if (!$this->csrfToken->isValidToken($token)) {
              return new Response("Invalid token $token");
          }

          $imageId = (int)$request->getAttribute('id', 0);

          $workRepository = new WorkRepository($this->getConnection(), $this->app['uploadDir']);

          $workRepository->highlightImage($workId, $imageId);

          $this->addFlash('success', "L' image id#$imageId a bien ete mise en avant");

          return $this->redirectToRoute('admin.work.edit', ['id' => $workId]);
      }
}