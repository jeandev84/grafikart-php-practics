<?php
declare(strict_types=1);

namespace App\Repository;


use App\Entity\Category;
use Grafikart\Database\Connection\PdoConnection;
use Grafikart\Database\ORM\Persistence\Repository\EntityRepositoryIInterface;

/**
 * Created by PhpStorm at 27.11.2023
 *
 * @CategoryRepository
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Repository
 */
class CategoryRepository implements EntityRepositoryIInterface
{


    /**
     * @var PdoConnection
     */
    protected PdoConnection $connection;


    /**
     * @param PdoConnection $connection
    */
    public function __construct(PdoConnection $connection)
    {
        $this->connection = $connection;
    }

    public function find(int $id): mixed
    {
        // TODO: Implement find() method.
    }

    public function findAll(): array
    {
        // TODO: Implement findAll() method.
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
                    ->map($this->getClassName())
                    ->setParameters(compact('postId'))
                    ->fetch()
                    ->all();
    }


    public function getClassName(): string
    {
        return Category::class;
    }
}