<?php
declare(strict_types=1);

namespace Grafikart\Database\Connection;

use Grafikart\Database\Connection\Exception\ConnectionException;
use PDO;
use PDOException;

/**
 * PdoConnection
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Grafikart\Database\Factory
 */
class PdoConnection implements PdoConnectionInterface
{

       /**
        * @var PDO
       */
       protected $pdo;

       protected array $options = [
           PDO::ATTR_PERSISTENT          => true,
           PDO::ATTR_EMULATE_PREPARES    => 0,
           PDO::ATTR_DEFAULT_FETCH_MODE  => PDO::FETCH_OBJ,
           PDO::ATTR_ERRMODE             => PDO::ERRMODE_EXCEPTION
       ];


       /**
        * @param string $dsn
        * @param string|null $username
        * @param string|null $password
        * @param array $options
        * @throws ConnectionException
       */
       public function __construct(
           string $dsn,
           string $username = null,
           string $password = null,
           array $options = []
       )
       {
           try {
               $this->pdo = new PDO($dsn, $username, $password, $this->options);
               foreach ($options as $key => $value) {
                   $this->pdo->setAttribute($key, $value);
               }
           } catch (PDOException $e) {
                throw new ConnectionException($e->getMessage());
           }
       }




       /**
        * @param $key
        * @param $value
        * @return $this
       */
       public function setAttribute($key, $value): static
       {
           $this->pdo->setAttribute($key, $value);

           return $this;
       }


       /**
        * @return Query
       */
       public function createQuery(): Query
       {
           return new Query($this->getPdo());
       }


      /**
       * @param string $sql
       * @return Query
      */
      public function query(string $sql): Query
    {
        return $this->createQuery()->query($sql);
    }




       /**
        * @param string $sql
        * @return Query
       */
       public function statement(string $sql): Query
       {
            $statement = $this->createQuery();
            $statement->prepare($sql);
            return $statement;
       }





       /**
        * @return int
       */
       public function lastInsertId(): int
       {
           return intval($this->pdo->lastInsertId());
       }





       /**
        * @inheritDoc
       */
       public function getPdo(): PDO
       {
          return $this->pdo;
       }




       /**
        * @param string $sql
        * @return mixed
       */
       public function exec(string $sql): mixed
       {
           return $this->pdo->exec($sql);
       }




       /**
        * @param array $config
        * @return static
        * @throws ConnectionException
       */
       public static function make(array $config): static
       {
           return new self($config['dsn'],
               $config['username'] ?? '',
               $config['password'] ?? '',
               $config['options'] ?? []
           );
       }
}