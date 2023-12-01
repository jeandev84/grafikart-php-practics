<?php
declare(strict_types=1);

namespace App\Repository;


use App\Database\Connection\PdoConnection;
use App\Entity\Post;
use Grafikart\Database\ORM\Persistence\Repository\ServiceRepository;

/**
 * Created by PhpStorm at 02.12.2023
 *
 * @PostRepository
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Repository
 */
class PostRepository extends ServiceRepository
{

    protected string $tableName = 'posts';


    public function __construct(\Grafikart\Database\Connection\PdoConnection $connection)
    {
        parent::__construct($connection, Post::class);
    }


    public function exampleSomething(): mixed
    {
        /*
         $date       = date('Y-m-d H:i:s');
         $count      = $this->connection->executeQuery(
                            sprintf('INSERT INTO posts SET title="Mon titre", created_at="%s"', $date)
                     );
       */
    }
}