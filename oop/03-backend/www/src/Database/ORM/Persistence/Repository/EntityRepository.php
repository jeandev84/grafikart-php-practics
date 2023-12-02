<?php
declare(strict_types=1);

namespace Grafikart\Database\ORM\Persistence\Repository;


use Exception;
use Grafikart\Database\Connection\PdoConnection;
use Grafikart\Database\ORM\Persistence\Repository\Exception\NotFoundException;

/**
 * Created by PhpStorm at 28.11.2023
 *
 * @EntityRepository
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Grafikart\Database\ORM\Persistence\Repository
 */
class EntityRepository implements EntityRepositoryIInterface
{

     protected PdoConnection $connection;
     protected string $classname;
     protected string $tableName = '';

     public function __construct(PdoConnection $connection, string $classname)
     {
         if (! $this->tableName) {
              throw new Exception("Could not found table name in [ ". get_called_class() . "]");
         }

         if (! $classname) {
             throw new Exception("Could not found class name in [ ". get_called_class() . "]");
         }

         $this->connection = $connection;
         $this->classname  = $classname;
     }



    public function find(int $id): mixed
    {
        $result = $this->connection
                        ->statement("SELECT * FROM {$this->tableName} WHERE id = :id")
                        ->setParameters(compact('id'))
                        ->map($this->classname)
                        ->fetch()
                        ->one();

        if ($result === false) {
            throw new NotFoundException($this->tableName, $id);
        }

        return $result;
    }



    public function findAll(): array
    {
        return $this->connection
                   ->statement("SELECT * FROM {$this->tableName}")
                   ->map($this->classname)
                   ->fetch()
                   ->all();
    }



    /**
     * Verifie si une valeur existe dans la table
     * @param string $field
     * @param $value
     * @param int|null $except
     * @return bool
    */
    public function exists(string $field, $value, ?int $except = null): bool
    {
        $sql = "SELECT COUNT(id) FROM {$this->tableName} WHERE $field = ?";
        $params = [$value];
        if ($except !== null) {
            $sql .= " AND id != ?";
            $params[] = $except;
        }
        $query = $this->connection->statement($sql)->setParameters($params);

        return (int)$query->fetch()->nums()[0] > 0;
    }




    public function delete(int $id): void
    {
        $executed = $this->connection->statement("DELETE FROM {$this->tableName} WHERE id = :id")
            ->setParameters(compact('id'))
            ->execute();

        if (! $executed) {
            throw new Exception("Could not delete the record with id#$id in the table $this->tableName");
        }
    }




    public function create(array $data): int
    {
        $sqlFields = [];
        foreach ($data as $key => $value) {
            $sqlFields[] = "$key = :$key";
        }

        $sql      = "INSERT INTO {$this->tableName} SET ". implode(', ', $sqlFields);
        $executed = $this->connection->statement($sql)->setParameters($data)->execute();

        if (! $executed) {
            throw new Exception("Impossible de creer l' enregistrement dans table $this->tableName");
        }


        return $this->connection->lastInsertId();
    }



    public function update(array $data, int $id): bool
    {
        $sqlFields = [];
        foreach ($data as $key => $value) {
            $sqlFields[] = "$key = :$key";
        }

        $sql = "UPDATE {$this->tableName} SET ". implode(', ', $sqlFields) ." WHERE id = :id";
        $executed = $this->connection->statement($sql)->setParameters(array_merge($data, compact('id')))->execute();

        if (! $executed) {
            throw new Exception("Impossible de modifier l' enregistrement $id dans table $this->tableName");
        }

        return true;
    }



    public function extract($key, $value): mixed {
        $records = $this->findAll();
        $return = [];
        foreach ($records as $k => $v) {
            $return[$v->{$key}] = $v->{$value};
        }
        return $return;
    }


    public function findBy(array $criteria, array $orderBy = [], int $limit = 0, int $offset = 0): mixed
    {
        return $this->findByQuery($criteria, $orderBy, $limit, $offset)->all();
    }



    public function findOneBy(array $criteria, array $orderBy = [], int $limit = 0, int $offset = 0): mixed
    {
        if(! $result = $this->findByQuery($criteria, $orderBy, $limit, $offset)->one()) {
            return null;
        }
        return $result;
    }




    public function queryAndFetchAll(string $sql)
    {
         return $this->connection->query($sql)
                                 ->map($this->classname)
                                 ->fetch()
                                 ->all();
    }



    public function getClassName(): string
    {
       return $this->classname;
    }



    protected function findByQuery(array $criteria, array $orderBy = [], int $limit = 0, int $offset = 0)
    {
        // TODO via QueryBuilder!!!
        $conditions = array_map(function ($column) {
            return "$column = :$column";
        }, array_keys($criteria));

        $sqlConditions = join(" AND ", $conditions);
        $ordering = array_map(function ($column, $direction) {
            return "$column $direction";
        }, $orderBy);

        $sqlOrderBy = join(', ', $ordering);
        $sql[] = "SELECT * FROM {$this->tableName} WHERE {$sqlConditions}";

        if ($orderBy) {
            $sql[] = "ORDER BY {$sqlOrderBy}";
        }

        if ($limit) {
            $sql[]  = "LIMIT {$limit}";
        }

        if ($offset) {
            $sql[] = "OFFSET {$offset}";
        }

        $sql = join(' ', $sql);

        return $this->connection
            ->statement($sql)
            ->setParameters($criteria)
            ->map($this->classname)
            ->fetch();
    }
}