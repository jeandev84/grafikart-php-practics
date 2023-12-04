<?php
declare(strict_types=1);

namespace Grafikart\Database\Builder\SQL;


use Grafikart\Database\Connection\PdoConnection;
use Grafikart\Database\Connection\Query;
use Grafikart\Database\Connection\QueryInterface;

/**
 * Created by PhpStorm at 28.11.2023
 *
 * @Builder
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Grafikart\Database\Builder\SQL
 */
abstract class Builder implements BuilderInterface
{

     protected PdoConnection $connection;


     public function __construct(PdoConnection $connection)
     {
         $this->connection = $connection;
     }


     public function getQuery(): QueryInterface
     {
          return $this->connection->statement($this->getSQL());
     }



     abstract public function getSQL(): string;
}