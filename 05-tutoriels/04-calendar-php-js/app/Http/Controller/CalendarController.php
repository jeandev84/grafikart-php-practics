<?php
declare(strict_types=1);

namespace App\Http\Controller;

use App\Http\AbstractController;
use App\Service\Calendar\FrenchCalendar;
use Grafikart\Http\Request\ServerRequest;
use Grafikart\Http\Response\Response;
use Grafikart\Service\Calendar\Calendar;
use function date;

/**
 * CalendarController
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  App\Http\Controller
*/
class CalendarController extends AbstractController
{
       public function index(ServerRequest $request): Response
       {
           /* $date = new Date('2011-04-19'); */
           $calendar = new FrenchCalendar(date('Y'));

           return $this->render('calendar/index', [
               'calendar' => $calendar
           ]);
       }
}