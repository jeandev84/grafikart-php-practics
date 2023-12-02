<?php
declare(strict_types=1);

namespace App\Repository;


use Grafikart\Database\Connection\PdoConnection;
use App\Entity\Post;
use Grafikart\Database\ORM\Persistence\Repository\ServiceRepository;

/**
 * Created by PhpStorm at 02.12.2023
 *
 * @PostRepository
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Repository
 */
class PostRepository extends ServiceRepository
{

    protected string $tableName = 'posts';


    public function __construct(PdoConnection $connection)
    {
        parent::__construct($connection, Post::class);
    }


    /**
     * @return array
     */
    public function findLatest(): array
    {
        $sql = "SELECT p.id, p.title, p.content, c.title as category 
                FROM {$this->tableName} p
                LEFT JOIN categories c ON p.category_id = c.id";

        return $this->connection
                    ->statement($sql)
                    ->map($this->classname)
                    ->fetch()
                    ->all();
    }


    /**
     * @param int $id
     * @return Post|false
     */
    public function find(int $id): mixed
    {
        $sql = "SELECT p.id, p.title, p.content, c.title as category 
                FROM {$this->tableName} p
                LEFT JOIN categories c ON p.category_id = c.id
                WHERE p.id = :id";

        return $this->connection
                    ->statement($sql)
                    ->setParameters(compact('id'))
                    ->map($this->classname)
                    ->fetch()
                    ->one();
    }


    public function findLastByCategory(int $categoryId): mixed
    {
        $sql = "SELECT p.id, p.title, p.content, c.title as category 
                FROM {$this->tableName} p
                LEFT JOIN categories c ON p.category_id = c.id
                WHERE p.category_id = :categoryId
                ";

         return $this->connection
                     ->statement($sql)
                     ->setParameters(compact('categoryId'))
                     ->map($this->classname)
                     ->fetch()
                     ->all();
    }


    public function exampleSomething(): mixed
    {
        /*
         $date       = date('Y-m-d H:i:s');
         $count      = $this->connection->executeQuery(
                            sprintf('INSERT INTO posts SET title="Mon titre", created_at="%s"', $date)
                     );
       */
        return [];
    }
}