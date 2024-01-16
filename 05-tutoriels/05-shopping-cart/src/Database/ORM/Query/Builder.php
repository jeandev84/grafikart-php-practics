<?php
declare(strict_types=1);

namespace Grafikart\Database\ORM\Query;

use Grafikart\Database\Connection\PdoConnection;

/**
 * Builder
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Grafikart\Database\ORM\Query
 */
abstract class Builder
{
    /**
     * @var PdoConnection
    */
    protected PdoConnection $connection;


    /**
     * @var array
    */
    protected array $parameters = [];



    /**
     * @param PdoConnection $connection
     */
    public function __construct(PdoConnection $connection)
    {
        $this->connection = $connection;
    }





    /**
     * @param array $parameters
     * @return $this
    */
    public function setParameters(array $parameters): static
    {
         foreach ($parameters as $key => $value) {
             $this->setParameter($key, $value);
         }

         return $this;
    }




    /**
     * @param $key
     * @param $value
     * @return $this
    */
    public function setParameter($key, $value): static
    {
        $this->parameters[$key] = $value;

        return $this;
    }



    public function getStatement(): \PDOStatement
    {
        $this->connection->statement($this->getSQL(), $this->parameters);
    }


    /**
     * @return Query
    */
    public function getQuery(): Query
    {
        return new Query($this->connection->statement($this->getSQL(), []));
    }






    /**
     * @return string
    */
    abstract public function getSQL(): string;

}