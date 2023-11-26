<?php
declare(strict_types=1);

namespace App\Database\Connection;


use PDO;

/**
 * Created by PhpStorm at 26.11.2023
 *
 * @QueryResult
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Database\Connection
 */
class QueryResult
{

      protected \PDOStatement $statement;

      public function __construct(\PDOStatement $statement)
      {
          $this->statement = $statement;
      }


      public function all(): array
      {
          return $this->statement->fetchAll();
      }


      /**
       * @return mixed
      */
      public function one(): mixed
      {
          return $this->statement->fetch();
      }




      public function assoc(): array
      {
          return $this->statement->fetchAll(PDO::FETCH_ASSOC);
      }



      public function count(): int
      {
          return $this->statement->rowCount();
      }
}