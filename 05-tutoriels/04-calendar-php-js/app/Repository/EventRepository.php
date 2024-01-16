<?php
declare(strict_types=1);

namespace App\Repository;

use App\Entity\Event;
use Grafikart\Database\Connection\PdoConnection;
use Grafikart\Database\ORM\Repository\EntityRepository;

/**
 * EventRepository
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  App\Repository
 */
class EventRepository extends EntityRepository
{
      public function __construct(PdoConnection $connection)
      {
          parent::__construct($connection, Event::class, 'events');
      }




      /**
       * @param string $year
       *
       * @return Event[]
      */
      public function getEventsByYear(string $year): array
      {
           $sql = "SELECT `id`, `title`, `date` 
                   FROM {$this->tableName} 
                   WHERE YEAR(date) = :year";

           $statement = $this->connection->statement($sql, $this->className);
           $statement->execute(compact('year'));
           return $statement->fetchAll();
      }


      /**
       * Returns year events as associative :
       * Example: $events[TIMESTAMP][id] = title
       *
       * @param string $year
       * @return array
      */
      public function getEventsByYearAsAssoc(string $year): array
      {
           $events = [];

           foreach ($this->getEventsByYear($year) as $event) {
               $events[strtotime($event->getDate())][$event->getId()] = $event->getTitle();
           }

           return $events;
      }
}