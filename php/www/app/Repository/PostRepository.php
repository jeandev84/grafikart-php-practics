<?php
declare(strict_types=1);

namespace App\Repository;


use App\DTO\Input\GetPosts;
use App\DTO\Input\PaginationDto;
use App\Entity\Post;
use App\Helpers\PaginatedQuery;
use Exception;
use Grafikart\Database\Connection\PdoConnection;
use Grafikart\Database\ORM\Persistence\Repository\EntityRepositoryIInterface;
use Grafikart\Database\ORM\Persistence\Repository\ServiceRepository;
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
class PostRepository extends ServiceRepository
{

    public function __construct(PdoConnection $connection)
    {
        parent::__construct($connection, Post::class);
    }



    public function findPaginated(): array
    {
        $paginatedQuery = new PaginatedQuery(
     "SELECT * FROM post ORDER BY created_at DESC",
 "SELECT COUNT(id) FROM post",
            $this->connection
        );

        /** @var \App\Entity\Post[] $posts */
        $posts   = $paginatedQuery->getItems($this->getClassName());


        $postsById = [];
        foreach ($posts as $post) {
            $postsById[$post->getId()] = $post;
        }

        $categoryRepository = new \App\Repository\CategoryRepository($this->connection);
        $categories = $categoryRepository->findByPostIds(array_keys($postsById));

        foreach ($categories as $category) {
            $postsById[$category->getPostId()]->addCategory($category);
        }

        return [$posts, $paginatedQuery];
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
     public function findPostsBy(GetPosts $dto): array
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




    public function findPostsByCategory(PaginationDto $paginationDto, int $categoryId)
    {
        $offset = $paginationDto->getOffSet();
        $perPage  = $paginationDto->getLimit();

        # $sql = "SELECT * FROM post ORDER BY created_at DESC LIMIT $limit OFFSET 0";
        $sql = "SELECT p.* 
                FROM post p 
                JOIN post_category pc ON pc.post_id = p.id
                WHERE pc.category_id = {$categoryId}
                ORDER BY created_at DESC 
                LIMIT $perPage OFFSET $offset";

        return $this->connection
                    ->query($sql)
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