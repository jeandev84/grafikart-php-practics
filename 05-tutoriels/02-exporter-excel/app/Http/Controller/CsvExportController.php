<?php
declare(strict_types=1);

namespace App\Http\Controller;

use App\Http\AbstractController;
use App\Repository\VideoRepository;
use Grafikart\Http\Request\ServerRequest;
use Grafikart\Http\Response\Response;

/**
 * CsvExportController
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  App\Http\Controller
 */
class CsvExportController extends AbstractController
{

    /**
     * @param ServerRequest $request
     * @return Response
     */
    public function exportCsv(ServerRequest $request): Response
    {
        $videoRepository = new VideoRepository($this->getConnection());

        $videos = $videoRepository->findVideos();

        $response = $this->render('csv/export.php', [
            'videos' => $videos
        ]);

        $filename = 'export-'. date('Y-m-d_H:i:s') . '.csv';

        return $response->withHeaders([
            'Content-Type' => 'text/csv',
            'Content-Disposition' => sprintf('attachment; filename="%s"', $filename)
        ]);
    }
}