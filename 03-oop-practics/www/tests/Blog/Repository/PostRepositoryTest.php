<?php
declare(strict_types=1);

namespace Tests\Blog\Repository;

use App\Blog\Entity\Post;
use App\Blog\Repository\PostRepository;
use Tests\DatabaseTestCase;

/**
 * Created by PhpStorm at 05.12.2023
 *
 * @PostRepositoryTest
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Tests\Blog\Repository
 */
class PostRepositoryTest extends DatabaseTestCase
{

      protected $postRepository;


      public function setUp()
      {
          parent::setUp();
          $this->postRepository = new PostRepository($this->pdo);
          # $this->pdo->beginTransaction();
      }



      protected function tearDown(): void
      {
          # $this->pdo->rollBack();
      }



      public function testFind()
      {
           /*
           $count = (int)$this->pdo->query("SELECT COUNT(id) FROM posts")->fetchColumn();
           $this->assertEquals(100, $count);
           */

           $post = $this->postRepository->find(1);
           $this->assertInstanceOf(Post::class, $post);
      }


    public function testFindNotFoundRecord()
    {
        $post = $this->postRepository->find(1000000);
        $this->assertNull($post);
    }
}