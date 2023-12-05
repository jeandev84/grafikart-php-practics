<?php
declare(strict_types=1);

namespace Tests\Blog\Repository;


use App\Blog\Entity\Post;
use App\Blog\Repository\PostRepository;
use PDO;
use Phinx\Console\PhinxApplication;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Input\StringInput;
use Symfony\Component\Console\Output\ConsoleOutput;

/**
 * Created by PhpStorm at 05.12.2023
 *
 * @PostRepositoryTest
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Tests\Blog\Repository
 */
class PostRepositoryTest extends TestCase
{

      public function testFind()
      {
           $pdo = new \PDO('sqlite::memory:', null, null, [
               PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
               PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
           ]);

           $app = new PhinxApplication();
           $app->setAutoExit(false);
           $app->run(new StringInput('migrate -e test'), new ConsoleOutput());

           $pdo->exec('CREATE TABLE posts (
               name varchar(255))'
           );
           $postRepository = new PostRepository($pdo);
           $post = $postRepository->find(1);
           $this->assertInstanceOf(Post::class, $post);
      }
}