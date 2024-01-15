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
       * @param ServerRequest $request
       * @return Response
      */
      public function delete(ServerRequest $request): Response
      {
          $token  = $request->getAttribute('csrf', '');

          if (!$this->csrfToken->isValidToken($token)) {
              return new Response("Invalid token $token");
          }

          $id = (int)$request->getAttribute('id', 0);

          $workRepository = new WorkRepository($this->getConnection());

          $workRepository->removeImage($id);

          return $this->redirectTo($this->generatePath('admin.work.edit'));
      }
}