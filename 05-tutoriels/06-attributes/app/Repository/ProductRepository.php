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
     * @param array $productIds
     *
     * @return Product[]
    */
    public function findProductsInCart(array $productIds): mixed
    {
        if (empty($productIds)) {
            return [];
        }

        return $this->createNativeQuery(
            'SELECT * FROM products WHERE id IN (' . implode(',', $productIds) . ')'
        )->map($this->getClassName())->fetch()->all();
    }





    private function toReviews(): void
    {
        /*
        // TODO code reviews fix bug
        return $this->createQueryBuilder('p')
               ->where('id IN (1, 2)')
               #->setParameters(compact('ids'))
               ->fetch()
               ->all();
       $productIds = join(',', $ids);

       return $this->createQueryBuilder('p')
               ->where('p.id IN (:ids)')
               ->setParameters([
                   'ids' => '('. join(',', $ids) . ')'
               ])
               ->fetch()
               ->all();
       */

    }
}