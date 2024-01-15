<?php
declare(strict_types=1);

namespace App\Http\Controller;

use App\Http\AbstractController;
use App\Repository\UserRepository;
use App\Repository\WorkRepository;
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
         * @param int $id
         * @return Response
        */
        public function show(int $id): Response
        {
            return $this->render('portfolio/show', [

            ]);
        }
}