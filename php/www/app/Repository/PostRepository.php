<?php
declare(strict_types=1);

namespace App\Repository;


use App\DTO\Input\GetPosts;
use App\DTO\Input\PaginationDto;
use App\Entity\Category;
use App\Entity\Post;
use App\Helpers\PaginatedQuery;
use Exception;
use Grafikart\Database\Connection\PdoConnection;
use Grafikart\Database\ORM\Persistence\Repository\EntityRepositoryIInterface;
use Grafikart\Database\ORM\Persistence\Repository\Exception\NotFoundException;
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

    protected string $tableName = 'post';

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
        $categoryRepository = new \App\Repository\CategoryRepository($this->connection);
        $categoryRepository->hydratePosts($posts);
        return [$posts, $paginatedQuery];
    }




    public function findPaginatedForCategory(int $categoryId)
    {
        $paginatedQuery = new \App\Helpers\PaginatedQuery(
            "SELECT p.* 
            FROM post p 
            JOIN post_category pc ON pc.post_id = p.id
            WHERE pc.category_id = {$categoryId}
            ORDER BY created_at DESC",
            "SELECT COUNT(category_id) FROM post_category WHERE category_id = {$categoryId}"
        );

        /** @var \App\Entity\Post[] $posts */
        $posts  = $paginatedQuery->getItems(\App\Entity\Post::class);
        $categoryRepository = new \App\Repository\CategoryRepository($this->connection);
        $categoryRepository->hydratePosts($posts);
        return[$posts, $paginatedQuery];
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
                                 ->map($this->classname)
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
                    ->map($this->classname)
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



    public function updatePost(Post $post, array $categoryIds): bool
    {
        $pdo = $this->connection->getPdo();
        $pdo->beginTransaction();
        $this->update([
            'name' => $post->getName(),
            'slug' => $post->getSlug(),
            'content' => $post->getContent(),
            'created_at' => $post->getCreatedAt()->format('Y-m-d H:i:s'),
        ], $post->getId());

        $this->connection->executeQuery("DELETE FROM post_category WHERE post_id = {$post->getId()}");
        $statement = $this->connection->statement("INSERT INTO post_category SET post_id = ?, category_id = ?");
        foreach ($categoryIds as $categoryId) {
            $statement->setParameters([$post->getId(), $categoryId]);
            $statement->execute();
        }
        $pdo->commit();
        return true;
    }




    public function createPost(Post $post, array $categoryIds): int
    {
        $pdo = $this->connection->getPdo();
        $pdo->beginTransaction();
        $id = $this->create([
            'name' => $post->getName(),
            'slug' => $post->getSlug(),
            'content' => $post->getContent(),
            'created_at' => $post->getCreatedAt()->format('Y-m-d H:i:s'),
        ]);

        $post->setId($id);
        $this->connection->executeQuery("DELETE FROM post_category WHERE post_id = {$post->getId()}");
        $statement = $this->connection->statement("INSERT INTO post_category SET post_id = ?, category_id = ?");
        foreach ($categoryIds as $categoryId) {
            $statement->setParameters([$post->getId(), $categoryId]);
            $statement->execute();
        }
        $pdo->commit();
        return $id;
    }
}