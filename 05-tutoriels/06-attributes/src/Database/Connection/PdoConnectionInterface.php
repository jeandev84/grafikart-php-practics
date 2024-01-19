<?php
declare(strict_types=1);

namespace Grafikart\Database\Connection;


/**
 * PdoConnectionInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Grafikart\Database\Factory
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