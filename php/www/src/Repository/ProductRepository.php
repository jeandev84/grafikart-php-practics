<?php
declare(strict_types=1);

namespace App\Repository;


use App\Database\Connection\PdoConnection;
use App\DTO\GetProducts;


/**
 * Created by PhpStorm at 26.11.2023
 *
 * @ProductRepository
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Repository
 */
class ProductRepository
{

        public function __construct(protected PdoConnection $connection)
        {
        }


        public function findProductsBy(GetProducts $dto): array
        {
            $sql    = "SELECT * FROM products";
            $params = [];

            // Recherche par ville
            if ($q = $dto->getSearchDto()->searchQuery) {
                $sql .= " WHERE city LIKE :city";
                $params['city'] = '%'. $q . '%';
            }

            $sql .= "  LIMIT 20";

            return $this->connection->statement($sql)
                                    ->setParameters($params)
                                    ->fetch()
                                    ->assoc();
        }
}