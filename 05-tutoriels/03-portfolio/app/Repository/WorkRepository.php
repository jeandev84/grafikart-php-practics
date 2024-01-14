<?php
declare(strict_types=1);

namespace App\Repository;

use App\Entity\Category;
use App\Entity\Work;
use Grafikart\Database\Connection\PdoConnection;
use Grafikart\Database\ORM\Repository\EntityRepository;

/**
 * WorkRepository
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  App\Repository
 */
class WorkRepository extends EntityRepository
{

     /**
      * @param PdoConnection $connection
     */
     public function __construct(PdoConnection $connection)
     {
         parent::__construct($connection, Work::class, 'works');
     }
}