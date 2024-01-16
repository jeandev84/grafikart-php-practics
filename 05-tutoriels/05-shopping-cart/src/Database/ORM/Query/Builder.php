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
    protected array $wheres  = [];


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
     * @param string $condition
     *
     * @return $this
     */
    public function where(string $condition): static
    {
        $this->wheres[] = $condition;

        return $this;
    }






    /**
     * @param array $criteria
     * @return $this
    */
    public function criteria(array $criteria): static
    {
        foreach ($criteria as $column => $value) {
            if (is_array($value)) {
                $this->where("$column IN :$column");
            } else {
                $this->where("$column = :$column");
            }
       }

       $this->setParameters($criteria);

       return $this;
    }




    /**
     * @return string
    */
    public function whereSQL(): string
    {
        if (empty($this->wheres)) {
            return '';
        }

        return "WHERE ". join(' ', $this->wheres);
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



    /**
     * @return array
    */
    public function getParameters(): array
    {
        return $this->parameters;
    }





    /**
     * @return string
    */
    abstract public function getSQL(): string;

}