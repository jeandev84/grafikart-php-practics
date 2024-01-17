<?php
declare(strict_types=1);

namespace App\Repository;

use App\Entity\Product;
use Grafikart\Database\Connection\PdoConnection;
use Grafikart\Database\ORM\Repository\EntityRepository;
use Grafikart\Database\ORM\Repository\ServiceRepository;

/**
 * ProductRepository
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  App\Repository
 */
class ProductRepository extends ServiceRepository
{
    public function __construct(PdoConnection $connection)
    {
        parent::__construct($connection, Product::class);
    }


    public function findProduct(int $id): mixed
    {
         return $this->createQueryBuilder('p')
                     ->select('id')
                     ->where('id = :id')
                     ->setParameters(compact('id'))
                     ->fetch()
                     ->one();
    }
}