<?php
declare(strict_types=1);

namespace App\Shop\Repository;


use App\Shop\Entity\Product;
use Framework\Database\ORM\EntityRepository;
use PDO;

/**
 * Created by PhpStorm at 10.12.2023
 *
 * @ProductRepository
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Shop\Repository
 */
class ProductRepository extends EntityRepository
{

    public function __construct(?PDO $connection)
    {
        parent::__construct($connection, Product::class, 'products');
    }
}