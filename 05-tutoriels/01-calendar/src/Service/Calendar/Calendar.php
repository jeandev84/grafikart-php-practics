<?php
declare(strict_types=1);

namespace App\Service\Calendar;

use App\Database\Connection\PdoConnection;

/**
 * Calendar
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  App\Service\Calendar
 */
class Calendar
{


      /**
       * @param PdoConnection $connection
      */
      public function __construct(PdoConnection $connection)
      {
      }


      public function show(int $year, int $month)
      {

      }
}