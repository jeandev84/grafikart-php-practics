<?php
declare(strict_types=1);

namespace App\Repository;


use App\DTO\Input\GetPosts;
use App\Entity\Post;
use Exception;
use Grafikart\Database\Connection\PdoConnection;
use Grafikart\Database\ORM\Persistence\Repository\EntityRepositoryIInterface;
use PDO;



/**
 * Created by PhpStorm at 27.11.2023
 *
 * @PostRepository
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Repository
 */
class PostRepository implements EntityRepositoryIInterface
{
     protected PdoConnection $connection;

     public function __construct(PdoConnection $connection)
     {
         $this->connection = $connection;
     }


     /**
      * @return Post[]
     */
     public function findAll(): array
     {
         # $sql = "SELECT * FROM post ORDER BY created_at DESC LIMIT $limit OFFSET 0";
         $sql = "SELECT * FROM post";

         return $this->connection->query($sql)
                     ->map($this->getClassName())
                     ->fetch()
                     ->all();
     }




    /**
     * @return \App\Entity\Post[]
     */
     public function findAllBy(GetPosts $dto): array
     {
         $offset = $dto->getPaginationDto()->getOffSet();
         $limit  = $dto->getPaginationDto()->getLimit();

         # $sql = "SELECT * FROM post ORDER BY created_at DESC LIMIT $limit OFFSET 0";
         $sql = "SELECT * FROM post ORDER BY created_at DESC LIMIT $limit OFFSET $offset";

         return $this->connection->query($sql)
                                 ->map($this->getClassName())
                                 ->fetch()
                                 ->all();
     }


     /**
      * @param int $id
      *
      * @return Post
      *
      * @throws Exception
     */
     public function find(int $id): Post
     {
         $sql = "SELECT * FROM post WHERE id = :id";

         $post = $this->connection->statement($sql)
                                 ->map($this->getClassName())
                                 ->setParameters(compact('id'))
                                 ->fetch()
                                 ->one();

         if ($post === false) {
             throw new Exception("Aucun article ne correspond a cet ID [$id]");
         }

         return $post;
     }


     public function count(): int
     {
         return (int)$this->connection
                          ->query("SELECT COUNT(id) FROM post")
                          ->fetch()
                          ->nums()[0];
     }


     public function getClassName(): string
     {
         return Post::class;
     }



     protected function getTableName(): string
     {
         return 'post';
     }
}