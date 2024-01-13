<?php
declare(strict_types=1);

namespace App\Factory;

use Grafikart\Database\Connection\Exception\ConnectionException;
use Grafikart\Database\Connection\PdoConnection;

/**
 * ConnectionFactory
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  App\Factory
*/
class ConnectionFactory
{
     /**
      * @return PdoConnection
      * @throws ConnectionException
     */
     public static function make(): PdoConnection
     {
         return PdoConnection::make([
             'dsn'      => 'mysql:host=127.0.0.1;charset=utf8',
             'username' => 'root',
             'password' => 'secret',
         ]);
     }
}