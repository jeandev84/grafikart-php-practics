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
            $sql[]  = "SELECT * FROM products";
            $params = [];

            // Recherche par ville
            if ($q = $dto->getSearchDto()->searchQuery) {
                $sql[] = "WHERE city LIKE :city";
                $params['city'] = '%'. $q . '%';
            }

            $pagination    = $dto->getPaginationDto();
            $page          = $pagination->getPage();
            $perPage       = $pagination->getPerPage();
            $offset        = ($page - 1) * $perPage;

            $sql[]         = "LIMIT $perPage OFFSET $offset";

            return $this->connection->statement(join(' ', $sql))
                                    ->setParameters($params)
                                    ->fetch()
                                    ->assoc();
        }



        public function getTotalPages(GetProducts $dto): mixed
        {
            $search     = $dto->getSearchDto();
            $pagination = $dto->getPaginationDto();

            $queryCount   = "SELECT COUNT(id) as count FROM products WHERE city LIKE :city";
            $count        = $this->connection->statement($queryCount)
                                ->setParameters(['city' => '%'. $search->searchQuery . '%'])
                                ->fetch()
                                ->one()['count'];

            return ceil($count / $pagination->getPerPage());
        }
}