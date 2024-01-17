<?php
declare(strict_types=1);

namespace App\Repository;

use App\Entity\Product;
use App\Service\Shopping\CartService;
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


    /**
     * @param int $id
     * @return mixed
    */
    public function findProduct(int $id): mixed
    {
         return $this->createQueryBuilder('p')
                     ->select('id')
                     ->where('id = :id')
                     ->setParameters(compact('id'))
                     ->fetch()
                     ->one();
    }


    /**
     * @param array $ids
     *
     * @return Product[]
    */
    public function findProductsInCart(array $ids): array
    {
        return $this->createQueryBuilder('p')
                ->select('id')
                ->where('id IN (:ids)')
                ->setParameters(compact('ids'))
                ->fetch()
                ->all();
    }
}