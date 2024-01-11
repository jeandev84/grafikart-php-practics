<?php
declare(strict_types=1);

namespace App\Database\Connection;


/**
 * PdoConnectionInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  App\Database\Connection
 */
interface PdoConnectionInterface
{

    /**
     * Returns PDO connection
     *
     * @return \PDO
    */
    public function getPdo(): \PDO;
}