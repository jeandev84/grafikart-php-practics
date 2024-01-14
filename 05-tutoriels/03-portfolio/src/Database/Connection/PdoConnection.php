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
           PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
           PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
       ];


       /**
        * @param string $dsn
        * @param string|null $username
        * @param string|null $password
        * @param array $options
        * @throws ConnectionException
       */
       public function __construct(string $dsn, string $username = null, string $password = null, array $options = [])
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
        * @param string $sql
        * @param string|null $classMapping
        * @return \PDOStatement
       */
       public function statement(string $sql,string $classMapping = null): \PDOStatement
       {
            $pdo = $this->getPdo();
            $statement = $pdo->prepare($sql);
            if ($classMapping) {
                $statement->setFetchMode(PDO::FETCH_CLASS, $classMapping);
            }
            return $statement;
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