<?php
declare(strict_types=1);

namespace Framework\Database\ORM;


use App\Blog\Entity\Post;
use Framework\Database\PaginatedQuery;
use Pagerfanta\Pagerfanta;
use PDO;


/**
 * Created by PhpStorm at 06.12.2023
 *
 * @EntityRepository
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Framework\Database\ORM
*/
class EntityRepository implements EntityRepositoryInterface
{

    protected PDO $connection;



    /**
     * @var string
    */
    protected string $classname;



    /**
     * @var string
    */
    protected string $table;




    /**
     * @param PDO $connection
     * @param string $classname
     * @param string $tableName
    */
    public function __construct(PDO $connection, string $classname, string $tableName)
    {
        $this->connection = $connection;
        $this->classname  = $classname;
        $this->table  = $tableName;
    }





    /**
     * @param int $perPage
     * @param int $currentPage
     * @return Pagerfanta
     */
    public function findPaginated(int $perPage, int $currentPage): Pagerfanta
    {
        $query = new PaginatedQuery(
            $this->connection, $this->paginationQuery(),
            "SELECT COUNT(id) FROM {$this->table}",
            $this->classname
        );

        return (new Pagerfanta($query))
            ->setMaxPerPage($perPage)
            ->setCurrentPage($currentPage);
    }




    /**
     * @return string
     */
    protected function paginationQuery(): string
    {
        return "SELECT * FROM {$this->table}";
    }



    /**
     * @inheritDoc
    */
    public function find(int $id): mixed
    {
        $query = $this->connection->prepare("SELECT * FROM $this->table WHERE id = :id");
        $query->execute(compact('id'));
        if ($this->classname) {
            $query->setFetchMode(\PDO::FETCH_CLASS, $this->classname);
        }
        return $query->fetch() ?: null;
    }




    /**
     * @inheritDoc
    */
    public function findAll(): array
    {
        $query = $this->connection->prepare("SELECT * FROM $this->table");
        $query->execute();
        if ($this->classname) {
            $query->setFetchMode(\PDO::FETCH_CLASS, $this->classname);
        }
        return $query->fetchAll();
    }





    /**
     * @inheritDoc
    */
    public function update(array $data, int $id): bool
    {
        $fieldQuery = $this->buildFieldQuery($data);
        $data['id'] = $id;
        $query = $this->connection->prepare("UPDATE {$this->table} SET $fieldQuery WHERE id = :id");
        return $query->execute($data);
    }






    /**
     * @inheritDoc
    */
    public function insert(array $data): bool
    {
        $fields = array_keys($data);
        $values = array_map(function (string $field) {
            return ':'. $field;
        }, $fields);

        $columns = join(', ', array_keys($data));
        $valueBindings = join(', ', $values);
        $query = $this->connection->prepare("INSERT INTO {$this->table} ($columns) VALUES ($valueBindings)");
        return $query->execute($data);
    }





    /**
     * @inheritDoc
    */
    public function delete(int $id): bool
    {
        $query = $this->connection->prepare("DELETE FROM {$this->table} WHERE id = :id");
        return $query->execute(compact('id'));
    }




    /**
     * @return string
    */
    public function getClassname(): string
    {
        return $this->classname;
    }




    /**
     * @return string
    */
    public function getTable(): string
    {
        return $this->table;
    }




    /**
     * @return PDO
    */
    public function getConnection(): PDO
    {
        return $this->connection;
    }



    /**
     * @param array $params
     * @return string
    */
    private function buildFieldQuery(array $params): string
    {
        return join(", ", array_map(function (string $column) {
            return "$column = :$column";
        }, array_keys($params)));
    }
}