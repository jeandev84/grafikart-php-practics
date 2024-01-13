<?php
declare(strict_types=1);

namespace App\Http\Controller;


use App\Http\AbstractController;
use App\Repository\VideoRepository;
use Grafikart\Http\Response;
use Grafikart\Http\ServerRequest;

/**
 * ExcelController
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package  App\Http\Controller
*/
class CsvController extends AbstractController
{

      /**
       * @return Response
      */
      public function index(): Response
      {
          return $this->render('csv/index.php');
      }



      /**
        * @param ServerRequest $request
        * @return Response
      */
      public function export(ServerRequest $request): Response
      {
           $videoRepository = new VideoRepository($this->getConnection());

           $videos = $videoRepository->findAllVideos();

           return $this->render('csv/export.php', [
               'videos' => $videos
           ]);
      }
}