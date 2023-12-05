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

     protected PDO $pdo;


     public function setUp() {

         $pdo = new \PDO('sqlite::memory:', null, null, [
             PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
         ]);

         /*
         $app = new PhinxApplication();
         $app->setAutoExit(false);
         $app->run(new StringInput('migrate -e test'), new ConsoleOutput());
         */

         $configArray = require('phinx.php');
         $configArray['environments']['test'] = [
             'adapter'    => 'sqlite',
             'connection' => $pdo
         ];
         $config  = new Config($configArray);
         $manager = new Manager($config, new StringInput(''), new NullOutput());
         $manager->migrate('test');
         $manager->seed('test');
         $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
         $this->pdo = $pdo;
     }
}