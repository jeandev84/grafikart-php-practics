<?php
declare(strict_types=1);

namespace App\Repository;

use App\Database\Connection\PdoConnection;
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
class EventsRepository
{

      /**
       * @var PdoConnection
      */
      protected PdoConnection $connection;


      /**
       * @var string
      */
      protected string $classMapping = Event::class;


      /**
       * @param PdoConnection $connection
      */
      public function __construct(PdoConnection $connection)
      {
          $this->connection = $connection;
      }




     /**
      * @param string $start
      * @param string $end
      * @return array
     */
     public function findEventsBetween(string $start, string $end): array
     {
         $sql        = 'SELECT * FROM events WHERE start_at BETWEEN :start AND :end';
         $statement  = $this->connection->statement($sql, compact('start', 'end'));
         #$statement  = $this->connection->statement($sql, compact('start', 'end'), $this->classMapping);
         return $statement->fetchAll();
     }




     /**
      * @param int $id
      * @return mixed
     */
     public function find(int $id): mixed
     {
         $sql        = 'SELECT * FROM events WHERE id = :id LIMIT 1';
         $statement  = $this->connection->statement($sql, compact('id'), $this->classMapping);
         return $statement->fetch();
     }
}