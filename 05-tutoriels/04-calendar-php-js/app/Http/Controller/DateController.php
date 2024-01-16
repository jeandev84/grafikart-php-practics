<?php
declare(strict_types=1);

namespace App\Http\Controller;

use App\Http\AbstractController;
use Grafikart\Http\Request\ServerRequest;
use Grafikart\Http\Response\Response;
use Grafikart\Service\Calendar\Date;

/**
 * DateController
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  App\Http\Controller
 */
class DateController extends AbstractController
{
    public function index(ServerRequest $request): Response
    {
        return $this->render('date/index');
    }
}