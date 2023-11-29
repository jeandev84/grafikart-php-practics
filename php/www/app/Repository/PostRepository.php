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



    public function update(Post $post): void
    {
        $id = $post->getId();
        $sql = "UPDATE {$this->tableName} SET name = :name, slug = :slug, created_at = :created, content = :content WHERE id = :id";
        $executed = $this->connection->statement($sql)
                                     ->setParameters([
                                        'id' => $id,
                                        'name' => $post->getName(),
                                        'slug' => $post->getSlug(),
                                        'content' => $post->getContent(),
                                        'created' => $post->getCreatedAt()->format('Y-m-d H:i:s'),
                                    ])
                                    ->execute();

        if (! $executed) {
            throw new Exception("Impossible de modifier l' enregistrement $id dans table $this->tableName");
        }
    }




    public function create(Post $post): void
    {
        $sql = "INSERT INTO {$this->tableName} SET name = :name, slug = :slug, created_at = :created, content = :content";
        $executed = $this->connection->statement($sql)
            ->setParameters([
                'name' => $post->getName(),
                'slug' => $post->getSlug(),
                'content' => $post->getContent(),
                'created' => $post->getCreatedAt()->format('Y-m-d H:i:s'),
            ])
            ->execute();

        if (! $executed) {
            throw new Exception("Impossible de creer l' enregistrement dans table $this->tableName");
        }


        $post->setId($this->connection->lastInsertId());
    }
}