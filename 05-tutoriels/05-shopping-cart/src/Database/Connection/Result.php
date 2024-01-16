<?php
declare(strict_types=1);

namespace Grafikart\Database\Connection;

use PDO;
use PDOStatement;

/**
 * Result
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Grafikart\Database\Connection
 */
class Result
{

      /**
       * @var PDOStatement
      */
      protected PDOStatement $statement;


      /**
       * @param PDOStatement $statement
      */
      public function __construct(PDOStatement $statement)
      {
          $this->statement = $statement;
      }



      /**
       * @param int|null $mode
       *
       * @return array
      */
      public function all(int $mode = null): array
      {
          return $this->statement->fetchAll($mode);
      }




      /**
       * @param int|null $mode
       * @return mixed
      */
      public function one(int $mode = null): mixed
      {
          return $this->statement->fetch($mode);
      }




      /**
       * @return array
      */
      public function assoc(): array
      {
          return $this->all(PDO::FETCH_ASSOC);
      }




      /**
       * @param int $column
       * @return mixed
      */
      public function column(int $column = 0): mixed
      {
          return $this->statement->fetchColumn($column);
      }



      /**
       * @return array|false
      */
      public function columns(): array|false
      {
          return $this->all(PDO::FETCH_COLUMN);
      }




      /**
       * @return int
      */
      public function count(): int
      {
          return $this->statement->rowCount();
      }
}