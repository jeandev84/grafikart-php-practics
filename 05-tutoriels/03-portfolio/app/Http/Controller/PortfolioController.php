<?php
declare(strict_types=1);

namespace App\Http\Controller;

use App\Http\AbstractController;
use App\Repository\CategoryRepository;
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
         * @param ServerRequest $request
         * @return Response
        */
        public function index(ServerRequest $request): Response
        {
            $slug = (string)$request->getQueryParams()['slug'] ?? '';
            $workRepository     = new WorkRepository($this->getConnection());
            $categoryRepository = new CategoryRepository($this->getConnection());

            $wheres = [];
            $title  = 'Bienvenue sur mon portfolio!';

            if($slug) {
               if($category = $categoryRepository->findOneBy(compact('slug'))) {
                   $wheres['category_id'] = $category->getId();
                   $title = "Mes realisations {$category->getName()}";
               }
            }

            return $this->render('portfolio/realisation/index', [
                'works'      => $workRepository->findPortfolioWorks($wheres),
                'categories' => $categoryRepository->findAll(),
                'title'      => $title
            ]);
        }



        /**
         * @param ServerRequest $request
         * @return Response
        */
        public function showRealisation(ServerRequest $request): Response
        {
            $slug = $request->getAttribute('slug', '');

            if (! $slug) {
                return $this->redirectToRoute('home')
                            ->withStatusCode(301);
            }

            $workRepository = new WorkRepository($this->getConnection());

            if (! $work = $workRepository->findBySlug($slug)) {
                 return $this->redirectToRoute('home');
            }

            $imageRepository = new ImageRepository($this->getConnection());

            $images = $imageRepository->findImagesByWork($work->getId());

            return $this->render('portfolio/realisation/show', [
                  'work'   => $work,
                  'images' => $images,
                  'title'  => $work->getName()
            ]);
        }




       /**
        * @param ServerRequest $request
        * @return Response
       */
       public function showByCategory(ServerRequest $request): Response
       {
            $slug = $request->getAttribute('slug', '');

            if (! $slug) {
                return $this->redirectToRoute('home')
                    ->withStatusCode(301);
            }

            return $this->redirectTo($this->generatePath('home') . "?slug=$slug");
       }
}