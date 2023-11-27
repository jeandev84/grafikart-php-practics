<?php
declare(strict_types=1);

namespace App\Repository;


use App\Entity\Post;
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
     protected PDO $connection;

     public function __construct(PDO $connection)
     {
         $this->connection = $connection;
     }


    /**
     * @return \App\Entity\Post[]
     */
     public function findPosts(): array
     {
         $sql = "SELECT * FROM post ORDER BY created_at DESC LIMIT 12";

         $query = $this->connection->query($sql);

         return $query->fetchAll(PDO::FETCH_CLASS, $this->getClassName());
     }


     public function count(): int
     {
         return (int)$this->connection
                          ->query("SELECT COUNT(id) FROM post")
                          ->fetch(PDO::FETCH_NUM)[0];
     }


     public function getClassName(): string
     {
         return Post::class;
     }
}