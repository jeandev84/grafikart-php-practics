<?php
declare(strict_types=1);

namespace Tests;


use App\Blog\Entity\Post;
use App\Blog\Repository\PostRepository;
use PDO;
use Phinx\Config\Config;
use Phinx\Migration\Manager;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Input\StringInput;
use Symfony\Component\Console\Output\NullOutput;

/**
 * Created by PhpStorm at 05.12.2023
 *
 * @DatabaseTestCase
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Tests
 */
class DatabaseTestCase extends TestCase
{


     public function getPdo(): PDO
     {
         return new \PDO('sqlite::memory:', null, null, [
             PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
             PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
         ]);
     }



     public function getManager(PDO $pdo)
     {
         $configArray = require('phinx.php');
         $configArray['environments']['test'] = [
             'adapter'    => 'sqlite',
             'connection' => $pdo
         ];

         $config  = new Config($configArray);
         return new Manager($config, new StringInput(''), new NullOutput());
     }



    public function migrateDatabase(PDO $pdo): void
    {
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_BOTH);
        $this->getManager($pdo)->migrate('test');
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    }


     public function seedDatabase(PDO $pdo): void
     {
         $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_BOTH);
         $this->getManager($pdo)->migrate('test');
         $this->getManager($pdo)->seed('test');
         $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
     }
}