<?php
declare(strict_types=1);

namespace App\Calendar;

use App\Database\Connection\ConnectionFactory;
use App\Database\Connection\PdoConnection;
use DateTime;

/**
 * Events
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  App\Calendar
 */
class Events
{

     /**
      * Recupere les evenements commencant entre 2 dates
      *
      * @param DateTime $start
      * @param DateTime $end
      * @return array
     */
     public function getEventsBetween(DateTime $start, DateTime $end): array
     {
         $connection = ConnectionFactory::make();
         $statement  = $connection->query("SELECT * FROM events WHERE start_at BETWEEN :start AND :end", [
             'start' => $start->format('Y-m-d 00:00:00'),
             'end'   => $end->format('Y-m-d 23:59:59')
         ]);

         $results = $statement->fetchAll();

         return $results;
     }
}