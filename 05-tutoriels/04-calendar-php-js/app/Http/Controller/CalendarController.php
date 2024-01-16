<?php
declare(strict_types=1);

namespace App\Http\Controller;

use App\Http\AbstractController;
use App\Repository\EventRepository;
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

       /**
        * Example: $date = new Date('2011-04-19');
        *
        * @param ServerRequest $request
        * @return Response
       */
       public function index(ServerRequest $request): Response
       {
           $year            = date('Y');
           $eventRepository = new EventRepository($this->getConnection());
           $calendar        = new FrenchCalendar($year);

           # dd($eventRepository->getEventsByYearAsAssoc($year));
           return $this->render('calendar/index', [
               'year'     => $year,
               'calendar' => $calendar,
               'events'   => $eventRepository->getEventsByYearAsAssoc($year)
           ]);
       }
}