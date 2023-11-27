<?php
declare(strict_types=1);

namespace App\Repository;


use App\DTO\Input\GetPosts;
use App\Entity\Post;
use Grafikart\Database\Connection\PdoConnection;
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
class PostRepository
{
     protected PdoConnection $connection;

     public function __construct(PdoConnection $connection)
     {
         $this->connection = $connection;
     }


    /**
     * @return \App\Entity\Post[]
     */
     public function findPosts(GetPosts $dto): array
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