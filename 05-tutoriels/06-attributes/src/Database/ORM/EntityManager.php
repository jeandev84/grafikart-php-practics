<?php
declare(strict_types=1);

namespace Grafikart\Database\ORM;

use Grafikart\Database\Connection\PdoConnection;
use Grafikart\Database\ORM\Repository\EntityRepository;

/**
 * EntityManager
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Grafikart\Database\ORM
 */
class EntityManager
{

       /**
        * @var EntityRepository[]
       */
       protected array $repositories = [];


       /**
        * @var PdoConnection
       */
       protected PdoConnection $connection;




       public function __construct()
       {
       }
}