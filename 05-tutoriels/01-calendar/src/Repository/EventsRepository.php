<?php
declare(strict_types=1);

namespace App\Repository;

use App\Database\Connection\PdoConnection;
use App\Entity\Event;

/**
 * EventsRepository
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  App\Repository
 */
class EventsRepository
{

      /**
       * @var PdoConnection
      */
      protected PdoConnection $connection;


      /**
       * @var string
      */
      protected string $className = Event::class;



      /**
       * @var string
      */
      protected string $tableName = 'events';



      /**
       * @param PdoConnection $connection
      */
      public function __construct(PdoConnection $connection)
      {
          $this->connection = $connection;
      }




     /**
      * @param string $start
      * @param string $end
      * @return array
     */
     public function findEventsBetween(string $start, string $end): array
     {
         $sql        = "SELECT * FROM  $this->tableName WHERE start_at BETWEEN :start AND :end ORDER BY start_at ASC";
         $statement  = $this->connection->statement($sql, compact('start', 'end'));
         #$statement  = $this->connection->statement($sql, compact('start', 'end'), $this->classMapping);
         return $statement->fetchAll();
     }




     /**
      * @param int $id
      * @return mixed
     */
     public function find(int $id): mixed
     {
         $sql        = 'SELECT * FROM events WHERE id = :id LIMIT 1';
         $statement  = $this->connection->statement($sql, compact('id'), $this->className);
         return $statement->fetch();
     }




     /**
      * @param array $data
      * @return bool
     */
     public function create(array $data): bool
     {
         $attributes = [];

         foreach (array_keys($data) as $key) {
             $attributes[$key] = ":$key";
         }

         $columns = join(', ', array_keys($attributes));
         $values  = join(', ', array_values($attributes));

         $sql = "INSERT INTO $this->tableName ($columns) VALUES($values)";

         return $this->connection->statement($sql)->execute($data);
     }



    /**
     * @param array $data
     * @param int $id
     * @return bool
    */
    public function update(array $data, int $id): bool
    {
        $attributes = [];

        foreach (array_keys($data) as $key) {
            $attributes[] = "$key = :$key";
        }

        $fields = join(', ', $attributes);

        $sql = "UPDATE $this->tableName SET $fields WHERE id = :id";

        $data['id'] = $id;

        return $this->connection->statement($sql)->execute($data);
    }




    /**
     * @param int $id
     * @return bool
    */
    public function delete(int $id): bool
    {
        $sql = "DELETE FROM $this->tableName WHERE id = :id";

        return $this->connection->statement($sql)->execute(compact('id'));
    }

}