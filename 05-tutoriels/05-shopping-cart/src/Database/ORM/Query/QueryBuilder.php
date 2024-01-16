<?php
declare(strict_types=1);

namespace Grafikart\Database\ORM\Query;

use Grafikart\Database\Connection\PdoConnection;
use Grafikart\Database\ORM\Query\SQL\Delete;
use Grafikart\Database\ORM\Query\SQL\Insert;
use Grafikart\Database\ORM\Query\SQL\Select;
use Grafikart\Database\ORM\Query\SQL\Update;

/**
 * QueryBuilder
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Grafikart\Database\ORM\Query
 */
class QueryBuilder
{

      /**
       * @var PdoConnection
      */
      protected PdoConnection $connection;



      /**
       * @param PdoConnection $connection
      */
      public function __construct(PdoConnection $connection)
      {
          $this->connection = $connection;
      }


      /**
       * @param string|null $selects
       *
       * @return Select
      */
      public function select(string $selects = null): Select
      {
          $builder = new Select($this->connection);
          $builder->addSelect($selects ?: "*");
          return $builder;
      }




      /**
       * @param array $attributes
       * @return Insert
      */
      public function insert(array $attributes): Insert
      {
          $builder = new Insert($this->connection);
          return $builder;
      }


     /**
      * @param array $attributes
      * @return Update
     */
     public function update(array $attributes): Update
     {
         $builder = new Update($this->connection);
         return $builder;
     }


    /**
     * @param array $wheres
     * @return Delete
    */
    public function delete(array $wheres = []): Delete
    {
        $builder = new Delete($this->connection);
        return $builder;
    }
}