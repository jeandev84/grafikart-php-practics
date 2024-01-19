<?php
declare(strict_types=1);

namespace Grafikart\Database\Connection;

/**
 * MysqlConnection
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Grafikart\Database\Connection
 */
class MysqlConnection extends PdoConnection
{
    public function __construct(string $dsn, string $username = null, string $password = null)
    {
        parent::__construct($dsn, $username, $password, [
            \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'
        ]);
    }
}