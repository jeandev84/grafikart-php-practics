<?php
declare(strict_types=1);

namespace App\Database\Connection;

use App\Database\Connection\Exception\ConnectionException;
use PDO;
use PDOException;

/**
 * PdoConnection
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  App\Database\Connection
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
        * @param string $sql
        * @param array $params
        * @param string|null $classMapping
        * @return \PDOStatement
       */
       public function statement(string $sql, array $params = [], string $classMapping = null): \PDOStatement
       {
            $pdo = $this->getPdo();
            $statement = $pdo->prepare($sql);
            if ($params) {
                $statement->execute($params);
            }
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
}