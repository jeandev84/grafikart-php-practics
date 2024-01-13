<?php
declare(strict_types=1);

namespace App\Http\Controller;


use App\Http\AbstractController;
use App\Repository\VideoRepository;
use Grafikart\Http\Request\ServerRequest;
use Grafikart\Http\Response\Response;
use Grafikart\Service\Csv\CsvConvertor;

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

           $videos = $videoRepository->findVideosToExport();

           $csv = CsvConvertor::convertFromArray($videos);

           $filename = 'csv-'. date('Y-m-d_H:i:s') . '.csv';

           return new Response($csv, 200, [
               'Content-Type' => 'text/csv',
               'Content-Disposition' => sprintf('attachment; filename="%s"', $filename)
           ]);
      }




    /**
     * @param ServerRequest $request
     * @return Response
     */
    public function exportCsv1(ServerRequest $request): Response
    {
        $videoRepository = new VideoRepository($this->getConnection());

        $videos = $videoRepository->findVideos();

        $response = $this->render('csv/demo/export.php', [
            'videos' => $videos
        ]);

        $filename = 'csv-'. date('Y-m-d_H:i:s') . '.csv';

        return $response->withHeaders([
            'Content-Type' => 'text/csv',
            'Content-Disposition' => sprintf('attachment; filename="%s"', $filename)
        ]);
    }
}