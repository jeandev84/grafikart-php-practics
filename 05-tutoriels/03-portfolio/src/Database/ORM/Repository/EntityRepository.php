<?php
declare(strict_types=1);

namespace Grafikart\Database\ORM\Repository;

use Grafikart\Database\Connection\PdoConnection;

/**
 * EntityRepository
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Grafikart\Database\ORM\Repository
 */
class EntityRepository
{

    /**
     * @var PdoConnection
     */
    protected PdoConnection $connection;


    /**
     * @var string
     */
    protected string $className;



    /**
     * @var string
     */
    protected string $tableName;




    /**
     * @param PdoConnection $connection
     * @param string $className
     * @param string $tableName
    */
    public function __construct(PdoConnection $connection, string $className, string $tableName)
    {
        $this->connection = $connection;
        $this->className  = $className;
        $this->tableName  = $tableName;
    }




    /**
     * @param string $start
     * @param string $end
     * @return array
    */
    public function findBetween(string $start, string $end): array
    {
        $sql        = "SELECT * FROM  $this->tableName WHERE start_at BETWEEN :start AND :end ORDER BY start_at ASC";
        # $statement  = $this->connection->statement($sql, compact('start', 'end'));
        $statement  = $this->connection->statement($sql, compact('start', 'end'), $this->className);
        return $statement->fetchAll();
    }


    /**
     * @return array
    */
    public function findAll(): array
    {
        $sql        = "SELECT * FROM  $this->tableName";
        $statement  = $this->connection->statement($sql, [], $this->className);
        return $statement->fetchAll();
    }




    /**
     * @param array $wheres
     * @param int|null $limit
     * @param int|null $offset
     * @return array
    */
    public function findBy(array $wheres, int $limit = null, int $offset = null): array
    {
        $wheresArr = [];
        foreach (array_keys($wheres) as $column) {
            $wheresArr[] = "$column = :$column";
        }
        $conditions = join(' AND ', $wheresArr);
        $sql        = "SELECT * FROM  $this->tableName WHERE $conditions";

        if ($limit) {
            $sql .= " LIMIT ". ($offset ? "$limit,$offset" : $limit);
        }

        $statement  = $this->connection->statement($sql, $wheres, $this->className);
        return $statement->fetchAll();
    }


    /**
     * @param array $wheres
     * @param int|null $limit
     * @param int|null $offset
     * @return mixed
    */
    public function findOneBy(array $wheres, int $limit = null, int $offset = null): mixed
    {
        $wheresArr = [];
        foreach (array_keys($wheres) as $column) {
            $wheresArr[] = "$column = :$column";
        }
        $conditions = join(' AND ', $wheresArr);
        $sql        = "SELECT * FROM  $this->tableName WHERE $conditions";

        if ($limit) {
            $sql .= " LIMIT ". ($offset ? "$limit,$offset" : $limit);
        }

        $statement  = $this->connection->statement($sql, $wheres, $this->className);
        return $statement->fetch();
    }



    /**
     * @param int $id
     * @return mixed
     */
    public function find(int $id): mixed
    {
        return $this->findOneBy(compact('id'), 1);
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