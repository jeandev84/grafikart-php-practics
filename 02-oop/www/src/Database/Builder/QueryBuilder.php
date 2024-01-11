<?php
declare(strict_types=1);

namespace Grafikart\Database\Builder;


use Grafikart\Database\Connection\PdoConnection;

/**
 * Created by PhpStorm at 02.12.2023
 *
 * @QueryBuilder
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Grafikart\Database\Builder
 */
class QueryBuilder
{

     /**
      * @var PdoConnection
     */
     protected PdoConnection $connection;

     /**
      * @var array
     */
     protected array $fields = [];

     /**
      * @var array
     */
     protected array $conditions  = [];


     /**
      * @var array
     */
     protected array $from = [];



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
      * @return $this
     */
     public function select(): self
     {
         $this->fields = func_get_args();

         return $this;
     }






    /**
     * @param string $table
     * @param string $alias
     * @return $this
    */
    public function from(string $table, string $alias = ''): self
    {
        $this->from[] = $alias ? "$table AS $alias" : $table;

        return $this;
    }






    /**
     * @return $this
     */
     public function where(): self
     {
          foreach (func_get_args() as $arg) {
              # array_push($this->conditions, $arg);
              $this->conditions[] = $arg;
          }

          return $this;
     }






     /**
      * @param string $name
      *
      * @param $value
      *
      * @return $this
     */
     public function setParameter(string $name, $value): self
     {
          $this->parameters[$name] = $value;

          return $this;
     }





     /**
      * @param array $parameters
      *
      * @return $this
     */
     public function setParameters(array $parameters): self
     {
         foreach ($parameters as $name => $value) {
             $this->setParameter($name, $value);
         }

         return $this;
     }






     /**
      * @return string
     */
     public function getSQL(): string
     {
         $sql[]  = "SELECT ". join(', ', $this->fields);
         $sql[]  = "FROM ". join(', ', $this->from);
         $sql[]  = "WHERE ". join(' AND ', $this->conditions);

         return join(' ', $sql);
     }






     /**
      * @return mixed
     */
     public function getQuery(): mixed
     {
          return $this->connection
                      ->statement($this->getSQL())
                      ->setParameters($this->parameters)
                      ->fetch()
                      ->all();
     }





     /**
      * @return string
     */
     public function __toString(): string
     {
         return $this->getSQL();
     }
}