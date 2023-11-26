<?php
declare(strict_types=1);

namespace App\Repository;


use App\Database\Connection\PdoConnection;
use App\Database\Connection\QueryBuilder;
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


        /**
         * @return QueryBuilder
        */
        public function createQueryBuilder(): QueryBuilder
        {
             return new QueryBuilder($this->connection->getPdo());
        }



        public function createSelectQuery(GetProducts $dto): QueryBuilder
        {
            $qb = $this->createQueryBuilder()->from("products");

            // Recherche par ville
            if ($q = $dto->getSearchDto()->searchQuery) {
                $qb->where("city LIKE :city")
                    ->setParam('city', '%'. $q . '%');
            }

            return $qb;
        }




        public function findProductsQuery(GetProducts $dto): array
        {
            # Pagination params
            $pagination    = $dto->getPaginationDto();
            $page          = $pagination->getPage();
            $perPage       = $pagination->getPerPage();
            $offset        = ($page - 1) * $perPage;

            # Sorter params
            $sorter        = $dto->getSorterDto();
            $sort          = $sorter->getSort();
            $direction     = $sorter->getDirection();

            $qb    = $this->createSelectQuery($dto);
            $count = (clone $qb)->count();

            if ($sort && $direction) {
                $qb->orderBy($sort, $direction);
            }

            $qb->limit($perPage)->page($page);

            return [
                'pages' => ($count / $perPage),
                'count' => $count,
                'query' => $qb,
                'items' => $qb->fetchAll()
            ];
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