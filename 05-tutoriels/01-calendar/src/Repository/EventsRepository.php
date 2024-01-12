<?php
declare(strict_types=1);

namespace App\Repository;

use App\Database\Connection\PdoConnection;
use App\Database\ORM\Repository\EntityRepository;
use App\Entity\Event;

/**
 * EventsRepository
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  App\Repository
 */
class EventsRepository extends EntityRepository
{

      /**
       * @param PdoConnection $connection
      */
      public function __construct(PdoConnection $connection)
      {
          parent::__construct($connection, Event::class, 'events');
      }



      /**
       * @param string $start
       * @param string $end
       * @return Event[]
      */
      public function findEventsBetween(string $start, string $end): array
      {
          return $this->findBetween($start, $end);
      }
}