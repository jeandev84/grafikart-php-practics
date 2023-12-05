<?php
declare(strict_types=1);

namespace App\Blog\Repository;


use App\Blog\Entity\Post;
use Framework\Database\ORM\EntityRepository;
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


       /**
        * @return string
       */
       protected function paginationQuery(): string
       {
           return parent::paginationQuery(). " ORDER BY created_at DESC";
       }
}