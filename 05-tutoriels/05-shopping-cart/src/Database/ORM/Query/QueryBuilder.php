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
      public function select(string ...$selects): Select
      {
          $builder = new Select($this->connection);
          $builder->select(...$selects);
          return $builder;
      }




      /**
       * @param string $table
       * @param array $attributes
       * @return Insert
      */
      public function insert(string $table, array $attributes): Insert
      {
          $builder = new Insert($this->connection, $table);
          $builder->insert($attributes);
          return $builder;
      }




     /**
      * @param string $table
      * @param array $attributes
      * @return Update
     */
     public function update(string $table, array $attributes): Update
     {
         $builder = new Update($this->connection, $table);
         $builder->update($attributes);
         return $builder;
     }



    /**
     * @param string $table
     * @return Delete
    */
    public function delete(string $table): Delete
    {
        return new Delete($this->connection, $table);
    }
}