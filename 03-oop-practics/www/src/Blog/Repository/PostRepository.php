<?php
declare(strict_types=1);

namespace App\Blog\Repository;


/**
 * Created by PhpStorm at 05.12.2023
 *
 * @PostRepository
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Blog\Repository
 */
class PostRepository
{

        protected $pdo;

        public function __construct(\PDO $pdo)
        {
            $this->pdo = $pdo;
        }


        /**
         * @return \stdClass[]
        */
        public function findPaginated(): array
        {
            return $this->pdo->query("SELECT * FROM posts ORDER BY created_at LIMIT 10")
                             ->fetchAll();
        }



        public function find(int $id): mixed
        {
            $query = $this->pdo->prepare("SELECT * FROM posts WHERE id = ?");
            $query->execute([$id]);
            return $query->fetch();
        }
}