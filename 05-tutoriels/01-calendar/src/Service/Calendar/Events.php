<?php
declare(strict_types=1);

namespace App\Service\Calendar;

use App\Database\Connection\ConnectionFactory;
use App\Database\Connection\Exception\ConnectionException;
use App\Entity\Event;
use App\Http\Parameter;
use App\Repository\EventsRepository;
use App\Utils\Format;
use DateTime;
use DateTimeInterface;

/**
 * Events
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package App\Service\Calendar
 */
class Events
{

    /**
     * @var EventsRepository
    */
    protected EventsRepository $eventRepository;

    /**
     * @param EventsRepository $eventRepository
     */
    public function __construct(EventsRepository $eventRepository)
    {
        $this->eventRepository = $eventRepository;
    }


    /**
     * Recupere tous les evenements commencant entre 2 dates
     *
     * @param DateTimeInterface $start
     * @param DateTimeInterface $end
     * @return array
     */
     public function getEventsBetween(DateTimeInterface $start, DateTimeInterface $end): array
     {
        return $this->eventRepository->findEventsBetween(
            $start->format('Y-m-d 00:00:00'),
            $end->format('Y-m-d 23:59:59')
        );
     }





    /**
     * Recupere tous les evenements commencant entre 2 dates indexe par jour
     *
     * @param DateTimeInterface $start
     * @param DateTimeInterface $end
     * @return array
     * @throws ConnectionException
    */
    public function getEventsBetweenByDay(DateTimeInterface $start, DateTimeInterface $end): array
    {
         $events = $this->getEventsBetween($start, $end);
         $days   = [];

         foreach ($events as $event) {
             $date = explode(' ', $event['start_at'])[0];
             if (! isset($days[$date])) {
                 $days[$date] = [$event];
             } else {
                 $days[$date][] = $event;
             }
         }

         return $days;
    }




    /**
     * @param Event $event
     * @param Parameter $param
     * @return Event
     * @throws \Exception
     */
    public function hydrate(Event $event, Parameter $param): Event
    {
        $event->setName($param->get('name'));
        $event->setDescription($param->get('description'));

        $date  = $param->get('date');
        $start = Format::dateImmutable('Y-m-d H:i', $date . ' '. $param->get('start'));
        $end   = Format::dateImmutable('Y-m-d H:i', $date . ' '. $param->get('end'));
        $event->setStartAt($start->format('Y-m-d H:i:s'));
        $event->setEndAt($end->format('Y-m-d H:i:s'));
        return $event;
    }





    /**
     * Recupere un evenement donne
     *
     * @param int $id
     * @return Event
     * @throws \Exception
     */
    public function findEvent(int $id): Event
    {
        if(! $event = $this->eventRepository->find($id)) {
            throw new \Exception("Aucun resultat n' a ete trouve");
        }

        return $event;
    }


    /**
     * @param Event $event
     * @return bool
     * @throws \Exception
     */
    public function createEvent(Event $event): bool
    {
        return $this->eventRepository->create([
            'name' => $event->getName(),
            'description' => $event->getDescription(),
            'start_at' => $event->getStartAt()->format('Y-m-d H:i:s'),
            'end_at' => $event->getEndAt()->format('Y-m-d H:i:s'),
        ]);
    }




    /**
     * @param Event $event
     * @return bool
     * @throws \Exception
    */
    public function updateEvent(Event $event): bool
    {
        if (! $id = $event->getId()) {
            return false;
        }

        return $this->eventRepository->update([
            'name' => $event->getName(),
            'description' => $event->getDescription(),
            'start_at' => $event->getStartAt()->format('Y-m-d H:i:s'),
            'end_at' => $event->getEndAt()->format('Y-m-d H:i:s'),
        ], $id);
    }




    /**
     * Supprime un evenement
     *
     * @param Event $event
     * @return bool
    */
    public function deleteEvent(Event $event): bool
    {
        if (! $id = $event->getId()) {
            return false;
        }

        return $this->eventRepository->delete($id);
    }
}