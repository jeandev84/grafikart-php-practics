<?php
declare(strict_types=1);

namespace App\Blog\Repository;


use App\Blog\Entity\Category;
use App\Blog\Entity\Post;
use Framework\Database\ORM\EntityRepository;
use Framework\Database\ORM\Exceptions\NoRecordException;
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
class PostRepository extends EntityRepository
{


       /**
        * @param \PDO $connection
       */
       public function __construct(\PDO $connection)
       {
           parent::__construct($connection, Post::class, 'posts');
       }



       public function findPaginatedPublic(int $perPage, int $currentPage): Pagerfanta
       {
            $query = new PaginatedQuery(
               $this->connection,
         "SELECT p.*, c.name as category_name, c.slug as category_slug
                FROM posts p 
                LEFT JOIN categories c ON c.id = p.category_id 
                ORDER BY p.created_at DESC",
    "SELECT COUNT(id) FROM {$this->table}",
               $this->classname
            );

            return (new Pagerfanta($query))
                   ->setMaxPerPage($perPage)
                   ->setCurrentPage($currentPage);
       }



    public function findPaginatedPublicForCategory(int $perPage, int $currentPage, int $categoryId): Pagerfanta
    {
            $query = new PaginatedQuery(
                $this->connection,
             "SELECT p.*, c.name as category_name, c.slug as category_slug
                    FROM posts as p 
                    LEFT JOIN categories as c ON c.id = p.category_id
                    WHERE p.category_id = :category
                    ORDER BY p.created_at DESC",
        "SELECT COUNT(id) FROM {$this->table} WHERE category_id = :category",
                   $this->classname,
                   ['category' => $categoryId]
            );

            return (new Pagerfanta($query))
                   ->setMaxPerPage($perPage)
                   ->setCurrentPage($currentPage);
    }




    public function findWithCategory(int $id)
    {
        return $this->fetchOrFail(
            "SELECT p.*, c.name category_name, c.slug category_slug 
                 FROM posts as p 
                 LEFT JOIN categories c ON  c.id = p.category_id
                 WHERE p.id = :id
                 ",
                 compact('id')
        );
    }




    /**
     * @return string
     */
    protected function paginationQuery(): string
    {
        return "SELECT p.id, p.name, c.name as category_name 
                   FROM {$this->table} as p
                   LEFT JOIN categories as c ON p.category_id = c.id
                   ORDER BY created_at DESC";
    }
}