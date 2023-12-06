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
          $pdo = $this->getPdo();
          $this->migrateDatabase($pdo);
          $this->postRepository = new PostRepository($pdo);
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
           $this->seedDatabase($this->postRepository->getPdo());
           $post = $this->postRepository->find(1);
           $this->assertInstanceOf(Post::class, $post);
      }


    public function testFindNotFoundRecord()
    {
        $post = $this->postRepository->find(1);
        $this->assertNull($post);
    }




     public function testUpdate()
    {
        $this->seedDatabase($this->postRepository->getPdo());
        $this->postRepository->update([
            'name' => 'Salut',
            'slug' => 'demo'
        ], 1);

        $post = $this->postRepository->find(1);
        $this->assertEquals('Salut', $post->name);
        $this->assertEquals('demo', $post->slug);
    }




    public function testInsert()
    {
         $this->postRepository->insert(['name' => 'Salut', 'slug' => 'demo']);

         $post = $this->postRepository->find(1);
         $this->assertEquals('Salut', $post->name);
         $this->assertEquals('demo', $post->slug);
    }





    public function testDelete()
    {
        $pdo = $this->postRepository->getPdo();
        $this->postRepository->insert(['name' => 'Salut', 'slug' => 'demo']);
        $this->postRepository->insert(['name' => 'Salut', 'slug' => 'demo']);
        $count = (int)$pdo->query("SELECT COUNT(id) FROM posts")->fetchColumn();
        $this->assertEquals(2, $count);
        $this->postRepository->delete((int)$pdo->lastInsertId());
        $count = (int)$pdo->query("SELECT COUNT(id) FROM posts")->fetchColumn();
        $this->assertEquals(1, $count);
    }

}