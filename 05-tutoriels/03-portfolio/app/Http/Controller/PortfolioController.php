<?php
declare(strict_types=1);

namespace App\Http\Controller;

use App\Http\AbstractController;
use App\Repository\ImageRepository;
use App\Repository\UserRepository;
use App\Repository\WorkRepository;
use Grafikart\Http\Request\ServerRequest;
use Grafikart\Http\Response\Response;
use Grafikart\Service\Image\ImageService;

/**
 * PortfolioController
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  App\Http\Controller
*/
class PortfolioController extends AbstractController
{

         /**
          * @return Response
         */
        public function index(): Response
        {
            $workRepository = new WorkRepository($this->getConnection());

            return $this->render('portfolio/index', [
                'works' => $workRepository->findPortfolioWorks()
            ]);
        }



        /**
         * @param ServerRequest $request
         * @return Response
        */
        public function show(ServerRequest $request): Response
        {
            $id = (int)$request->getAttribute('id');

            if (! $id) {
                return $this->redirectToRoute('home')
                            ->withStatusCode(301);
            }

            $workRepository = new WorkRepository($this->getConnection());

            if (! $work = $workRepository->find($id)) {
                 return $this->redirectToRoute('home');
            }

            $imageRepository = new ImageRepository($this->getConnection());

            $images = $imageRepository->findImagesByWork($id);

            return $this->render('portfolio/show', [
                  'work'   => $work,
                  'images' => $images
            ]);
        }
}