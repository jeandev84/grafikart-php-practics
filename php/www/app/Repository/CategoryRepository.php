<?php
declare(strict_types=1);

namespace App\Repository;

use App\DTO\Input\PaginationDto;
use App\Entity\Category;
use App\Entity\Post;
use Exception;
use Grafikart\Database\Connection\PdoConnection;
use Grafikart\Database\ORM\Persistence\Repository\ServiceRepository;

/**
 * Created by PhpStorm at 27.11.2023
 *
 * @CategoryRepository
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Repository
 */
class CategoryRepository extends ServiceRepository
{

    protected string $tableName = 'category';


    public function __construct(PdoConnection $connection)
    {
        parent::__construct($connection, Category::class);
    }


    /**
     * @return Category[]
     */
    public function findAll(): array
    {
        return $this->queryAndFetchAll("SELECT * FROM {$this->tableName} ORDER BY id DESC");
    }




    /**
     * @param int $postId
     *
     * @return Category[]
     */
    public function findByPostId(int $postId): array
    {
        $sql = "SELECT c.id, c.slug, c.name 
                FROM post_category pc 
                JOIN category c ON pc.category_id = c.id
                WHERE pc.post_id = :postId
                ";

        return $this->connection
                    ->statement($sql)
                    ->map($this->classname)
                    ->setParameters(compact('postId'))
                    ->fetch()
                    ->all();
    }


    /**
     * @param array $ids
     * @return Category[]
     */
    public function findByPostIds(array $ids): array
    {
        $sql = "SELECT c.*, pc.post_id
                FROM post_category pc
                JOIN category c ON c.id = pc.category_id
                WHERE pc.post_id IN (:ids)";

        return $this->connection->statement($sql)
                                ->map($this->classname)
                                ->setParameters([
                                  'ids' => join(',', $ids)
                                ])
                                ->fetch()
                                ->all();
    }


    /**
     * @param Post[] $posts
     *
     * @return void
     */
    public function hydratePosts(array $posts): void
    {
        $postsByID = [];
        foreach ($posts as $post) {
            $postsByID[$post->getId()] = $post;
        }

        $categories = $this->findByPostIds(array_keys($postsByID));

        foreach ($categories as $category) {
            $postsByID[$category->getPostId()]->addCategory($category);
        }
    }



    public function listCategories(): array
    {
        $items = [];
        $categories = $this->queryAndFetchAll("SELECT * FROM {$this->tableName} ORDER BY name DESC");
        foreach ($categories as $category) {
            $items[$category->getId()] = $category->getName();
        }
        return $items;
    }


    public function countById(int $id)
    {
        return (int)$this->connection
                        ->query("SELECT COUNT(category_id) FROM post_category WHERE category_id = {$id}")
                        ->fetch()
                        ->nums()[0];
    }
}