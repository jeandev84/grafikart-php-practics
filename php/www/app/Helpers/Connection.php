<?php
declare(strict_types=1);

namespace App\Helpers;


use Grafikart\Database\Connection\PdoConnection;

/**
 * Created by PhpStorm at 27.11.2023
 *
 * @Connection
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Helpers
 */
class Connection
{
     public static function getPDO(): \PDO
     {
         return static::make()->getPdo();
     }


    /**
     * @return PdoConnection
    */
    public static function make(): PdoConnection
     {
         return new PdoConnection(
             'mysql:dbname=tutoblog;host=127.0.0.1',
             'root',
             'secret'
         );
     }


}