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



    public function getClassName(): string
    {
       return $this->classname;
    }
}