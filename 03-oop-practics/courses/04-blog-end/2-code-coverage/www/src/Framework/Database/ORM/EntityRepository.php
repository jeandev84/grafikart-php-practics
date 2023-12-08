<?php
declare(strict_types=1);

namespace Framework\Database\ORM;


use App\Blog\Entity\Post;
use Framework\Database\ORM\Exceptions\NoRecordException;
use Framework\Database\PaginatedQuery;
use Framework\Database\Query;
use Framework\Database\QueryResult;
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
     * @param PDO|null $connection
     * @param string $classname
     * @param string $tableName
    */
    public function __construct(?PDO $connection, string $classname, string $tableName)
    {
        $this->connection = $connection;
        $this->classname  = $classname ?: \stdClass::class;
        $this->table  = $tableName;
    }




    /**
     * @return Query
    */
    public function makeQuery(): Query
    {
         return (new Query($this->connection))
                ->from($this->table, $this->table[0])
                ->into($this->classname);
    }




    /**
     * Recupere la liste cle valeur de nos enregistrement
     *
     * @return array
    */
    public function findList(): array
    {
         $results = $this->connection
                        ->query("SELECT id, name FROM {$this->table}")
                        ->fetchAll(PDO::FETCH_NUM);
         $list = [];
         foreach ($results as $result) {
             $list[$result[0]] = $result[1];
         }
         return $list;
    }




    /**
     * @inheritDoc
    */
    public function findAll(): Query
    {
        return $this->makeQuery();
    }




    /**
     * Recuperere une ligne par rapport un champs
     *
     * @param string $field
     * @param $value
     * @return mixed
     * @throws NoRecordException
    */
    public function findBy(string $field, $value): mixed
    {
        return $this->makeQuery()
                    ->where("$field = :$field")
                    ->params([$field => $value])
                    ->fetchOrFail();
    }





    /**
     * @inheritDoc
    */
    public function find(int $id): mixed
    {
        return $this->findBy('id', $id);
    }



    /**
     * Recupere le nombres d 'enregistrement
     *
     * @return int
    */
    public function count(): int
    {
        return $this->makeQuery()->count();
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
     * Verifie qu' un enregistrement exist
     *
     * @param $id
     *
     * @return bool
    */
    public function exists($id): bool
    {
         $statement = $this->connection->prepare("SELECT id FROM {$this->table} WHERE id = ?");
         $statement->execute([$id]);
         return $statement->fetchColumn() !== false;
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
    public function getPdo(): PDO
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