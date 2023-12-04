<?php
declare(strict_types=1);

namespace Grafikart\Database\Connection;


use PDO;

/**
 * Created by PhpStorm at 26.11.2023
 *
 * @QueryResult
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Grafikart\Database\Connection
 */
class QueryResult implements QueryResultInterface
{

      protected \PDOStatement $statement;

      protected ?int $fetchMode;


      public function __construct(\PDOStatement $statement, int $fetchMode = 0)
      {
          $this->statement = $statement;
          $this->fetchMode = $fetchMode;
      }



      public function all(): array
      {
          return $this->statement->fetchAll($this->fetchMode);
      }




      /**
       * @return mixed
      */
      public function one(): mixed
      {
          return $this->statement->fetch($this->fetchMode);
      }





      public function assoc(): array
      {
          return $this->statement->fetchAll(PDO::FETCH_ASSOC);
      }



      public function nums(): mixed
      {
          return $this->statement->fetch(PDO::FETCH_NUM);
      }



      public function count(): int
      {
          return $this->statement->rowCount();
      }
}