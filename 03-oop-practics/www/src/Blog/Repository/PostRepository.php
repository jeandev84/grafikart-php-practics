<?php
declare(strict_types=1);

namespace App\Blog\Repository;


use App\Blog\Entity\Post;
use Framework\Database\PaginatedQuery;
use Pagerfanta\Pagerfanta;

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
         * @param int $perPage
         * @param int $currentPage
         * @return Pagerfanta
        */
        public function findPaginated(int $perPage, int $currentPage): Pagerfanta
        {
            /*
            return $this->pdo->query("SELECT * FROM posts ORDER BY created_at LIMIT 10")
                             ->fetchAll();
            */

            $paginatedQuery = new PaginatedQuery(
                $this->pdo,
          "SELECT * FROM posts ORDER BY created_at DESC",
     "SELECT COUNT(id) FROM posts",
                Post::class
            );

            return (new Pagerfanta($paginatedQuery))
                   ->setMaxPerPage($perPage)
                   ->setCurrentPage($currentPage);
        }



        public function find(int $id): Post
        {
            $query = $this->pdo->prepare("SELECT * FROM posts WHERE id = ?");
            $query->execute([$id]);
            $query->setFetchMode(\PDO::FETCH_CLASS, Post::class);
            return $query->fetch();
        }
}