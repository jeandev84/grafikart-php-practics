<?php
declare(strict_types=1);

namespace App\Database\Connection;

use App\Database\Connection\Exception\ConnectionException;
use PDO;

/**
 * ConnectionFactory
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  App\Database\Connection
 */
class ConnectionFactory
{
      /**
       * @return PdoConnection
       * @throws ConnectionException
      */
      public static function make(): PdoConnection
      {
          return new PdoConnection('mysql:host=127.0.0.1;dbname=tutocalendar;', 'root', 'secret', [
              #PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
          ]);
      }
}