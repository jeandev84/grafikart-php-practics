<?php
declare(strict_types=1);

namespace Grafikart\Database\ORM\Query;

use Grafikart\Database\Connection\Exception\QueryException;
use Grafikart\Database\Connection\PdoConnection;
use Grafikart\Database\Connection\Query;

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
     * @var array
    */
    protected array $bindings  = [];



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
     * @param int|null $type
     * @return $this
    */
    public function setParameter($key, $value, int $type = null): static
    {
        if ($type) {
            $this->bindings[$key] = [$value, $type];
        } else {
            $this->parameters[$key] = $value;
        }

        return $this;
    }


    /**
     * @return Query
     * @throws QueryException
    */
    public function getQuery(): Query
    {
         $statement = $this->connection->statement($this->getSQL());

         if (!empty($this->bindings)) {
             foreach ($this->bindings as $key => [$value, $type]) {
                 $statement->bindParam($key, $value, $type);
             }
         }

         $statement->withParams($this->parameters);

         return $statement;
    }



    /**
     * @return string
    */
    abstract public function getSQL(): string;

}